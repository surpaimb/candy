<template>
    <div>
        <span :class="stockClass">{{ stockMsg }}</span>
    </div>
</template>

<script>
    export default {
        computed: {
            product() {
                return this.$store.state.product;
            },
            stock() {
                return this.product.variant.inventory;
            },
            stockClass() {
                if (this.stock > 2) {
                    return 'stock-level in-stock';
                } else if (this.stock > 0) {
                    return 'stock-level low-stock';
                } else {
                    return 'stock-level out-of-stock';
                }
            },
            stockMsg() {
                if (this.stock > 2) {
                    return 'In Stock';
                } else if (this.stock > 0) {
                    return 'Low Stock';
                } else {
                    return 'Out Of Stock';
                }
            }
        }
    }
</script>
