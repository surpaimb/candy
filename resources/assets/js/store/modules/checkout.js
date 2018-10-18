
const state = {
    deliveryMethods: {},
    paymentTypes: {},
    panel: {
        'deliveryAddress': {
            'status': 'edit'
        },
        'deliveryMethods': {
            'status': 'collapse'
        },
        'contactDetails': {
            'status': 'collapse'
        },
        'billingAddress': {
            'status': 'collapse'
        },
        'paymentDetails': {
            'status': 'collapse'
        }
    }
}

const mutations = {
    setDeliveryMethods(state, deliveryMethods) {
        state.deliveryMethods = deliveryMethods;
    },
    setPaymentTypes(state, paymentTypes) {
        state.paymentTypes = paymentTypes;
    },
    setPanelStatus(state , params) {
        CandyEvent.$nextTick(function () {
            state.panel[params.key]['status'] = params.value;
        });
    }
}

const actions = {
    getPaymentTypes({ commit, state }) {
        var types = axios.get('/checkout/payment-types')
            .then(response => {
                commit('setPaymentTypes', response.data);
            });
    },
    deliveryMethodsShowOrNext ({ commit, getters, dispatch }) {
        if (getters.deliveryMethodComplete) {
            commit('setPanelStatus', {'key': 'deliveryMethods', 'value': 'view'});
            dispatch('contactDetailsShowOrNext');
        } else {
            commit('setPanelStatus', {'key': 'deliveryMethods', 'value': 'edit'});
        }
    },
    contactDetailsShowOrNext ({ commit, getters, dispatch }) {
        if (getters.contactDetailsComplete) {
            commit('setPanelStatus', {'key': 'contactDetails', 'value': 'view'});
            dispatch('billingAddressShowOrNext');
        } else {
            commit('setPanelStatus', {'key': 'contactDetails', 'value': 'edit'});
        }
    },
    billingAddressShowOrNext ({ commit, getters, dispatch }) {
        if (getters.billingAddressComplete) {
            commit('setPanelStatus', {'key': 'billingAddress', 'value': 'view'});
            commit('setPanelStatus', {'key': 'paymentDetails', 'value': 'edit'});
        } else {
            commit('setPanelStatus', {'key': 'billingAddress', 'value': 'edit'});
        }
    }
}

export default {
    state,
    mutations,
    actions
}