<template>
    <div>

        <div class="element aside filter-options">
            <div class="title">Filters - {{ appliedFiltersCount }} applied <button type="button" class="btn btn-text" @click="clearAppliedFilters">Clear All</button></div>


            <div class="filter-list">
                <div v-for="(filter, filterName) in filters" :key="filterName">

                    <p class="filter-title">{{ filterName|capitalize }}</p>
                    <div class="checkbox" v-for="filterData in filter['data']" :key="filterData.id">
                        <label :class="{'hidden' : isHidden(filterData.id)}">
                            <input type="checkbox" :value="{name: filterName, value: filterData.id}" v-model="updateAppliedFilters">
                            <span>{{ candyAttribute(filterData, 'name') }}</span>
                        </label>
                    </div>

                </div>
            </div>

        </div>

    </div>
</template>

<script>

    export default {
        data() {
            return {
                hasHidden: false,
                prevClass: 'btn btn-sm btn-light-blue',
                nextClass: 'btn btn-sm btn-light-blue'
            }
        },
        props: {
            parentCategory: {
                type: String,
                default: null
            }
        },
        computed: {
            filters() {
                return this.$store.getters.searchFilters;
            },
            appliedFiltersCount() {
                let filterCount = this.$store.getters.searchAppliedFilterCount;
                if (this.hasHidden) {
                    filterCount = filterCount - 1;
                }
                return filterCount;
            },
            updateAppliedFilters: {
                get () {
                    return this.$store.state.search.appliedFilters
                },
                set (value) {
                    this.$store.commit('updateAppliedFilters', value);
                    this.$store.dispatch('updateSearchResults');
                }
            }
        },
        methods: {
            candyAttribute(data, attribute) {
                return Candy.attribute(data,attribute);
            },
            isHidden(id) {
                this.hasHidden = true;
                return this.parentCategory && this.parentCategory == id;
            },
            clearAppliedFilters() {
                this.$store.dispatch('clearAppliedFilters');
            }
        }
    }
</script>
