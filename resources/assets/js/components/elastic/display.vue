<template>
    <div class="display form-inline">
        <div class="form-group">
            <label>
                <span class="list-label">Display</span>
                <span class="custom-select">

                    <select class="form-control custom-dropdown" v-model="pagination.per_page" @change="reload">
                        <option value="10">10</option>
                        <option value="20">20</option>
                        <option value="30">30</option>
                        <option value="40">40</option>
                    </select>

                </span>
            </label>
            <p>per page</p>
        </div>
    </div>
</template>

<script>

    export default {
        computed: {
            pagination() {
                return this.$store.state.search.pagination;
            },
            resultsTotal() {
                return this.$store.getters.searchResultsTotal;
            }
        },
        methods: {
            reload(value) {
                this.$store.commit('setCurrentPage', 1);
                this.$store.dispatch('updateSearchResults');
            }
        }
    }
</script>
