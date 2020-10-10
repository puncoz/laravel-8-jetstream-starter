<template>
    <label class="block font-medium text-sm text-gray-700">
        <span v-if="text">{{ text }}</span>
        <span v-else><slot/></span>

        <span v-if="required" class="text-danger-500">*</span>
    </label>
</template>

<script>
    export default {
        name: "LabelComponent",

        props: {
            text: { type: String, required: false, default: null },
            required: { type: Boolean, required: false, default: false },
        },
    }
</script>
