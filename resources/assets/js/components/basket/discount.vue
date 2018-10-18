<template>
    <div>
        <form @submit.prevent="submitForm" v-if="basket.lines.length">
            <div class="form-group">
                <div class="input-group">
                    <input type="text" class="form-control form-control-sm" @keyup="reset" placeholder="Enter Promotional Code" v-model="discountCode">
                    <span class="input-group-btn">
                        <button type="submit" class="btn btn-sm btn-light-blue">Apply</button>
                    </span>
                </div>
            </div>
            <div class="alert alert-danger" v-if="errors.length">
                <p v-for="error in errors">{{ error }}</p>
            </div>
        </form>
    </div>
</template>

<script>
    export default {
        data() {
            return {
                errors: [],
                discountCode: ''
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
            reset() {
                this.errors = [];
            },
            submitForm() {
                this.errors = [];
                this.$store.dispatch('applyDiscount', this.discountCode)
                    .catch(error => {
                        this.errors = error.response.data.errors;
                    });
                this.discountCode = '';
            }
        }
    }
</script>
