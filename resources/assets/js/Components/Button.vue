<template>
    <button v-if="as === 'button'"
            :type="type"
            :class="classes">
        <slot/>
    </button>

    <inertia-link v-else :method="method" :href="href" :class="classes">
        <slot/>
    </inertia-link>
</template>

<script>
    export default {
        name: "ButtonComponent",

        props: {
            type: { type: String, required: false, default: "submit" },
            as: { type: String, required: false, default: "button" },
            method: { type: String, required: false, default: "get" },
            href: { type: String, required: false, default: null },
        },

        computed: {
            classes: function() {
                return `inline-flex items-center px-4 py-2 bg-primary border border-transparent rounded-md
                        font-semibold text-xs text-white uppercase tracking-widest hover:bg-primary-shades-400
                        active:bg-primary focus:outline-none focus:border-primary focus:shadow-outline-gray
                        transition ease-in-out duration-150`
            },
        },
    }
</script>
