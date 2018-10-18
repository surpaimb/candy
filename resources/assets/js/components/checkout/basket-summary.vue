<template>
    <!-- This column to be positioned inline with whatever stage of the ckecout you are on -->
    <div class="checkout-panel active">
        <p class="h4">Basket Summary</p>

        <div class="basket-row" v-for="line in basket.lines" :key="line.id">
            <div class="basket-img">
                <img :src="candyThumbnail(line.thumbnail)" :alt="line.name">
            </div>
            <div class="basket-content">
                <p class="product-name">{{ line.name }}</p>
                <small v-for="(option,key) in line.variant.options" :key="key"><strong>{{ key | capitalize }}:</strong> {{ option.en }} </small>
                <div class="product-details">
                    <div class="quantity">
                        Qty {{ line.quantity }}
                    </div>
                    <div class="cost">
                        <div class="numeric numeric-lg">{{ line.total | currency  }}</div>
                    </div>
                </div>
            </div>
        </div>

        <div class="basket-summary">

            <div class="delivery" v-show="deliveryMethod.shipping_method.length > 0">
                <div class="row">
                    <div class="col-xs-6 col-sm-7">
                        {{ deliveryMethod.shipping_method }}
                    </div>
                    <div class="col-xs-6 col-sm-5">
                        <div class="numeric numeric-lg">{{ deliveryMethod.shipping_total | currency  }}</div>
                    </div>
                </div>
            </div>
            <div class="total-promotion-discount" v-show="hasDiscount" v-for="discount in basketDiscounts.data" :key="discount.id">
                <div class="row">
                    <div class="col-xs-8 text-left">
                        <strong>Discount Code: </strong>
                        {{ candyAttribute(discount, 'name') }}
                    </div>
                    <div class="col-xs-4 text-right">
                        <div v-for="reward in discount.rewards.data" :key="reward.id">
                            {{ candyReward(reward) }}
                        </div>
                    </div>
                </div>
            </div>
<!--
            <div class="row">
                <div class="col-xs-6 col-sm-7">
                    Promotion Discount
                </div>
                <div class="col-xs-6 col-sm-5">
                    -<span class="numeric">10</span><small>%</small>
                </div>
            </div>
-->
            <div class="row">
                <div class="col-xs-6 col-sm-7">
                    VAT Total
                </div>
                <div class="col-xs-6 col-sm-5">
                    <div class="numeric numeric-lg">{{ taxTotal | currency  }}</div>
                </div>
            </div>

            <div class="row order-total">
                <div class="col-xs-6 col-sm-7">
                    Order Total
                </div>
                <div class="col-xs-6 col-sm-5">
                    <div class="numeric numeric-lg">{{ orderTotal | currency  }}</div>
                </div>
            </div>

        </div>
    </div>
</template>

<script>
    export default {
        computed: {
            basket() {
                return this.$store.state.basket;
            },
            basketDiscounts() {
                return this.$store.getters.basketDiscounts;
            },
            deliveryMethod() {
                return this.$store.state.order.deliveryMethod;
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
            taxTotal() {
                return this.$store.getters.orderTax;
            },
            hasDiscount() {
                return true;
            }
        },
        methods: {
            candyThumbnail: function(data) {
                return Candy.thumbnail(data);
            },
            candyAttribute: function(data, attribute) {
                return Candy.attribute(data, attribute);
            },
            candyReward: function(reward) {
                return Candy.reward(reward);
            }
        }
    }
</script>
