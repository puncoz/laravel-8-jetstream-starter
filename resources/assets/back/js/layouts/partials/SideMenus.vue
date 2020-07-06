<template>
    <div class="md:flex md:flex-col md:items-stretch md:opacity-100 md:relative md:mt-4 md:shadow-none shadow absolute top-0 left-0 right-0 z-40 overflow-y-auto overflow-x-hidden h-auto items-center flex-1 rounded"
         :class="{'hidden': !showResponsiveMenus, ' bg-white m-2 py-3 px-6': showResponsiveMenus}">
        <div class="md:min-w-full md:hidden block pb-4 mb-4 border-b border-solid border-gray-300">
            <div class="flex flex-wrap">
                <div class="w-6/12">
                    <inertia-link class="md:block md:pb-2 mr-0 inline-block p-4 px-0"
                                  :href="route('back.dashboard')">
                        <logo type="img"/>
                    </inertia-link>
                </div>

                <div class="w-6/12 flex justify-end">
                    <button type="button"
                            class="cursor-pointer opacity-50 md:hidden px-3 py-1 text-xl leading-none bg-transparent rounded border border-solid border-transparent"
                            @click="$emit('hideResponsiveMenus')">
                        <i class="fas fa-times"/>
                    </button>
                </div>
            </div>
        </div>

        <ul class="md:flex-col md:min-w-full flex flex-col list-none">
            <menu-item label="Dashboard" :href="route('back.dashboard')" pattern="back.dashboard" icon="fa-tv"/>
        </ul>

        <hr class="my-4 md:min-w-full">

        <h6 class="md:min-w-full text-gray-600 text-xs uppercase font-bold block pt-1 pb-4 no-underline">
            Modules
        </h6>

        <ul class="md:flex-col md:min-w-full flex flex-col list-none md:mb-4">
            <menu-item label="Users" :href="route('back.users.index')" pattern="back.users.*" icon="fa-user-circle"/>
        </ul>
    </div>
</template>

<script type="text/ecmascript-6">
    import Logo     from "../../components/Logo"
    import MenuItem from "./MenuItem"

    export default {
        name: "SideMenus",

        components: { Logo, MenuItem },

        props: {
            showResponsiveMenus: { type: Boolean, required: false, default: false },
        },
    }
</script>
