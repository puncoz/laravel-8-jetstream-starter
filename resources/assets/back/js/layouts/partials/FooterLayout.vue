<template>
    <footer class="block py-4 font-normal text-sm text-gray-500">
        <div class="container mx-auto px-4">
            <hr class="mb-4 border-b-1 border-gray-300">

            <div class="flex flex-wrap items-center md:justify-between justify-center">
                <div class="w-full md:w-4/12 px-4">
                    <div class="flex flex-wrap md:justify-start justify-center py-1">
                        <span>Copyright © {{ $page.app.copyright_year }}</span>
                        <a :href="$page.app.main_url" target="_blank" class="hover:opacity-75 font-semibold px-1">
                            <logo type="text"/>
                        </a>
                    </div>
                </div>

                <div class="w-full md:w-8/12 px-4">
                    <ul class="flex flex-wrap list-none md:justify-end  justify-center">
                        <li>
                            <a :href="$page.app.support_url"
                               class="hover:text-gray-900 block py-1 px-3">
                                Support
                            </a>
                        </li>

                        <li>
                            <p class="py-1 px-3 block">
                                Powered by
                                <a :href="$page.app.developer.link" class="text-gray-700 hover:text-gray-900" v-text="$page.app.developer.name"/>
                            </p>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </footer>
</template>

<script type="text/ecmascript-6">
    import Logo from "../../components/Logo"

    export default {
        name: "FooterLayout",

        components: { Logo },
    }
</script>
