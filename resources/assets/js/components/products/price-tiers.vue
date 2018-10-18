<template>
    <div>
        <template v-if="tiers.length">
            <table class="table tier-table">
                <thead>
                    <tr>
                        <th>Quantity</th>
                        <th>Price per unit</th>
                        <th></th>
                    </tr>
                </thead>
                <tbody>
                    <tr :class="{ 'current': current() }">
                        <td>1 - {{ upperLimit() }}</td>
                        <td>{{ variant.price|currency }} <small class="text-muted">{{ vatLabel }} Vat.</small></td>
                        <td><div v-if="current()"><i class="fa fa-check"></i></div></td>
                    </tr>
                    <tr v-for="tier in tiers" :key="tier.id" :class="{ 'current': current(tier) }">
                        <td>
                            {{ tier.lower_limit }}
                            <template v-if="upperLimit(tier) < 9999999999999"> - {{ upperLimit(tier) }}</template>
                            <span v-else>+</span>
                        </td>
                        <td>{{ tier.price|currency }} <small class="text-muted">{{ vatLabel }} Vat.</small></td>
                        <td>
                            <div v-if="current(tier)"><i class="fa fa-check"></i></div>
                        </td>
                    </tr>
                </tbody>
            </table>
        </template>
    </div>
</template>

<script>
    export default {
        data() {
            return {
            }
        },
        methods: {
            current(tier) {
                if (!tier) {
                    return this.product.quantity < this.tiers[0].lower_limit;
                }
                return this.product.quantity <= this.upperLimit(tier) && this.product.quantity >= tier.lower_limit;
            },
            upperLimit(tier) {

                if (!tier) {
                    return this.tiers[0].lower_limit - 1;
                }

                let currentIndex = this.tiers.indexOf(tier),
                    nextTier = this.tiers[currentIndex + 1],
                    nextQuantity = 9999999999999;

                if (nextTier) {
                    nextQuantity = nextTier.lower_limit - 1;
                }

                return nextQuantity;
            }
        },
        computed: {
            vatLabel() {
                return this.$store.getters.vatLabel;
            },
            tiers() {
                return this.variant.tiers.data;
            },
            product() {
                return this.$store.state.product;
            },
            variant() {
                return this.product.variant;
            }
        }
    }
</script>
