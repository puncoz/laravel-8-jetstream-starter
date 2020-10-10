<template>
    <div class="min-h-screen bg-gray-200">
        <nav class="bg-white">
            <!-- Primary Navigation Menu -->
            <top-nav-bar/>
        </nav>

        <!-- Page Heading -->
        <app-header :title="pageTitle">
            <slot name="actions"/>
        </app-header>

        <!-- Page Content -->
        <main>
            <div class="py-12">
                <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                    <div class="p-6 sm:px-20">
                        <slot/>
                    </div>
                </div>
            </div>
        </main>

        <!-- Modal Portal -->
        <portal-target name="modal" multiple/>
    </div>
</template>

<script>
    import { PortalTarget } from "portal-vue"
    import AppHeader        from "./AppHeader"
    import TopNavBar        from "./TopNavBar"

    export default {
        name: "AppLayout",

        components: {
            AppHeader,
            TopNavBar,
            PortalTarget,
        },

        props: {
            pageTitle: { type: String, required: true },
        },

        beforeMount() {
            document.title = `${this.pageTitle} | ${this.$page.props.app.name}`
        },
    }
</script>
