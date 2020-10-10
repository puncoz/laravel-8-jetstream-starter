<template>
    <button :type="type"
            class="inline-flex items-center justify-center px-4 py-2 bg-danger-600 border border-transparent
                    rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-danger-500
                    focus:outline-none focus:border-danger-700 focus:shadow-outline-red active:bg-danger-600
                    transition ease-in-out duration-150">
        <slot/>
    </button>
</template>

<script>
    export default {
        name: "DangerButton",

        props: {
            type: { type: String, required: false, default: "button" },
        },
    }
</script>
