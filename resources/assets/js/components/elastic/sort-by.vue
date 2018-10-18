<template>
    <div class="sort form-inline">

        <div class="form-group">
            <label><span class="list-label">Sort by</span>
                <span class="custom-select">

                    <select class="form-control custom-dropdown" v-model="search.sortBy" @change="reload">
                        <option value="">Relevance</option>
                        <option value="created_at-desc">Newest Items First</option>
                        <option value="name-asc">Alphabetically: A to Z</option>
                        <option value="name-desc">Alphabetically: Z to A</option>
                        <option value="min_price-desc">Price: High to Low</option>
                        <option value="min_price-asc">Price: Low to High</option>
                    </select>

                </span>
            </label>
        </div>

    </div>
</template>

<script>

    export default {
        computed: {
            search() {
                return this.$store.state.search;
            }
        },
        created() {
            /* Broke Internet Explorer
            var urlParams = new URLSearchParams(window.location.search);

            if (urlParams.has('sortby')) {
                this.$store.commit('setSortBy', urlParams.get('sortby'));
            }*/
        },
        methods: {
            reload(value) {
                this.$store.commit('setCurrentPage', 1);
                this.$store.dispatch('updateSearchResults');
            }
        }
    }
</script>
