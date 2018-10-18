<template>
    <!-- "active" class to be added to the active stage and completed stages-->
    <div :class="{'checkout-panel': true, 'active': (panel.status == 'edit' || panel.status == 'view')}" v-show="panel.status != 'collapse'">
        <div class="row">
            <div class="col-xs-9">
                <p class="h4">Delivery Address</p>
            </div>
            <div class="col-xs-3 text-right" v-show="panel.status != 'collapse' && panel.status == 'view'">
                <button type="button" class="btn btn-xs btn-lighter-blue" @click="setPanelStatus('edit')">Change</button>
            </div>
        </div>

        <div class="row">
            <div class="col-xs-12">
                <transition name="fade-in">
                    <p class="chosen-address" v-show="panel.status == 'view'">
                        {{ deliveryAddress.firstname }} {{ deliveryAddress.lastname }}<br>
                        {{ deliveryAddress.address }}<br>
                        <span v-show="deliveryAddress.address_two.length > 0">{{ deliveryAddress.address_two }}<br></span>
                        {{ deliveryAddress.city }}<br>
                        {{ deliveryAddress.county }}, {{ deliveryAddress.zip }}<br>
                        {{ deliveryAddress.country }}
                    </p>
                </transition>
            </div>
        </div>

        <transition name="fade-in">
            <form @submit.prevent="submitForm" v-show="panel.status == 'edit'">
                <div class="row">
                    <div class="col-xs-12 col-md-6">
                        <div class="form-group">
                            <label>First name</label>
                            <input type="text" class="form-control" v-model="deliveryAddress.firstname" required>
                            <form-error v-if="errors.firstname" :errors="errors.firstname"></form-error>
                        </div>
                    </div>
                    <div class="col-xs-12 col-md-6">
                        <div class="form-group">
                            <label>Last name</label>
                            <input type="text" class="form-control" v-model="deliveryAddress.lastname" required>
                            <form-error v-if="errors.lastname" :errors="errors.lastname"></form-error>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-xs-12 col-md-6">
                        <div class="form-group">
                            <label>Phone</label>
                            <input type="tel" class="form-control" v-model="deliveryAddress.phone" required>
                            <form-error v-if="errors.phone" :errors="errors.phone"></form-error>
                        </div>
                    </div>
                </div>
                <hr>
                <div class="row">
                    <div class="col-xs-12">
                        <label>Address</label>
                    </div>
                    <div class="col-xs-12 col-md-6">
                        <div class="form-group">
                            <input type="text" class="form-control" placeholder="Name or Number and Street Name" v-model="deliveryAddress.address" required>
                            <form-error v-if="errors.address" :errors="errors.address"></form-error>
                        </div>
                    </div>
                    <div class="col-xs-12 col-md-6">
                        <div class="form-group">
                            <input type="text" class="form-control" placeholder="Street Name cont." v-model="deliveryAddress.address_two">
                            <form-error v-if="errors.address_two" :errors="errors.address_two"></form-error>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-xs-12 col-md-6">
                        <div class="form-group">
                            <label>City</label>
                            <input type="text" class="form-control" v-model="deliveryAddress.city" required>
                            <form-error v-if="errors.city" :errors="errors.city"></form-error>
                        </div>
                    </div>
                    <div class="col-xs-12 col-md-6">
                        <div class="form-group">
                            <label>County</label>
                            <input type="text" class="form-control" v-model="deliveryAddress.county" required>
                            <form-error v-if="errors.county" :errors="errors.county"></form-error>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-xs-12 col-md-6">
                        <div class="form-group">
                            <label>Country</label>
                            <span class="custom-select full-width">
                                <select class="form-control custom-dropdown" v-model="deliveryAddress.country" required>
                                    <optgroup label="Popular Countries" value="Popular Countries">
                                        <option :value="country" v-for="country in popularCountries">{{ country }}</option>
                                    </optgroup>
                                    <optgroup :label="region.region" v-for="region in regions" :key="region.region" v-if="region.region == 'Europe'" value="Europe">
                                        <option :value="country.name.en" v-for="country in countries(region)" :key="country.id">
                                            {{ country.name.en }}
                                        </option>
                                    </optgroup>
                                </select>
                            </span>
                        </div>
                    </div>
                    <div class="col-xs-6 col-md-6">
                        <div class="form-group">
                            <label>Post Code</label>
                            <input type="text" class="form-control" v-model="deliveryAddress.zip" required>
                            <form-error v-if="errors.zip" :errors="errors.zip"></form-error>
                        </div>
                    </div>
                    <div class="col-xs-12">
                        <button type="submit" class="btn btn-green">Deliver to this Address</button>
                        <!-- Only display this button once an address has been found by the address finder -->
                    </div>
                </div>
            </form>
        </transition>

    </div>
</template>

<script>

    export default {
        props: {
            regions: {
                type: Array,
                default: []
            },
            prefill: {
                type: Object,
                default: {}
            }
        },
        data() {
            return {
                errors: {},
                popularCountries: [
                    'United Kingdom',
                    'France'
                ]
            }
        },
        created() {
            this.$store.dispatch('orderPrefill', {'panel': 'deliveryAddress', 'data': this.prefill['shipping']});

            if (this.$store.getters.deliveryAddressComplete) {
                this.$store.commit('setPanelStatus', {'key' : 'deliveryAddress', 'value': 'view'});
                this.$store.dispatch('deliveryMethodsShowOrNext');
            } else {
                this.$store.commit('setPanelStatus', {'key' : 'deliveryAddress', 'value': 'edit'});
            }
        },
        computed: {
            panel() {
                return this.$store.state.checkout.panel.deliveryAddress;
            },
            deliveryAddress() {
                return this.$store.state.order.deliveryAddress;
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
            countries(region) {
                return _.filter(region.countries.data, item => {
                    return !(this.popularCountries.indexOf(item.name.en) >= 0);
                });
            },
            setPanelStatus(value) {
                this.$store.commit('setPanelStatus', {'key':'deliveryAddress', 'value':value});
            },
            submitForm() {
                this.$store.dispatch('postDeliveryAddress')
                .then(response => {
                    this.$store.commit('setDeliveryMethods', response.data['deliveryMethods']['data']);
                    this.$store.commit('setPanelStatus', {'key':'deliveryAddress', 'value':'view'});
                    this.$store.commit('setPanelStatus', {'key':'deliveryMethods', 'value':'edit'});
                })
                .catch(error => {
                    this.errors = error.response.data;
                });
            }
        }
    }
</script>
