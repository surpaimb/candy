<template>
    <div>

        <span class="error" v-for="(error,index) in errors" :key="index">{{ error }}</span>

    </div>
</template>

<script>
    export default {
        props: {
            errors: {
                type: Array,
                default: []
            }
        }
    }
</script>
