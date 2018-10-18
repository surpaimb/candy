const state = {
    lines: [],
    discounts: [],
    total: 0,
    tax_total: 0
}

const mutations = {
    setLines(state, lines) {
        state.lines = lines;
    },
    setDiscounts(state, discounts) {
        state.discounts = discounts;
    },
    setTotal(state, total) {
        state.total = total;
    },
    setTaxTotal(state, taxTotal) {
        state.tax_total = taxTotal;
    },
    addLine(state, product) {
        state.lines.push(Candy.nonreactive(product));
    },
    updateLine(state, product) {
        const index = state.lines.findIndex(line => line.variant.id === product.variant.id);
        const productQty = Number(product.quantity);
        state.lines[index].quantity += productQty;
    },
    removeLine(state, product) {
        const index = state.lines.findIndex(line => line.id === product.id);
        state.lines.splice(index, 1);
    }
}

const getters = {
    basketDiscounts(state) {
        return state.discounts;
    },
    basketTotal(state) {
        return state.total;
    },
    taxTotal(state) {
        return state.tax_total;
    },
    basketCount(state) {
        var count = 0;
        if (state.lines.length > 0) {
            state.lines.forEach(function(line, index){
                count += Number(line.quantity);
            });
        }
        return count;
    },
    hasDiscount(state) {
        if (_.has(state.discounts, 'data.length') && state.discounts.data.length > 0) {
            return true;
        }
        return false;
    }
}

const actions = {
    getBasket ({ commit, state }) {
        var basket = axios.get('/basket/get')
            .then(response => {
                if (response.data && response.data.lines){
                    commit('setLines', response.data.lines);
                    commit('setDiscounts', response.data.discount);
                    commit('setTaxTotal', response.data.tax_total);
                    commit('setTotal', response.data.total);
                }
            });
    },
    addToBasket({ commit, dispatch, state }, product) {

        // Check if product exists in basket
        const productLine = Candy.altFind(state.lines, line => {
            return line.variant.id == product.variant.id;
        });

        if (!productLine) { // Add new product to basket
            commit('addLine', product);
        } else { // Update existing product quantity
            commit('updateLine', product);
        }

        // Update basket
        return dispatch('updateBasket');
    },
    updateBasket({ commit, state }) {

        state.lines = _.filter(state.lines, item => {
            return item.quantity > 0;
        });

        return new Promise((resolve, reject) => {
            axios({
                method: 'post',
                url: '/basket/update',
                data: {'basketData': state},
                responseType: 'json'
            })
            .then(response => {
                commit('setTotal', response.data.data.total);
                commit('setTaxTotal', response.data.data.tax_total);
                resolve(response);
            })
            .catch(error => {
                reject(error);
            });
        });

    },
    emptyBasket({ commit, dispatch, state }) {
        state.lines = [];
        state.discount = [];
        state.total = 0;
        state.tax_total = 0;

        return dispatch('updateBasket');
    },
    applyDiscount ({ commit, state }, discountCode) {

        return new Promise((resolve, reject) => {
            axios({
                method: 'post',
                url: '/basket/discount',
                data: {'discountCode': discountCode},
                responseType: 'json'
            })
            .then(response => {
                commit('setDiscounts', response.data.data.discounts);
                commit('setTaxTotal', response.data.data.tax_total);
                commit('setTotal', response.data.data.total);
                resolve(response);
            })
            .catch(error => {
                reject(error);
            });
        });

    },
    removeDiscount ({ commit, state }, discountId) {

        return new Promise((resolve, reject) => {
            axios({
                method: 'post',
                url: '/basket/remove-discount',
                data: {'discountId': discountId},
                responseType: 'json'
            })
            .then(response => {
                commit('setDiscounts', response.data.data.discounts);
                commit('setTaxTotal', response.data.data.tax_total);
                commit('setTotal', response.data.data.total);
                resolve(response);
            })
            .catch(error => {
                reject(error);
            });
        });

    },
    removeFromBasket({ commit, dispatch }, line) {
        commit('removeLine', line);
        return dispatch('updateBasket');
    }
}

export default {
    state,
    getters,
    mutations,
    actions
}