const state = {
    deliveryAddress: {
        'firstname': '',
        'lastname': '',
        'phone': '',
        'address': '',
        'address_two': '',
        'city': '',
        'county': '',
        'country': 'United Kingdom',
        'zip': ''
    },
    deliveryMethod: {
        'price_id': '',
        'shipping_method': '',
        'shipping_total': '',
    },
    contactDetails: {
        'email': '',
        'phone': ''
    },
    billingAddress: {
        'vat_no': '',
        'firstname': '',
        'lastname': '',
        'phone': '',
        'address': '',
        'address_two': '',
        'city': '',
        'county': '',
        'country': 'United Kingdom',
        'zip': ''
    },
    notes: '',
    total: 0,
    tax: 0,
}

const getters = {
    deliveryAddressComplete (state, value) {

        var required = ['firstname','lastname','phone','address','city','county','country','zip'];
        var emptyFields = required.filter(function(input) {
            return state.deliveryAddress[input] == "";
        }).length;

        return emptyFields == 0;
    },
    deliveryMethodComplete (state, value) {

        var required = ['price_id','shipping_method','shipping_total'];
        var emptyFields = required.filter(function(input) {
            return state.deliveryMethod[input] == "";
        }).length;

        return emptyFields == 0;
    },
    contactDetailsComplete (state, value) {

        var required = ['email','phone'];
        var emptyFields = required.filter(function(input) {
            return state.contactDetails[input] == "";
        }).length;

        return emptyFields == 0;
    },
    billingAddressComplete (state, value) {

        var required = ['firstname','lastname','phone','address','city','county','country','zip'];
        var emptyFields = required.filter(function(input) {
            return state.billingAddress[input] == "";
        }).length;

        return emptyFields == 0;
    },
    orderTotal (state) {
        return state.total;
    },
    orderTax (state) {
        return state.tax;
    }
}

const mutations = {
    setDeliveryMethod (state, value) {
        _.assign(state.deliveryMethod, value);
    },
    setVatNo (state, value) {
        state.billingAddress.vat_no = value;
    },
    setOrderTotal (state, value) {
        state.total = value;
    },
    setOrderTax (state, value) {
        state.tax = value;
    },
    setDeliveryBillingAddress (state) {
        state.billingAddress.address = state.deliveryAddress.address;
        state.billingAddress.address_two = state.deliveryAddress.address_two;
        state.billingAddress.city = state.deliveryAddress.city;
        state.billingAddress.county = state.deliveryAddress.county;
        state.billingAddress.country = state.deliveryAddress.country;
        state.billingAddress.zip = state.deliveryAddress.zip;
    },
    clearBillingAddress (state) {
        state.billingAddress.address = '';
        state.billingAddress.address_two = '';
        state.billingAddress.city = '';
        state.billingAddress.county = '';
        state.billingAddress.country = 'United Kingdom';
        state.billingAddress.zip = '';
    },
    preFill (state, items) {
        if ( state.contactDetails['phone'] == '' ){
            state.contactDetails['phone'] = state.deliveryAddress['phone']
        }
        if ( state.billingAddress['firstname'] == '' ){
            state.billingAddress['firstname'] = state.deliveryAddress['firstname']
        }
        if ( state.billingAddress['lastname'] == '' ){
            state.billingAddress['lastname'] = state.deliveryAddress['lastname']
        }
        if ( state.billingAddress['phone'] == '' ){
            state.billingAddress['phone'] = state.deliveryAddress['phone']
        }
    }
}

const actions = {
    orderPrefill ({ state }, obj) {
        $.each( state[obj.panel], function( key ) {
            if (_.has(obj.data, key) && obj.data[key] != null) {
                state[obj.panel][key] = obj.data[key];
            }
        });
    },
    postDeliveryAddress ({ commit, dispatch, state }, data) {
        return new Promise((resolve, reject) => {
            axios({
                method: 'post',
                url: '/checkout/delivery-address',
                data: state.deliveryAddress
            })
            .then(response => {
                commit('preFill');
                resolve(response);
            })
            .catch(error => {
                reject(error);
            });
        });
    },
    postDeliveryMethod ({ commit, dispatch, state }, data) {
        return new Promise((resolve, reject) => {
            axios({
                method: 'post',
                url: '/checkout/delivery-method',
                data: state.deliveryMethod
            })
            .then(response => {
                resolve(response);
            }).catch(error => {
                reject(error);
            });
        });
    },
    postContactDetails ({ commit, dispatch, state }, data) {
        return new Promise((resolve, reject) => {
            axios({
                method: 'post',
                url: '/checkout/contact-details',
                data: state.contactDetails
            })
            .then(response => {
                resolve(response);
            }).catch(error => {
                reject(error);
            });
        });
    },
    postBillingAddress ({ commit, dispatch, state }, data) {
        return new Promise((resolve, reject) => {
            axios({
                method: 'post',
                url: '/checkout/billing-address',
                data: state.billingAddress
            })
            .then(response => {
                resolve(response);
            }).catch(error => {
                reject(error);
            });
        });
    },
    postPaymentDetails ({ commit, dispatch, state }, params) {

        let data = {
            'notes': state.notes
        };

        if (params.token) {
            data.payment_token = params.token;
        }

        if (params.type) {
            data.payment_type_id = params.type;
        }

        return new Promise((resolve, reject) => {
            axios({
                method: 'post',
                url: '/checkout/process',
                data: data
            })
            .then(response => {
                resolve(response);
            }).catch(error => {
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