<template>
    <div :class="{'checkout-panel': true, 'active': (billingPanel.status == 'edit' || billingPanel.status == 'view')}">
        <p class="h4">Payment Details</p>
        <div class="row" v-show="billingPanel.status != 'collapse' && billingPanel.status == 'view'">
            <div class="col-xs-9">
                <p class="h5">Billing Address</p>
            </div>
            <div class="col-xs-3 text-right">
                <button type="button" class="btn btn-xs btn-lighter-blue" @click="setPanelStatus('edit')">Change</button>
            </div>
        </div>

        <div v-show="billingPanel.status != 'collapse'">

            <!--This information is displayed once a billing address has been saved.-->
            <transition name="fade-in">
                <p class="chosen-address" v-show="billingPanel.status == 'view'">
                    {{ billingAddress.firstname }} {{ billingAddress.lastname }}<br>
                    {{ billingAddress.address }}<br>
                    <span v-show="billingAddress.address_two.length > 0">{{ billingAddress.address_two }}<br></span>
                    {{ billingAddress.city }}<br>
                    {{ billingAddress.county }}, {{ billingAddress.zip }}<br>
                    {{ billingAddress.country }}
                </p>
            </transition>
            <!-- END -->

            <!-- Only dispay this section if a customer wants to change the Billing Address -->
            <transition name="fade-in">
                <form @submit.prevent="submitBillingForm" v-show="billingPanel.status == 'edit'">
                    <div class="row">
                        <div class="col-xs-12">
                            <div class="form-group">
                                <label>EU VAT Number <small>(Optional)</small></label>
                                <input type="text" class="form-control" v-model="billingAddress.vat_no">
                                <form-error v-if="errors.vat_no" :errors="errors.vat_no"></form-error>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-xs-12 col-md-6">
                            <div class="form-group">
                                <label>First name</label>
                                <input type="text" class="form-control" v-model="billingAddress.firstname" required>
                                <form-error v-if="errors.firstname" :errors="errors.firstname"></form-error>
                            </div>
                        </div>
                        <div class="col-xs-12 col-md-6">
                            <div class="form-group">
                                <label>Last name</label>
                                <input type="text" class="form-control" v-model="billingAddress.lastname" required>
                                <form-error v-if="errors.lastname" :errors="errors.lastname"></form-error>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-xs-12 col-md-6">
                            <div class="form-group">
                                <label>Phone</label>
                                <input type="tel" class="form-control" v-model="billingAddress.phone" required>
                                <form-error v-if="errors.phone" :errors="errors.phone"></form-error>
                            </div>
                        </div>
                    </div>
                    <hr>
                    <div class="row">
                        <div class="col-xs-12">
                            <label>Address</label>
                            <label class="pull-right">
                                Use delivery address? <input type="checkbox" v-model="useDeliveryAddress">
                            </label>
                        </div>
                        <div class="col-xs-12 col-md-6">
                            <div class="form-group">
                                <input type="text" class="form-control" placeholder="Name or Number and Street Name" v-model="billingAddress.address" required>
                                <form-error v-if="errors.address" :errors="errors.address"></form-error>
                            </div>
                        </div>
                        <div class="col-xs-12 col-md-6">
                            <div class="form-group">
                                <input type="text" class="form-control" placeholder="Street Name cont." v-model="billingAddress.address_two">
                                <form-error v-if="errors.address_two" :errors="errors.address_two"></form-error>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-xs-12 col-md-6">
                            <div class="form-group">
                                <label>City</label>
                                <input type="text" class="form-control" v-model="billingAddress.city" required>
                                <form-error v-if="errors.city" :errors="errors.city"></form-error>
                            </div>
                        </div>
                        <div class="col-xs-12 col-md-6">
                            <div class="form-group">
                                <label>County</label>
                                <input type="text" class="form-control" v-model="billingAddress.county" required>
                                <form-error v-if="errors.county" :errors="errors.county"></form-error>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-xs-12 col-md-6">
                            <div class="form-group">
                                <label>Country</label>
                                <span class="custom-select full-width">
                                    <select class="form-control custom-dropdown" v-model="billingAddress.country" required>
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
                                <input type="text" class="form-control" v-model="billingAddress.zip" required>
                                <form-error v-if="errors.zip" :errors="errors.zip"></form-error>
                            </div>
                        </div>
                        <div class="col-xs-12">
                            <button type="submit" class="btn btn-green">Confirm Billing Address</button>
                        </div>
                    </div>
                </form>
            </transition>
            <!-- END -->
            <transition name="fade-in">
                <div v-show="paymentPanel.status == 'edit'" style="padding-top:50px;">

                    <transition name="fade-in">
                        <div v-show="!isProccessing" class="form-group">
                            <label for="comment">Order notes:</label>
                            <textarea v-model="order.notes" class="form-control" rows="5"></textarea>
                        </div>
                    </transition>

                    <template v-if="hasType('Offline')">
                        <button class="btn btn-sm btn-primary" @click="payOnAccount()">Pay on account</button>
                        <button class="btn btn-sm btn-green" @click="payNow()" >Pay now</button>
                        <hr>
                    </template>

                    <div :class="{'hidden' : onAccount || hasType('Offline') && !chosen}">
                        <transition name="fade-in">
                            <div class="alert alert-danger" role="alert" v-show="paymentStatus == 'declined'">
                                <i class="fa fa-exclamation-circle"></i>
                                <strong>Declined</strong> sorry your card seems to have been declined, please try another card.
                            </div>
                        </transition>

                        <transition name="fade-in">
                            <div class="alert alert-danger" role="alert" v-show="paymentStatus == 'missing_payment_method'">
                                <i class="fa fa-exclamation-circle"></i>
                                <strong>Error</strong> Please ensure you have correctly entered your payment details.
                            </div>
                        </transition>

                        <transition name="fade-in">
                            <div class="alert text-center" v-show="isProccessing">
                                <i class="fas fa-spinner fa-spin fa-3x"></i><br><br>
                                <strong>Please Wait</strong> proccessing your card details
                            </div>
                        </transition>
                        <div v-show="!isProccessing" id="paypal-container" @click="paymentStatus = ''"></div>
                        <div v-show="!isProccessing" id="dropin-container" @click="paymentStatus = ''"></div>

                        <hr>

                        <div class="clearfix">
                            <button v-show="!isProccessing" @click="submitPaymentForm" id="submit-button" class="btn btn-green pull-right">Place your order securely</button>
                        </div>
                        <div id="nonce"></div>
                    </div>
                    <div :class="{'hidden' : !onAccount}" v-if="hasType('Offline')">
                        <div class="alert alert-info">
                            <p>You have chosen to pay on account, an invoice will be generated and sent to you.</p>
                        </div>
                        <transition name="fade-in">
                            <div class="alert alert-danger" role="alert" v-show="paymentStatus == 'error'">
                                <i class="fa fa-exclamation-circle"></i>
                                <strong>Error</strong> We are unable to process your order on account.
                            </div>
                        </transition>
                        <div class="clearfix">
                            <button @click="submitOnAccount" id="submit-button" class="btn btn-green pull-right" :disabled="isProccessing">Place your order securely</button>
                        </div>
                    </div>

                </div>
            </transition>

        </div>
    </div>
</template>

<script>
export default {
  props: {
    regions: {
      type: Array,
      default: [],
    },
    prefill: {
      type: Object,
      default: {},
    },
    auth: {
      type: String,
      default: '',
    },
  },
  data() {
    return {
      oldBillingAddress: [],
      useDeliveryAddress: false,
      paymentTotal: 0,
      errors: {},
      paymentStatus: '',
      isProccessing: false,
      braintreeDropin: null,
      chosen: false,
      onAccount: true,
      popularCountries: ['United Kingdom'],
    };
  },
  watch: {
    useDeliveryAddress: function(useDelivery) {
      if (useDelivery) {
        this.$store.commit('setDeliveryBillingAddress');
      } else {
        this.$store.commit('clearBillingAddress');
      }
    },
    orderTotal: function(val) {
      //this.buildForm(val);
    },
  },
  computed: {
    paymentTypes() {
      return this.$store.state.checkout.paymentTypes;
    },
    billingPanel() {
      return this.$store.state.checkout.panel.billingAddress;
    },
    paymentPanel() {
      return this.$store.state.checkout.panel.paymentDetails;
    },
    basket() {
      return this.$store.state.basket;
    },
    deliveryAddress() {
      return this.$store.state.order.deliveryAddress;
    },
    billingAddress() {
      return this.$store.state.order.billingAddress;
    },
    basketCount() {
      return this.$store.getters.basketCount;
    },
    basketTotal() {
      return this.$store.getters.basketTotal;
    },
    orderTotal() {
      return this.$store.getters.orderTotal;
    },
    order() {
      return this.$store.state.order;
    },
  },
  mounted() {
    var button = document.querySelector('#submit-button');
    this.oldBillingAddress = this.billingAddress;
    // this.buildForm();
    this.$store.dispatch('orderPrefill', {
      panel: 'billingAddress',
      data: this.prefill['billing'],
    });
    this.$store.dispatch('getPaymentTypes');

    this.$store.commit('setVatNo', this.prefill['vat_no']);
    this.$store.commit('setOrderTotal', this.prefill['total']);
    this.$store.commit('setOrderTax', this.prefill['vat']);
  },
  methods: {
    hasType(type) {
      return this.getPaymentType(type);
    },
    countries(region) {
      return _.filter(region.countries.data, item => {
        return !(this.popularCountries.indexOf(item.name.en) >= 0);
      });
    },
    getPaymentType(type) {
      let item = _.find(this.paymentTypes.data, item => {
        return item.driver == type;
      });
      return item;
    },
    payOnAccount() {
      this.onAccount = true;
      this.chosen = true;
    },
    payNow() {
      this.chosen = true;
      this.onAccount = false;
    },
    submitOnAccount() {
      let type = this.getPaymentType('Offline');

      this.paymentStatus = '';
      this.isProccessing = true;

      this.$store
        .dispatch('postPaymentDetails', {
          type: type.id,
        })
        .then(response => {
          window.location.replace('/checkout/confirmation');
        })
        .catch(error => {
          this.paymentStatus = 'error';
          this.isProccessing = false;
        });
    },
    buildForm(price) {
      var _this = this;
      CandyEvent.$on('submitPayment', function() {
        _this.isProccessing = true;
        _this.$store
          .dispatch('postPaymentDetails', {
            token: payload.nonce,
          })
          .then(response => {
            window.location.replace('/checkout/confirmation');
          })
          .catch(error => {
            _this.paymentStatus = 'declined';
            _this.isProccessing = false;
          });
      });
    },
    _buildForm(price) {
      if (this.braintreeDropin) {
        this.braintreeDropin.teardown();
        CandyEvent.$off('submitPayment');
      }

      braintree.dropin.create(
        {
          authorization: this.auth,
          container: '#dropin-container',
          paypal: {
            container: 'paypal-container',
            singleUse: true,
            flow: 'checkout',
            amount: price, // Required
            currency: 'GBP', // Required
            headless: true,
          },
        },
        (ce, i) => {
          this.braintreeDropin = i;
          var createErr = ce;
          var _this = this;

          CandyEvent.$on('submitPayment', function() {
            _this.braintreeDropin.requestPaymentMethod(function(err, payload) {
              if (payload) {
                _this.isProccessing = true;
                _this.$store
                  .dispatch('postPaymentDetails', {
                    token: payload.nonce,
                  })
                  .then(response => {
                    window.location.replace('/checkout/confirmation');
                  })
                  .catch(error => {
                    _this.paymentStatus = 'declined';
                    _this.isProccessing = false;
                  });
              } else {
                _this.paymentStatus = 'missing_payment_method';
              }
            });
          });
        },
      );
    },
    setPanelStatus(value) {
      this.$store.commit('setPanelStatus', {
        key: 'billingAddress',
        value: value,
      });
      this.$store.commit('setPanelStatus', {
        key: 'paymentDetails',
        value: 'collapse',
      });
    },
    submitBillingForm() {
      this.$store
        .dispatch('postBillingAddress')
        .then(response => {
          this.$store.commit('setOrderTotal', response.data.order.total);
          this.$store.commit('setOrderTax', response.data.order.vat);
          this.$store.commit('setPanelStatus', {
            key: 'billingAddress',
            value: 'view',
          });
          this.$store.commit('setPanelStatus', {
            key: 'paymentDetails',
            value: 'edit',
          });
        })
        .catch(error => {
          this.errors = error.response.data;
        });
    },
    submitPaymentForm() {
      this.paymentStatus = '';
      CandyEvent.$emit('submitPayment');
    },
  },
};
</script>
