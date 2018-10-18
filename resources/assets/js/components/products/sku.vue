<template>
    <div>
        <span class="product-code">Product Code: {{ product.variant.sku }}</span>
    </div>
</template>

<script>
    export default {
        computed: {
            product() {
                return this.$store.state.product;
            }
        }
    }
</script>
