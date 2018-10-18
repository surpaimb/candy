<template>
    <div>

        <a href="/basket" title="Go to your basket">
            <div class="store-img">
                <span class="count">{{ basketCount  }}</span>
                <i class="fa fa-shopping-basket store-icon" aria-hidden="true"></i>
            </div>
            <div class="store-txt">
                <div class="numeric">{{ basketTotal | currency }}</div>
            </div>
        </a>

    </div>
</template>

<script>
    export default {
        computed: {
            basketCount() {
                return this.$store.getters.basketCount;
            },
            basketTotal() {
                return this.$store.getters.basketTotal;
            }
        }
    }
</script>
