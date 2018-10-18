<template>
    <div class="row totals-area" v-if="basket.lines.length">
        <div class="total-basket">
            <div class="col-xs-6">
                Basket Total
            </div>
            <div class="col-xs-6 text-right">
                <div class="numeric numeric-lg">{{ basketTotal | currency }}</div>
            </div>
        </div>

        <div class="total-promotion-discount" v-show="hasDiscount">
            <hr>

            <div v-for="discount in basketDiscounts.data">
                <div class="col-xs-8 text-left">
                    {{ candyAttribute(discount, 'name') }} - <a href="javascript:void(0);" class="text-danger" @click="removeDiscount(discount['id'])">Remove</a>
                </div>
                <div class="col-xs-4 text-right">
                    <div v-for="reward in discount.rewards.data">
                        {{ candyReward(reward) }}
                    </div>
                </div>
            </div>

            <hr>
        </div>

        <div class="total-vat">
            <div class="col-xs-6">
                VAT Total
            </div>
            <div class="col-xs-6 text-right">
                <div class="numeric numeric-lg">{{ taxTotal | currency }}</div>
            </div>
        </div>

        <div class="total-order">
            <div class="col-xs-6">
                Order Total
            </div>
            <div class="col-xs-6 text-right">
                <div class="numeric numeric-lg">{{ basketTotal | currency }}</div>
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
            basketCount() {
                return this.$store.getters.basketCount;
            },
            basketTotal() {
                return this.$store.getters.basketTotal;
            },
            taxTotal() {
                return this.$store.getters.taxTotal;
            },
            hasDiscount() {
                return this.$store.getters.hasDiscount;
            }
        },
        methods: {
            candyReward: function(data) {
                return Candy.reward(data);
            },
            candyAttribute: function(data, attr) {
                return Candy.attribute(data, attr);
            },
            removeDiscount: function(discountId) {
                this.$store.dispatch('removeDiscount', discountId)
                    .catch(error => {
                        this.errors = error.response.data.errors;
                    });
            }
        }
    }
</script>
