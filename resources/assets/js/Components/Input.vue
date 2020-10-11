<template>
    <input ref="input"
           class="form-input rounded-md shadow-sm"
           :value="value"
           @input="$emit('input', $event.target.value)">
</template>

<script>
    export default {
        name: "InputComponent",

        props: {
            value: { type: [Number, String], required: false, default: null },
        },

        methods: {
            focus() {
                this.$refs.input.focus()
            },
        },
    }
</script>
