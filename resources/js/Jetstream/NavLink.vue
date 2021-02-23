<template>
    <inertia-link :href="href" :class="classes">
        <slot></slot>
    </inertia-link>
</template>

<script>
    export default {
        props: ['href', 'active'],

        computed: {
            classes() {
                return this.active
                            ? 'inline-flex items-center px-1 pt-1 border-b-2 border-pink-400 text-sm font-medium leading-5 text-pink-300 focus:outline-none focus:border-pink-700 transition duration-150 ease-in-out'
                            : 'inline-flex items-center px-1 pt-1 border-b-2 border-transparent text-sm font-medium leading-5 text-gray-200 hover:text-pink-300 hover:border-pink-300 focus:outline-none focus:text-pink-700 focus:border-pink-300 transition duration-150 ease-in-out'
            }
        }
    }
</script>
