<template>

    <div>
        <div class="input-group">

            <input name="search" @keyup.enter="Search" v-model="keywords" class="form-control search-control" placeholder="Search product by name or reference..." />
            <span class="input-group-btn">
                <button class="btn btn-green" type="button" @click="Search"><i class="fa fa-search" aria-hidden="true"></i></button>
            </span>

        </div>

        <div class="search-autocomplete active" v-show="showResults">

            <ul>
                <li v-for="result in results" :key="result.objectID"><a :href="'/product/'+result.slug" title="">{{ candyAttribute(result, 'name') }}</a></li>
            </ul>

        </div>
    </div>

</template>

<script>
    export default {
        data() {
            return {
                keywords: '',
                results: [],
                showResults: false
            }
        },
        methods: {
            Search: function() {
                var query = this.keywords.replace(" ", "+");
                location.href = '/search?q=' + query;
            },
            candyAttribute: function(data, attribute) {
                return Candy.attribute(data,attribute);
            }
        }
    }
</script>
