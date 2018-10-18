<template>

    <div class="pagination-area" v-if="totalPages > 1">

        <button type="button" :class="[{'disabled' : !prevIsActive, 'btn-light-blue' : prevIsActive}, 'btn btn-sm']" @click="goToPreviousPage">
            <i class="fa fa-angle-left" aria-hidden="true" ></i>
        </button>

        <p>Page {{ currentPage }} of {{ totalPages }}</p>

        <button type="button" :class="[{'disabled' : !nextIsActive, 'btn-light-blue' : nextIsActive}, 'btn btn-sm']" @click="goToNextPage">
            <i class="fa fa-angle-right" aria-hidden="true" ></i>
        </button>
    </div>

</template>

<script>

    export default {
        computed: {
            pagination() {
                return this.$store.state.search.pagination;
            },
            currentPage() {
                return this.$store.getters.searchPagination.current_page;
            },
            totalPages() {
                return this.$store.getters.searchPagination.total_pages;
            },
            prevIsActive() {
                if (this.currentPage > 1) {
                    return true;
                }
                return false;
            },
            nextIsActive() {
                if (this.currentPage < this.totalPages) {
                    return true;
                }
                return false;
            }
        },
        methods: {
            goToPreviousPage: function() {
                if(this.prevIsActive) {
                    this.$store.dispatch('goToPreviousPage');
                    $('html, body').animate({ scrollTop: 200 }, 'slow');
                }
            },
            goToNextPage: function(data, attribute) {
                if(this.nextIsActive) {
                    this.$store.dispatch('goToNextPage');
                    $('html, body').animate({ scrollTop: 200 }, 'slow');
                }
            }
        }
    }
</script>
