
/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

require('./bootstrap');
var candy = require('./classes/Candy.js');
var numeral = require("numeral");

window.moment = require('moment');
window.Candy = new candy();
window.CandyEvent = new Vue;

window.language = document.head.querySelector('meta[name="language"]').content;
window.channel = document.head.querySelector('meta[name="channel"]').content;
window.currency = {
    code: document.head.querySelector('meta[name="currency-code"]').content,
    symbol: document.head.querySelector('meta[name="currency-symbol"]').content
};


import Vue from 'vue'
import store from './store'

/**
 * Next, we will create a fresh Vue application instance and attach it to
 * the page. Then, you may begin adding components to this application
 * or customize the JavaScript scaffolding to fit your unique needs.
 */

Vue.component('product-gallery', require('./components/products/gallery.vue'));
Vue.component('product-variants', require('./components/products/variants.vue'));
Vue.component('product-sku', require('./components/products/sku.vue'));
Vue.component('product-stock', require('./components/products/stock.vue'));
Vue.component('product-price-tiers', require('./components/products/price-tiers.vue'));

Vue.component('vat-toggle', require('./components/vat-toggle.vue'));
Vue.component('currency-select', require('./components/currency-select.vue'));
Vue.component('language-select', require('./components/language-select.vue'));
Vue.component('modal', require('./components/modal.vue'));
Vue.component('form-error', require('./components/form-error.vue'));
Vue.component('lightbox', require('./components/lightbox.vue'));

Vue.component('search', require('./components/elastic/search.vue'));
Vue.component('search-mobile', require('./components/elastic/search-mobile.vue'));
Vue.component('search-filters', require('./components/elastic/filters.vue'));
Vue.component('search-listings', require('./components/elastic/listings.vue'));
Vue.component('search-pagination', require('./components/elastic/pagination.vue'));
Vue.component('search-display', require('./components/elastic/display.vue'));
Vue.component('search-sort-by', require('./components/elastic/sort-by.vue'));
Vue.component('search-filter-buttons', require('./components/elastic/filter-buttons.vue'));
Vue.component('search-add-to-basket', require('./components/elastic/add-to-basket.vue'));

Vue.component('basket', require('./components/basket/basket.vue'));
Vue.component('add-to-basket', require('./components/basket/add-to-basket.vue'));
Vue.component('add-to-basket-modal', require('./components/basket/add-to-basket-modal.vue'));
Vue.component('basket-discount', require('./components/basket/discount.vue'));
Vue.component('basket-lines', require('./components/basket/lines.vue'));
Vue.component('basket-totals', require('./components/basket/totals.vue'));
Vue.component('basket-proceed-btn', require('./components/basket/proceed-btn.vue'));
Vue.component('basket-proceed-modal', require('./components/basket/proceed-modal.vue'));

Vue.component('checkout-basket-summary', require('./components/checkout/basket-summary.vue'));
Vue.component('checkout-delivery-address', require('./components/checkout/delivery-address.vue'));
Vue.component('checkout-delivery-method', require('./components/checkout/delivery-method.vue'));
Vue.component('checkout-contact-details', require('./components/checkout/contact-details.vue'));
Vue.component('checkout-payment-details', require('./components/checkout/payment-details.vue'));

Vue.component('collection-featured', require('./components/collections/featured.vue'));

//Filters
Vue.filter('capitalize', function (value) {
    if (!value) return '';
    value = value.toString()
    return value.charAt(0).toUpperCase() + value.slice(1)
});

Vue.filter('currency', function (value) {
    if (!value) return currency.symbol + 0.00;
    value = Number(value);
    return currency.symbol + numeral(value).format("0,00.00");
});

Vue.filter("number_format", function (value, format) {
    if (!format) {
        format = "0,0";
    }
    return numeral(value).format(format);
});

const app = new Vue({
    el: '#app',
    store,
    mounted() {
        store.dispatch('getBasket');
    }
});