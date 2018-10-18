<template>
    <div :class="{'checkout-panel': true, 'active': (panel.status == 'edit' || panel.status == 'view')}">

        <div class="row">
            <div class="col-xs-9">
                <p class="h4">Contact Details</p>
            </div>
            <div class="col-xs-3 text-right" v-show="panel.status != 'collapse' && panel.status == 'view'">
                <button type="button" class="btn btn-xs btn-lighter-blue" @click="setPanelStatus('edit')">Change</button>
            </div>
        </div>

        <div v-show="panel.status != 'collapse'">
            <!--This information is displayed once the contact details stage has  been saved.-->
            <transition name="fade-in">
                <div class="contact-details" v-show="panel.status == 'view'">
                    <div class="row">
                        <div class="col-xs-12 col-sm-4 col-md-3">
                            <strong>Email:</strong>
                        </div>
                        <div class="col-xs-12 col-sm-8 col-md-9">
                            {{ contactDetails.email }}
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-xs-12 col-sm-4 col-md-3">
                            <strong>Phone:</strong>
                        </div>
                        <div class="col-xs-12 col-sm-8 col-md-9">
                            {{ contactDetails.phone }}
                        </div>
                    </div>
                </div>
            </transition>
            <!-- END -->

            <transition name="fade-in">
                <form @submit.prevent="submitForm" v-show="panel.status == 'edit'">
                    <p class="small">We'll use these details to contact you about your order</p>
                    <div class="row">
                        <div class="col-xs-12 col-md-6">
                            <div class="form-group">
                                <label>Email</label>
                                <input type="email" class="form-control" v-model="contactDetails.email" required>
                                <form-error v-if="errors.email" :errors="errors.email"></form-error>
                            </div>
                        </div>
                        <div class="col-xs-12 col-md-6">
                            <div class="form-group">
                                <label>Phone</label>
                                <input type="tel" class="form-control" v-model="contactDetails.phone" required>
                                <form-error v-if="errors.phone" :errors="errors.phone"></form-error>
                            </div>
                        </div>
                        <div class="col-xs-12">
                            <button type="submit" class="btn btn-green">Use these details</button>
                        </div>
                    </div>
                </form>
            </transition>

         </div>
    </div>
</template>

<script>
    export default {
        props: {
            prefill: {
                type: Object,
                default: {}
            },
            email: {
                type: String,
                default: null
            },
            tel: {
                type: String,
                default: null
            }
        },
        data() {
            return {
                errors: {}
            }
        },
        created() {
            var prefillData = {
                'email': this.prefill['contact_email'] ? this.prefill['contact_email'] : this.email,
                'phone': this.prefill['contact_phone'] ? this.prefill['contact_phone'] : this.tel
            }

            if (prefillData.email && prefillData.phone) {
                this.submitForm();
            }

            this.$store.dispatch('orderPrefill', {'panel': 'contactDetails', 'data': prefillData});
        },
        computed: {
            panel() {
                return this.$store.state.checkout.panel.contactDetails;
            },
            contactDetails() {
                return this.$store.state.order.contactDetails;
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
            setPanelStatus(value) {
                this.$store.commit('setPanelStatus', {'key':'contactDetails', 'value': value});
            },
            submitForm() {
                this.$store.dispatch('postContactDetails')
                .then(response => {
                    this.$store.commit('setPanelStatus', {'key':'contactDetails', 'value':'view'});
                    this.$store.dispatch('billingAddressShowOrNext');

                })
                .catch(error => {
                    this.errors = error.response.data;
                });
            }
        }
    }
</script>
