const state = {
    excVat: false
}

const mutations = {
    setExcVat(state, status) {
        state.excVat = status;
    }
}

const getters = {
    vatBoolean(state) {
        return state.excVat;
    },
    vatLabel(state) {
        return (state.excVat == true) ? 'Exc' : 'Inc';
    }
}

const actions = {
    toggleVat ({ commit, state }, value) {
        return new Promise((resolve, reject) => {
            axios({
                method: 'post',
                url: '/vat',
                data: {'excl_tax': value},
                responseType: 'json'
            })
            .then(response => {
                resolve(response);
            })
            .catch(error => {
                reject(error);
            });
        });
    },
    changeCurrency({commit, state}, value) {
        return new Promise((resolve, reject) => {
            axios({
                method: 'post',
                url: '/currency',
                data: {'currency': JSON.parse(value)},
                responseType: 'json'
            })
            .then(response => {
                resolve(response);
            })
            .catch(error => {
                reject(error);
            });
        });
    },
    changeLanguage({commit, state}, value) {
        return new Promise((resolve, reject) => {
            axios({
                method: 'post',
                url: '/language',
                data: {'language': value},
                responseType: 'json'
            })
            .then(response => {
                resolve(response);
            })
            .catch(error => {
                reject(error);
            });
        });
    }
}

export default {
    state,
    getters,
    mutations,
    actions
}