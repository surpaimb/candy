<template>
    <div style="display: inline-block;">
        <select class="selectpicker hidden-xs" v-model="change">
            <option class="en" value='en'>English</option>
            <option class="fr" value='fr'>Français</option>
        </select>
    </div>
</template>

<script>

    export default {
        computed: {
            change: {
                get () {
                    return language;
                },
                set (value) {
                    this.$store.dispatch('changeLanguage', value)
                    .then(response => {
                        location.reload();
                    });
                }
            }
        }
    }
</script>
