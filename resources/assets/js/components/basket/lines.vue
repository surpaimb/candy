<template>
    <div>

        <div class="basket-lines" v-if="basket.lines.length">
            <div class="row product-row" v-for="line in basket.lines" :key="line.id">
                <div class="col-xs-12 col-sm-2 basket-img">
                    <img :src="thumbnail(line)" :alt="line.name">
                </div>
                <div class="col-xs-12 col-sm-4">

                    <a :href="'/product/'+line.slug">{{ line.name }}</a><br>
                    <small v-for="(option,key) in line.variant.options" :key="key"><strong>{{ key | capitalize }}:</strong> {{ option.en }} </small>
                </div>
                <div class="col-xs-12 col-sm-2">
                    <div class="numeric numeric-lg">
                        {{ linePrice(line)|currency }}
                    </div>
                </div>
                <div class="col-xs-12 col-sm-2 quantity">
                    <label class="sr-only">Quantity</label>
                    <input min="0" max="9999" type="number" class="form-control" v-model="line.quantity">
                </div>
                <div class="col-xs-12 col-sm-1 line-total">
                    <div class="numeric">{{ line.total | currency }}</div>
                </div>
                <div class="col-xs-12 col-sm-1 remove-line text-right">
                    <button class="btn btn-xs btn-red" @click="removeLine(line)"> X </button>
                </div>
            </div>

            <div class="text-right">
                <button class="btn btn-grey btn-sm" @click="emptyBasket">Empty Basket</button>
                <button class="btn btn-blue btn-sm" @click="updateBasket">Update Basket</button>
            </div>

        </div>

        <div v-else class="empty-basket text-center">
            <strong>You have no products in your basket</strong>
        </div>

    </div>
</template>

<script>
    export default {
        computed: {
            basket() {
                return this.$store.state.basket;
            },
            basketCount() {
                return this.$store.getters.basketCount;
            },
            product() {
                return this.$store.getters.basketCount;
            }
        },
        methods: {
            linePrice(line) {
                let tiers = line.variant.tiers.data;

                if (tiers.length) {
                    let prices = _.filter(tiers, tier => {
                        return line.quantity >= tier.lower_limit;
                    });
                    prices = _.orderBy(prices, 'lower_limit', 'desc');
                    if (prices[0]) {
                        return prices[0].price;
                    }
                }
                return line.variant.price;
            },
            candyThumbnail: function(data) {
                return Candy.thumbnail(data);
            },
            thumbnail(line) {
                if (_.has(line.variant, 'thumbnail.data')) {
                    return line.variant.thumbnail.data.thumbnail;
                } else if (_.has(line, 'thumbnail.data')) {
                    return line.thumbnail.data.thumbnail;
                }
                return '/images/no-image.png';
            },
            updateBasket: function(data) {
                return this.$store.dispatch('updateBasket');
            },
            emptyBasket: function(data) {
                return this.$store.dispatch('emptyBasket');
            },
            removeLine: function(line) {
                return this.$store.dispatch('removeFromBasket', line);
            }
        }
    }
</script>
