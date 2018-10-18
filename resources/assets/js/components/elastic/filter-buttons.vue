<template>
    <div class="btn-group phone">
        <button type="button" class="btn btn-blue filters">Filters <small>({{ appliedFiltersCount }} applied)</small></button>
        <button type="button" class="btn btn-light-blue categories">Categories</button>
    </div>
</template>

<script>
    export default {
        data() {
            return {
                hasHidden: false,
            }
        },
        props: {
            parentCategory: {
                type: String,
                default: null
            }
        },
        computed: {
            appliedFiltersCount() {
                let filterCount = this.$store.getters.searchAppliedFilterCount;
                if (this.parentCategory) {
                    filterCount = filterCount - 1;
                }
                return filterCount;
            }
        }
    }
</script>
