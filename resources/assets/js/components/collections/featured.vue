<template>
    <section class="row feature-row">
        <div class="col-xs-12 col-sm-6 col-md-3" v-for="product in collection.data.products.data" :key="product.id">
            <div class="element product-box">
                <a :href="'/product/'+ candyRoute(product)" class="product-img" :title="candyAttribute(product, 'name')">
                    <img :src="candyThumbnail(product['thumbnail'])" :alt="candyAttribute(product, 'name')">
                </a>
                <a :href="'/product/'+ candyRoute(product)" class="product-details" title="">
                    <span class="product-title">{{ candyAttribute(product, 'name') }}</span>
                    <span class="product-price">
                        {{ product.min_price | currency  }}
                    </span>
                </a>
            </div>
        </div>
    </section>
</template>

<script>
    export default {
        props: {
            collection: {
                type: Object,
                default: {}
            }
        },
        methods: {
            candyAttribute: function(data, attribute) {
                return Candy.attribute(data,attribute);
            },
            candyRoute: function(data) {
                return Candy.route(data);
            },
            candyThumbnail: function(data) {
                return Candy.thumbnail(data);
            }
        }
    }
</script>
