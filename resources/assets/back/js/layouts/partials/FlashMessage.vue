<template>
    <div class="border-0 fixed px-6 py-4 rounded text-white z-10 notification" :class="notificationClass">
        <span class="text-xl inline-block mr-5 align-middle">
            <i class="fas fa-bell"/>
        </span>
        <span class="inline-block align-middle mr-8">
            <b class="capitalize" v-text="message"/>
        </span>
        <button class="absolute bg-transparent text-2xl font-semibold leading-none right-0 top-0 mt-4 mr-6 outline-none focus:outline-none">
            <span @click="hideFlashMessage">×</span>
        </button>
    </div>
</template>

<script>
    import { get } from "lodash"

    export default {
        props: {
            type: { default: "success", type: String },
            message: { required: true, type: String },
        },
        computed: {
            notificationClass() {
                const notificationClass = {
                    success: "bg-green",
                    error: "bg-red",
                    info: "bg-blue",
                    warning: "bg-yellow",
                }
                return get(notificationClass, this.type, "bg-black");
            },
        },
        mounted() {
            setTimeout(() => {
                this.hideFlashMessage();
            }, 5000)
        },
        methods: {
            hideFlashMessage() {
                this.$emit("hide-flash-message")
            },
        },
    }
</script>

<style scoped>

</style>
