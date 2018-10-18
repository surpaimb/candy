<template>
    <div style="display: inline-block;">
        <select class="selectpicker hidden-xs" v-model="change">
            <option data-icon="fa fa-gbp" value='{"code": "GBP", "symbol": "£"}'>GBP</option>
            <option data-icon="fa fa-eur" value='{"code": "EUR", "symbol": "€"}'>EUR</option>
        </select>
    </div>
</template>

<script>

    export default {
        computed: {
            change: {
                get () {
                    return currency;
                },
                set (value) {
                    this.$store.dispatch('changeCurrency', value)
                    .then(response => {
                        location.reload();
                    });
                }
            }
        }
    }
</script>
