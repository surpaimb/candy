<template>
    <div>

        <slot :show="!hasResults && !loading">
            <!-- Used to show snapshot SEO results -->
        </slot>

        <div v-for="(chunk,index) in chunkedResults" :key="index" v-show="hasResults">
            <div class="row">

                <div class="col-xs-12 col-md-6" v-for="result in chunk" :key="result.id">
                    <div class="element product-box listing">
                        <div class="row">
                            <div class="col-xs-5">
                                <a :href="'/product/'+ candyRoute(result)" class="product-img">
                                    <img :src="candyThumbnail(result['thumbnail'])" :alt="candyAttribute(result, 'name')">
                                </a>
                            </div>
                            <div class="col-xs-7">
                                <div class="product-details">
                                    <a :href="'/product/'+ candyRoute(result)" class="product-title">
                                        {{ candyAttribute(result, 'name') }}
                                    </a>
                                    <search-add-to-basket :product="result"></search-add-to-basket>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

            </div>
        </div>

        <div class="loading" v-show="loading">
            <span><i class="fas fa-spinner fa-spin fa-3x fa-fw"></i></span> <strong>Loading</strong>
        </div>

        <div class="no-results" v-if="!loading && !hasResults && !staticListings">
            <h4 v-if="keywords">No results for: {{ keywords }}</h4>
            <h2 v-if="!keywords" class="text-center">Sorry we could not find any results matching this category.</h2>
            <p v-if="hasSuggestions && keywords">
                Did you mean: <a v-for="suggestion in results.meta.suggestions.name" :href="'/search?q='+ suggestion.text" :key="suggestion.text">{{ suggestion.text }}</a>
            </p>
        </div>

    </div>
</template>
<script>

    export default {
        data() {
            return {
                loaded: false
            }
        },
        props: {
            keywords: {
                type: String,
                default: ''
            },
            category: {
                type: String,
                default: null
            },
            page: {
                type: [String, Number],
                default: 1
            },
            display: {
                type: [String, Number],
                default: 10
            },
            sortBy: {
                type: String,
                default: ''
            },
            staticListings: {
                type: Number,
                default: 0
            },
            staticMeta: {
                type: Object,
                default: {}
            }
        },
        created() {

            if(!_.isEmpty(this.page)) {
                this.$store.commit('setCurrentPage', this.page);
            }
            if(!_.isEmpty(this.display)) {
                this.$store.commit('setPerPage', this.display);
            }
            if (!_.isEmpty(this.category)) {
                this.$store.commit('updateAppliedFilters', [{name: 'categories', value: this.category}]);
            }
            if(!_.isEmpty(this.keywords)) {
                this.$store.commit('setKeywords', this.keywords);
            }
            if(!_.isEmpty(this.sortBy)) {
                this.$store.commit('setSortBy', this.sortBy);
            }
            if(!this.staticListings) {
                this.$store.dispatch('updateSearchResults')
                    .then(response => {
                        this.loaded = true;
                    });
            } else {
                this.$store.commit('setPagination', this.staticMeta);
                this.$store.commit('setFilters', this.staticMeta);
            }

        },
        computed: {
            results() {
                return this.$store.getters.searchResults;
            },
            pagination() {
                return this.$store.getters.searchPagination;
            },
            filters() {
                return this.$store.state.search.appliedFilters;
            },
            chunkedResults() {
                return this.$store.getters.searchChunkedResults;
            },
            hasResults() {
                return this.$store.getters.searchHasResults;
            },
            loading() {
                return this.$store.getters.searchLoading;
            },
            hasSuggestions() {
                return this.$store.getters.searchHasSuggestions;
            },
            vatLabel() {
                return (this.$store.state.vat == true) ? 'Inc' : 'Exc';
            }
        },
        methods: {
            candyAttribute: function(data, attribute) {
                return Candy.attribute(data,attribute);
            },
            candyRoute: function(data) {
                return Candy.route(data);
            },
            candyThumbnail: function(data) {
                return Candy.thumbnail(data);
            }
        }
    }
</script>
