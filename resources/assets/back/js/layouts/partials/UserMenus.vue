<template>
    <div>
        <div ref="userDropDownHandler" class="block" @click.stop="toggleDropDown">
            <div class="items-center flex">
                <user-profile-image :user="$page.auth.user"
                                    :bg-color="bgColor"
                                    :text-color="textColor"
                                    text-size="text-xl"
                                    :shadow="true"
                                    :randomize-color="false"/>
            </div>
        </div>

        <div ref="userDropdown"
             class="bg-white text-base z-50 float-left py-2 list-none text-left rounded shadow-lg mt-1"
             :class="{block: isDropDownVisible, hidden: !isDropDownVisible}"
             style="min-width: 12rem;">
            <inertia-link class="text-sm py-2 px-4 font-normal block w-full whitespace-no-wrap bg-transparent text-gray-800"
                          :href="route('back.dashboard')">
                My Profile
            </inertia-link>

            <inertia-link class="text-sm py-2 px-4 font-normal block w-full whitespace-no-wrap bg-transparent text-gray-800"
                          :href="route('back.dashboard')">
                Account Settings
            </inertia-link>

            <div class="h-0 my-2 border border-solid border-gray-200"/>

            <inertia-link class="text-sm py-2 px-4 font-normal block w-full whitespace-no-wrap bg-transparent text-gray-800"
                          method="post"
                          :href="route('auth.logout')">
                Logout
            </inertia-link>
        </div>
    </div>
</template>

<script type="text/ecmascript-6">
    import { createPopper }     from "@popperjs/core"
    import { UserProfileImage } from "../../components"

    export default {
        name: "UserMenus",

        components: { UserProfileImage },

        props: {
            bgColor: { type: String, required: false, default: "bg-white" },
            textColor: { type: String, required: false, default: "text-primary" },
        },

        data: () => ({
            isDropDownVisible: false,
            dropDown: null,
        }),

        mounted() {
            this.dropDown = createPopper(this.$refs.userDropDownHandler, this.$refs.userDropdown, {
                placement: "bottom-end",
            })

            document.body.addEventListener("click", this.hideDropDown)
        },

        beforeDestroy() {
            document.body.removeEventListener("click", this.hideDropDown)
        },

        methods: {
            toggleDropDown() {
                this.$set(this, "isDropDownVisible", !this.isDropDownVisible)
                this.dropDown.update()
            },

            hideDropDown() {
                this.$set(this, "isDropDownVisible", false)
            },
        },
    }
</script>
