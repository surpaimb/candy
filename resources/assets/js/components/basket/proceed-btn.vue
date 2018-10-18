<template>
    <div>
        <div class="text-right">
            <button class="btn btn-lg btn-green" v-if="basket.lines.length" @click="proceed">Proceed to Checkout</button>
        </div>
    </div>
</template>

<script>
    export default {
        props: {
            loggedIn: {
                type: String,
                default: false
            }
        },
        computed: {
            basketCount() {
                return this.$store.getters.basketCount;
            },
            basket() {
                return this.$store.state.basket;
            }
        },
        methods: {
            proceed() {
                if (this.loggedIn == '1') {
                    window.location.href = '/checkout';
                } else {
                    CandyEvent.$emit('showProceedModal');
                }
            }
        }
    }
</script>
