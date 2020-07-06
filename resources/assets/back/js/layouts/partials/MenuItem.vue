<template>
    <li class="items-center">
        <inertia-link class="text-sm capitalize py-3 font-bold block"
                      :class="activeClass"
                      :href="href">
            <i class="fas opacity-75 mr-2 text-sm" :class="icon"/>
            {{ label }}
        </inertia-link>
    </li>
</template>

<script type="text/ecmascript-6">
    export default {
        name: "MenuItem",

        props: {
            href: { type: String, required: true },
            label: { type: String, required: true },
            icon: { type: String, required: false, default: "" },
            pattern: { type: String, required: false, default: null },
        },

        data: () => ({
            polling: null,
            isActive: false,
        }),

        computed: {
            activeClass: function() {
                return this.isActive || this.$route().current(this.pattern || this.href) ? "text-primary hover:opacity-75" : "text-gray-800 hover:text-gray-600"
            },
        },

        mounted() {
            this.polling = setInterval(() => {
                this.isActive = this.$route().current(this.pattern || this.href)
            }, 100)
        },

        beforeDestroy() {
            this.polling = null
        },
    }
</script>
