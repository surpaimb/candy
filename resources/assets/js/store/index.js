import Vue from 'vue'
import Vuex from 'vuex'

import basket from './modules/basket'
import checkout from './modules/checkout'
import order from './modules/order'
import product from './modules/product'
import search from './modules/search'
import store from './modules/store'

Vue.use(Vuex);

export default new Vuex.Store({
    modules: {
        store,
        basket,
        checkout,
        order,
        product,
        search
    }
});