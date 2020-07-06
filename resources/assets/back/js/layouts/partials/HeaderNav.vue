<template>
    <nav class="absolute top-0 left-0 w-full z-10 bg-transparent md:flex-row md:flex-no-wrap md:justify-start flex items-center p-4">
        <div class="w-full mx-auto items-center flex justify-end md:flex-no-wrap flex-wrap md:px-10 px-4">
            <div class="flex-col md:flex-row list-none items-center hidden md:flex">
                <user-menus/>
            </div>
        </div>
    </nav>
</template>

<script type="text/ecmascript-6">
    import UserMenus from "./UserMenus"

    export default {
        name: "HeaderNav",

        components: { UserMenus },
    }
</script>
