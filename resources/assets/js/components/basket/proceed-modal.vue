<template>

    <modal title="Checkout" v-show="showModal" size="modal-md" @closed="showModal = false">
        <div slot="body">
            <div class="tab-content">
                <div role="tabpanel" :class="{'tab-pane':true, 'active':!showLogin}" v-show="!showLogin">
                    <a class="proceed-checkout-close" @click="showModal = false"><span aria-hidden="true">&times;</span></a>
                    <div class="modal-body checkout">
                        <div class="proceed-checkout-bk">
                            <p class="modal_call-out">New customer?</p>
                            <a href="/checkout" class="btn btn-green">Continue to Checkout</a>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <small>Do you already have an account?</small>
                        <a href="javascript:void(0);" @click="showLogin = true">Login &amp; Checkout</a>
                    </div>
                </div>
                <div role="tabpanel" :class="{'tab-pane':true, 'active':showLogin}" v-show="showLogin">
                    <div class="modal-header">
                        <button type="button" class="close" @click="showModal = false"><span aria-hidden="true">&times;</span></button>
                        <h3>Account Login</h3>
                    </div>
                    <div class="modal-body login">

                        <transition name="fade">
                            <div class="alert alert-danger" role="alert" v-show="showError">Invalid Email Address or Password</div>
                        </transition>

                        <form @submit.prevent="submitForm">
                            <div class="form-group">
                                <label>Your Email Address</label>
                                <input v-model="loginData.email" type="email" class="form-control">
                            </div>
                            <div class="form-group">
                                <label>Password</label>
                                <input v-model="loginData.password" type="password" class="form-control">
                            </div>
                            <div class="row">
                                <div class="col-xs-12 col-sm-6">
                                    <div class="checkbox">
                                        <label>
                                        <input v-model="loginData.remember" type="checkbox"> Remember me
                                        </label>
                                    </div>
                                </div>
                                <div class="col-xs-12 col-sm-6 text-right">
                                    <a href="/forgotten-password" class="forgotten-password">Forgotten your password?</a>
                                    <button type="submit" class="btn btn-green">Login &amp; Checkout</button>
                                </div>
                            </div>
                        </form>
                    </div>
                    <div class="modal-footer">
                        <small>Don't have an account? <a href="/checkout">Simply checkout</a></small>
                    </div>
                </div>
            </div>
        </div>
    </modal>

</template>

<script>
    export default {
        data() {
            return {
                showModal: false,
                showLogin: false,
                showError: false,
                loginData: {
                    email: '',
                    password: '',
                    remember: false
                }
            }
        },
        mounted() {
            var $this = this;
            CandyEvent.$on('showProceedModal', function() {
                $this.showLogin = false;
                $this.showModal = true;
            });
        },
        methods: {
            submitForm() {
                this.showError = false;
                axios({
                    method: 'post',
                    url: '/login',
                    data: this.loginData
                })
                .then(response => {
                    window.location.replace("/checkout");
                }).catch(error => {
                    this.showError = true;
                });
            }
        }
    }
</script>