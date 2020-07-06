<template>
    <nav class="md:left-0 md:block md:fixed md:top-0 md:bottom-0 md:overflow-y-auto md:flex-row md:flex-no-wrap md:overflow-hidden shadow-xl bg-white flex flex-wrap items-center justify-between relative md:w-64 z-10 py-4 px-6">
        <div class="md:flex-col md:items-stretch md:min-h-full md:flex-no-wrap px-0 flex flex-wrap items-center justify-between w-full mx-auto">
            <button class="cursor-pointer text-secondary opacity-50 md:hidden px-3 py-1 text-xl leading-none bg-transparent rounded border border-solid border-transparent"
                    type="button"
                    @click="showResponsiveMenus">
                <i class="fas fa-bars"/>
            </button>

            <inertia-link class="md:block md:pb-2 mr-0 inline-block px-0"
                          :href="route('back.dashboard')">
                <logo type="img"/>
            </inertia-link>

            <div class="md:hidden items-center flex flex-wrap list-none">
                <div class="inline-block relative">
                    <user-menus bg-color="bg-primary" text-color="text-white"/>
                </div>
            </div>

            <side-menus :show-responsive-menus="isResponsiveMenusEnabled" @hideResponsiveMenus="hideResponsiveMenus"/>
        </div>
    </nav>
</template>

<script type="text/ecmascript-6">
    import Logo      from "../../components/Logo"
    import SideMenus from "./SideMenus"
    import UserMenus from "./UserMenus"

    export default {
        name: "Sidebar",

        components: { UserMenus, Logo, SideMenus },

        data: () => ({
            isResponsiveMenusEnabled: false,
        }),

        methods: {
            showResponsiveMenus() {
                this.$set(this, "isResponsiveMenusEnabled", true)
            },

            hideResponsiveMenus() {
                this.$set(this, "isResponsiveMenusEnabled", false)
            },
        },
    }
</script>
