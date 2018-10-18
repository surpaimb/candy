<template>
    <div class="vat-toggle">

        <span>Inc. <span class="vat">VAT</span></span>
        <label class="switch">
            <input name="switch-vat" type="checkbox" v-model="checked">
            <span class="slider round"></span>
        </label>
        <span>Exc. <span class="vat">VAT</span></span>

    </div>
</template>

<script>
    export default {
        props: {
            value: {
                type: Boolean,
                default: false
            }
        },
        created() {
            this.$store.commit('setExcVat', this.value);
        },
        computed: {
            checked: {
                get () {
                    return this.$store.state.store.excVat;
                },
                set (value) {
                    this.$store.dispatch('toggleVat', value)
                    .then(response => {
                        location.reload();
                    });
                }
            }
        }
    }
</script>
