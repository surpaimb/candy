<template>
    <div :class="{ 'modal fade': true, 'in show': showModal }" id="addedToBasket" tabindex="-1" role="dialog" aria-labelledby="addedToBasket" >
        <div class="modal-dialog" role="document">
            <div class="modal-content">

                <div class="modal-header">
                    <button type="button" class="close" @click="dismissModal"><span aria-hidden="true">&times;</span></button>
                    <h3>Item has been added to your basket</h3>
                    <em><small><span class="countdown">{{ countDown }}</span> seconds till this pop-up will close...</small></em>
                </div>

                <div class="modal-body">

                    <div class="row quick-basket">
                        <div class="col-xs-12 col-sm-6 col-md-3">
                            <img class="product-thumbnail" :src="getThumbnail(product)" alt="Multi Tabs">
                        </div>
                        <div class="col-xs-12 col-sm-6 col-md-5">
                            <span class="qty">{{ product.quantity }} x </span> {{ product.name }}
                        </div>
                        <div class="col-xs-12 col-sm-6 col-md-4">
                            <div class="product-price">
                                <div class="numeric numeric-lg">{{ linePrice | currency }}</div>
                                <span class="vat">{{ vatLabel }}<br>VAT</span>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-xs-12 col-sm-6">
                            <button class="btn btn-grey btn-sm" @click="dismissModal">Continue Shopping</button>
                        </div>
                        <div class="col-xs-12 col-sm-6 text-right">
                            <a href="/basket" class="btn btn-green btn-sm">Go to Checkout</a>
                        </div>
                    </div>

                </div>

            </div>
        </div>
    </div>
</template>

<script>
    export default {
        data() {
            return {
                showModal: false,
                countDown: 5
            }
        },
        mounted() {
            var $this = this;
            CandyEvent.$on('addedToBasket', function() {
                $this.showModal = true;
                $this.countDown = 5;
                var interval = setInterval(function() {
                    $this.countDown--;
                    if ($this.countDown < 1) {
                        $this.showModal = false;
                        clearInterval(interval);
                    }
                }, 1000);
            });

        },
        computed: {
            product() {
                return this.$store.state.product;
            },
            vatLabel() {
                return this.$store.getters.vatLabel;
            },
            linePrice() {
                let tiers = this.product.variant.tiers;
                if (tiers && tiers.data.length) {
                    let prices = _.filter(tiers, tier => {
                        return this.product.quantity >= tier.lower_limit;
                    });
                    prices = _.orderBy(prices, 'lower_limit', 'desc');
                    if (prices[0]) {
                        return prices[0].price;
                    }
                }
                return this.product.variant.price;
            }
        },
        methods: {
            dismissModal: function() {
                this.showModal = false;
            },
            getThumbnail: function(product) {

                if (_.has(product, 'thumbnail')){
                    return Candy.thumbnail(_.get(product, 'thumbnail'));
                }

            }
        }
    }
</script>