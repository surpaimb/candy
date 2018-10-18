<template>
    <div>

        <a :href="href" :class="classes" data-lity>
            <slot></slot>
        </a>

    </div>
</template>

<script>
    import Lity from 'lity';
    export default {
        component: {
            Lity
        },
        props: {
            href: {
                type: String,
                default: ''
            },
            classes: {
                type: String,
                default: ''
            }
        },
    }
</script>
