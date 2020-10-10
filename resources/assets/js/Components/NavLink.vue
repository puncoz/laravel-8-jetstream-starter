<template>
    <div>
        <button v-if="as === 'button'" :class="classes" class="w-full text-left">
            <slot/>
        </button>

        <inertia-link v-else :method="method" :href="href" :class="classes">
            <slot/>
        </inertia-link>
    </div>
</template>

<script>
    export default {
        name: "NavLink",

        props: {
            isResponsive: { type: Boolean, required: false, default: false },
            href: { type: String, required: false, default: "" },
            active: { type: Boolean, required: false, default: false },
            as: { type: String, required: false, default: null },
            method: { type: String, required: false, default: "get" },
        },

        computed: {
            classes() {
                if (this.isResponsive) {
                    return this.active
                        ? `block pl-3 pr-4 py-2 border-l-4 border-tertiary text-base font-bold text-primary
                            bg-white focus:outline-none focus:text-primary focus:bg-white
                            focus:border-tertiary transition duration-150 ease-in-out`
                        : `block pl-3 pr-4 py-2 border-l-4 border-transparent text-base font-medium text-primary
                            hover:text-primary hover:bg-tertiary hover:border-tertiary focus:outline-none
                            focus:text-primary focus:bg-white focus:border-tertiary transition duration-150
                            ease-in-out`
                }

                return this.active
                    ? `inline-flex items-center px-2 pt-4 border-b-4 border-tertiary text-sm font-bold leading-5
                        text-primary focus:outline-none focus:border-tertiary transition duration-150 ease-in-out`
                    : `inline-flex items-center px-2 pt-4 border-b-4 border-transparent text-sm font-medium leading-5
                        text-primary hover:text-primary hover:border-tertiary focus:outline-none focus:text-primary
                        focus:white transition duration-150 ease-in-out`
            },
        },
    }
</script>
