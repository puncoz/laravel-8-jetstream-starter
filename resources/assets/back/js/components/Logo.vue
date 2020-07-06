<template>
    <span>
        <img v-if="type === 'img'" src="../../img/logo.png" :alt="$page.app.name" style="height: 30px;">
        <span v-if="type === 'text'" v-html="$page.app.name_formatted"/> <!-- eslint-disable-line vue/no-v-html -->
    </span>
</template>

<script type="text/ecmascript-6">
    export default {
        name: "Logo",

        props: {
            type: { type: String, required: false, default: "text" },
        },
    }
</script>
