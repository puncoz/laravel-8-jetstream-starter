<template>
    <header class="bg-primary shadow">
        <div class="max-w-7xl mx-auto py-6 px-4 sm:px-6 lg:px-8 flex justify-between items-center">
            <div>
                <h1 class="font-semibold text-xl text-white leading-tight" v-text="title"/>
            </div>

            <div>
                <slot/>
            </div>
        </div>
    </header>
</template>

<script type="text/ecmascript-6">
    export default {
        name: "AppHeader",

        props: {
            title: { type: String, required: true },
        },
    }
</script>
