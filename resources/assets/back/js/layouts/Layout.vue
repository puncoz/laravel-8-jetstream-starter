<template>
    <main>
        <sidebar/>

        <div class="relative md:ml-64 bg-gray-100">
            <header-nav/>

            <div class="relative bg-primary md:pt-20 pb-32 pt-12">
                <div class="px-4 md:px-10 mx-auto w-full">
                    <div class="w-full xl:w-8/12 px-4 flex flex-wrap items-center">
                        <h1 class="font-bold mr-6 text-md uppercase text-white" v-html="title"/> <!-- eslint-disable-line vue/no-v-html -->
                        <slot name="actions"/>
                    </div>
                </div>
            </div>

            <div class="px-4 md:px-10 mx-auto w-full -m-24" style="height: calc(100vh - 157px);">
                <div class="flex flex-wrap">
                    <div class="w-full px-4">
                        <template v-for="(message, type) in notification">
                            <FlashMessage v-if="shouldShowFlashMessage(type)"
                                          :type="type"
                                          :message="message"
                                          @hide-flash-message="hideFlashMessage(type)"/>
                        </template>
                        <slot/>
                    </div>
                </div>

                <footer-layout/>
            </div>
        </div>
    </main>
</template>

<script type="text/ecmascript-6">
    import FooterLayout from "./partials/FooterLayout"
    import HeaderNav from "./partials/HeaderNav"
    import Sidebar from "./partials/Sidebar"
    import FlashMessage from "./partials/FlashMessage";

    export default {
        name: "Layout",

        components: {FooterLayout, HeaderNav, Sidebar, FlashMessage},

        props: {
            title: {type: String, required: false, default: "Dashboard"},
        },

        data() {
            return {
                notification: {},
            }
        },
        watch: {
            title: {
                handler(title) {
                    document.title = this.prepareDocumentTitle(title)
                },
                immediate: true,
            },
            "$page.flash": {
                handler(notification) {
                    this.notification = notification;
                },
                deep: true,
                immediate: true,
            },
        },

        mounted() {
            window.Bus.$on("notification", this.notificationEventHandler)
        },

        methods: {
            prepareDocumentTitle(title) {
                return `${title} | ${this.$page.app.name}`
            },
            hideFlashMessage(type) {
                this.notification = {...this.notification, [type]: null}
            },
            shouldShowFlashMessage(type) {
                // eslint-disable-next-line no-prototype-builtins
                return this.notification.hasOwnProperty(type) && this.notification[type]
            },
            notificationEventHandler({message, type}) {
                this.notification = {...this.notification, [type]: message}
            },
        },
    }
</script>
