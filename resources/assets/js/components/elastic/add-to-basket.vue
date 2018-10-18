<template>
    <div>
        <div class="product-qty-price">
            <div class="form-group product-qty" v-show="!productHasVariants">
                <label class="sr-only">Quantity</label>
                <input min="1" max="99" type="number" class="form-control" v-model="quantity">
            </div>
            <div class="product-price">
                <div class="numeric numeric-lg">{{ product.min_price | currency  }}</div>
                <span class="vat">{{ vatLabel }}.<br>VAT</span>
            </div>
        </div>
        <a :href="'/product/'+ candyRoute(product)" class="btn btn-grey add-to-basket_summary" v-if="productHasVariants || !productHasInventory">View Options</a>
        <a href="javascript:void(0)" class="btn btn-green add-to-basket_summary" @click="addToBasket(product)" v-if="!productHasVariants && productHasInventory">Add to Basket</a>
    </div>
</template>

<script>
    export default {
        props: {
            product: {
                type: Object,
                default: ''
            }
        },
        data() {
            return {
                selected: {},
                quantity: 1
            }
        },
        computed: {
            storedProduct() {
                return this.$store.state.product;
            },
            vatLabel() {
                return this.$store.getters.vatLabel;
            },
            productHasVariants: function() {
                if (this.product.variant_count > 1) {
                    return true;
                }
                return false;
            },
            productHasInventory: function(data) {
                if (_.has(this.product, 'first_variant.data')) {
                    return (this.product.first_variant.data.inventory > 0)
                }
                return false;
            }
        },
        methods: {
            addToBasket: function() {
                this.storedProduct.quantity = this.quantity;
                this.updateVariant();

                // Build Basket Line
                this.$store.commit('setProduct', this.product);
                this.$store.dispatch('addToBasket', this.storedProduct)
                .then(response => {
                    CandyEvent.$emit('addedToBasket');
                });
            },
            updateVariant: function() {
                var defaultVariant = this.product.first_variant.data;
                var _this = this;

                if (defaultVariant.options.length == 0) {
                    this.$store.commit('setProductVariant', defaultVariant);
                } else {
                    $.each(defaultVariant.options, function(key, value) {
                        _this.selected[key] = value;
                    });
                    this.$store.commit('setProductVariant', Candy.mapVariant(this.product.first_variant, this.selected));
                }
            },
            candyRoute: function(data) {
                return Candy.route(data);
            }
        }
    }
</script>
