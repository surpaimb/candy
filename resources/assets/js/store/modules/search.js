const state = {
    keywords: {},
    pagination: {
        current_page: 1,
        per_page: 10
    },
    sortBy: '',
    filters: {},
    appliedFilters: [],
    results: {
        data: [],
        meta: []
    },
    loading: false
}

const mutations = {
    setKeywords(state, keywords) {
        state.keywords = keywords;
    },
    setResults(state, data) {
        state.results = data;
    },
    setPagination(state, data) {
        state.pagination = data.pagination;
    },
    setCurrentPage(state, page) {
        state.pagination.current_page = page;
    },
    setPerPage(state, display) {
        state.pagination.per_page = Number(display);
    },
    setSortBy(state, sortBy) {
        state.sortBy = sortBy;
    },
    setFilters(state, data) {
        state.filters = data.aggregation;
    },
    updateAppliedFilters(state, value) {
        state.appliedFilters = value;
    },
    updateKeywords(state, value) {
        state.keywords = value;
    },
    addPage(state) {
        state.pagination.current_page ++;
    },
    subtractPage(state) {
        state.pagination.current_page --;
    },
    setLoading(state, value) {
        state.loading = value;
    }
}

const getters = {
    searchResults(state) {
        return state.results;
    },
    searchChunkedResults(state) {
        return _.chunk(state.results.data, 2);
    },
    searchPagination(state) {
        return state.pagination;
    },
    searchFilters(state) {
        return state.filters;
    },
    searchCategoryFilters(state) {
        return state.categoryFilter;
    },
    searchAppliedFilterCount(state) {
        return state.appliedFilters.length;
    },
    searchHasResults(state) {
        if (_.has(state.results, 'data') && state.results.data.length > 0) {
            return true;
        }
        return false;
    },
    searchLoading(state) {
        return state.loading;
    },
    searchResultsTotal(state) {
        var total = 0
        if (_.has(state.results, 'meta.pagination.total')) {
            total = state.results.meta.pagination.total;
        }
        return total;
    },
    searchHasSuggestions(state) {
        if (_.has(state.results, 'meta') && _.isArray(state.results.meta.suggestions)) {
            return true;
        }
        return false;
    },
}

const actions = {
    updateSearchResults({ commit, state }) {
        state.results = {};
        state.loading = true;
        return new Promise((resolve, reject) => {
            axios({
                method: 'post',
                url: '/search',
                data: {
                    keywords: state.keywords,
                    filters: state.appliedFilters,
                    pagination: state.pagination,
                    sortBy: state.sortBy
                }
            })
            .then(response => {
                commit('setResults', response.data);
                commit('setPagination', response.data['meta']);
                commit('setFilters', response.data['meta']);
                commit('setLoading', false);
                Candy.updateQueryStringParam('page', response.data.meta.pagination['current_page']);
                Candy.updateQueryStringParam('display', response.data.meta.pagination['per_page']);
                Candy.updateQueryStringParam('sortby', state['sortBy']);
                resolve(response);
            }).catch(error => {
                commit('setLoading', false);
                reject(error);
            });
        });
    },
    goToPreviousPage({ commit, dispatch, state }) {
        if (state.pagination.current_page > 1){
            commit('subtractPage');
            dispatch('updateSearchResults');
        }
    },
    goToNextPage({ commit, dispatch, state }) {
        if (state.pagination.current_page < state.pagination.total_pages){
            commit('addPage');
            dispatch('updateSearchResults');
        }
    },
    clearAppliedFilters({ commit, dispatch, state }) {
        state.appliedFilters = [];
        commit('setCurrentPage', );
        dispatch('updateSearchResults');
    }
}

export default {
    state,
    getters,
    mutations,
    actions
}