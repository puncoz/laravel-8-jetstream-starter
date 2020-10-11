<template>
    <div>
        <nav-link :is-responsive="isResponsive"
                  :href="route('dashboard')"
                  class="flex"
                  :active="$page.currentRouteName === 'dashboard'">
            Dashboard
        </nav-link>

        <nav-link :is-responsive="isResponsive"
                  href="#"
                  class="flex"
                  :active="$page.currentRouteName === 'profile'">
            Profile
        </nav-link>
    </div>
</template>

<script type="text/ecmascript-6">
    import NavLink from "../Components/NavLink"

    export default {
        name: "NavMenu",

        components: { NavLink },

        props: {
            isResponsive: { type: Boolean, required: false, default: false },
        },
    }
</script>
