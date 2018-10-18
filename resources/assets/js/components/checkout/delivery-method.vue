<template>
    <div :class="{'checkout-panel': true, 'active': (panel.statusc == 'edit' || panel.status == 'view')}" >
        <div class="row">

            <div class="col-xs-9">
                <p class="h4">Delivery Options</p>
            </div>

            <div class="col-xs-3 text-right" v-show="panel.status != 'collapse' && panel.status == 'view'">
                <button type="button" class="btn btn-xs btn-lighter-blue" @click="setPanelStatus('edit')">Change</button>
            </div>

        </div>
        <div v-show="panel.status != 'collapse'">
            <div class="row">
                <div class="col-xs-12">

                    <!-- Display the chosen delivery method in this format once stage has been completed -->
                    <transition name="fade-in">
                        <div class="delivery-method" v-show="panel.status == 'view'">
                            {{ deliveryMethod.shipping_method }}
                            <small>
                                <strong v-if="deliveryMethod.shipping_total > 0 ">
                                    <span v-html="formatPrice(deliveryMethod)"></span>
                                </strong>
                                <strong v-else>
                                    FREE
                                </strong>
                            </small>
                        </div>
                    </transition>
                    <!-- END -->

                </div>
            </div>

            <transition name="fade-in">
                <form @submit.prevent="submitForm" v-show="panel.status == 'edit'">
                    <div class="row">
                        <div class="col-xs-12">

                            <div class="form-group">
                                <div class="radio custom-radio" v-for="deliveryMethod in deliveryMethods" :key="deliveryMethod.id">
                                    <label>
                                        <input type="radio" name="shippingOptions" :id="deliveryMethod.id" :value="deliveryMethod.id" @click="updateShipping" required>
                                        
                                        <span>
                                            {{ candyAttribute(deliveryMethod.method.data, 'name') }}
                                            <small>
                                                <strong v-if="deliveryMethod.rate > 0 ">
                                                    <span v-html="formatPrice(deliveryMethod)"></span>
                                                </strong>
                                                <strong v-else>
                                                    FREE
                                                </strong>
                                                 <span v-if="candyAttribute(deliveryMethod.method.data, 'description')">- {{ candyAttribute(deliveryMethod.method.data, 'description') }}</span>
                                            </small>
                                        </span>
                                    </label>
                                </div>
                            </div>

                        </div>
                    </div>
                    <div class="row">
                        <div class="col-xs-12">
                            <button type="submit" class="btn btn-green">Confirm Delivery Option</button>
                        </div>
                    </div>

                    <div class="disclaimer">
                        <p class="small">
                            <em>Products in stock will be sent after the payment is verified. Mail service is responsible for the goods during transportation.</em>
                        </p>
                        <p class="small">
                            <em>Please, open the package delivered under your order the moment you receive it. If any damage is revealed, make claims against mail service.</em>
                        </p>
                        <p class="small">
                            <em>Any questions? Contact our Customer Service at 01245 477 400</em>
                        </p>
                    </div>

                </form>
            </transition>

        </div>
    </div>
</template>

<script>
    export default {
        props: {
            methods: {
                type: Array,
                default: []
            }
        },
        data() {
            return {
                errors: {}
            }
        },
        created() {
            this.$store.commit('setDeliveryMethods', this.methods);
        },
        computed: {
            panel() {
                return this.$store.state.checkout.panel.deliveryMethods;
            },
            deliveryMethod() {
                return this.$store.state.order.deliveryMethod;
            },
            deliveryMethods() {
                return this.$store.state.checkout.deliveryMethods;
            },
            basket() {
                return this.$store.state.basket;
            },
            basketCount() {
                return this.$store.getters.basketCount;
            },
            basketTotal() {
                return this.$store.getters.basketTotal;
            }
        },
        methods: {
            formatPrice(method) {
                return method.currency.data.format.replace('{price}', method.rate);
            },
            setPanelStatus(value) {
                this.$store.commit('setPanelStatus', {'key':'deliveryMethods', 'value': value});
            },
            updateShipping: function(value) {
                this.$store.commit('setDeliveryMethod', {'price_id': value.target.value});
            },
            candyAttribute: function(data, attribute) {
                return Candy.attribute(data, attribute);
            },
            submitForm() {
                this.$store.dispatch('postDeliveryMethod')
                .then(response => {
                    this.$store.commit('setDeliveryMethod', {
                        'shipping_method': response.data['order']['shipping_method'], 
                        'shipping_total': response.data['order']['shipping_total'],
                        'rate': response.data['order']['shipping_total'],
                        'currency': {'data': {'format': '&#xa3;{price}'}}
                    });
                    this.$store.commit('setOrderTotal', response.data['order']['total']);
                    this.$store.commit('setOrderTax', response.data['order']['vat']);
                    this.$store.commit('setPanelStatus', {'key':'deliveryMethods', 'value':'view'});
                    this.$store.dispatch('contactDetailsShowOrNext');
                })
                .catch(error => {
                    this.errors = error.response.data;
                });
            },
        }
    }
</script>
