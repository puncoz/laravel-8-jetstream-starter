<template>
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex justify-between h-16">
            <div class="flex flex-1">
                <!-- Logo -->
                <div class="flex-shrink-0 flex items-center">
                    <inertia-link :href="route('dashboard')">
                        <logo class="block h-10 w-auto"/>
                    </inertia-link>
                </div>

                <!-- Navigation Links -->
                <div class="hidden sm:flex flex-1 justify-around">
                    <nav-menu class="space-x-8 sm:-my-px sm:flex"/>
                </div>
            </div>

            <!-- Settings Dropdown -->
            <user-menu/>

            <!-- Hamburger -->
            <div class="-mr-2 flex items-center sm:hidden">
                <button
                    class="inline-flex items-center justify-center p-2 rounded-md text-gray-400 hover:text-gray-500
                        hover:bg-gray-100 focus:outline-none focus:bg-gray-100 focus:text-gray-500 transition
                        duration-150 ease-in-out"
                    @click="showingNavigationDropdown = ! showingNavigationDropdown">
                    <svg class="h-6 w-6" stroke="currentColor" fill="none" viewBox="0 0 24 24">
                        <path
                            :class="{'hidden': showingNavigationDropdown, 'inline-flex': ! showingNavigationDropdown }"
                            stroke-linecap="round"
                            stroke-linejoin="round"
                            stroke-width="2"
                            d="M4 6h16M4 12h16M4 18h16"/>
                        <path
                            :class="{'hidden': ! showingNavigationDropdown, 'inline-flex': showingNavigationDropdown }"
                            stroke-linecap="round"
                            stroke-linejoin="round"
                            stroke-width="2"
                            d="M6 18L18 6M6 6l12 12"/>
                    </svg>
                </button>
            </div>
        </div>

        <!-- Responsive Navigation Menu -->
        <div :class="{'block': showingNavigationDropdown, 'hidden': ! showingNavigationDropdown}" class="sm:hidden">
            <nav-menu :is-responsive="true" class="pt-2 pb-3 space-y-1"/>

            <!-- Responsive Settings Options -->
            <div class="pt-4 pb-1 border-t border-gray-200">
                <div class="flex items-center px-4">
                    <div class="flex-shrink-0">
                        <img class="h-10 w-10 rounded-full"
                             :src="$page.props.user.profile_photo_url"
                             :alt="$page.props.user.name">
                    </div>

                    <div class="ml-3">
                        <div class="font-medium text-base text-gray-800">
                            {{ $page.props.user.name }}
                        </div>
                        <div class="font-medium text-sm text-gray-500">
                            {{ $page.props.user.email }}
                        </div>
                    </div>
                </div>

                <div class="mt-3 space-y-1">
                    <nav-link :is-responsive="true"
                              :href="route('profile.show')"
                              :active="$page.props.currentRouteName === 'profile.show'">
                        Account Setting
                    </nav-link>

                    <nav-link v-if="$page.props.jetstream.hasApiFeatures"
                              :is-responsive="true"
                              :href="route('api-tokens.index')"
                              :active="$page.props.currentRouteName === 'api-tokens.index'">
                        API Tokens
                    </nav-link>

                    <!-- Authentication -->
                    <nav-link :is-responsive="true" :href="route('logout')" method="post">
                        Logout
                    </nav-link>

                    <!-- Team Management -->
                    <template v-if="$page.props.jetstream.hasTeamFeatures">
                        <div class="border-t border-gray-200"/>

                        <div class="block px-4 py-2 text-xs text-gray-400">
                            Manage Team
                        </div>

                        <!-- Team Settings -->
                        <nav-link :is-responsive="true"
                                  :href="route('teams.show', $page.props.user.current_team)"
                                  :active="$page.props.currentRouteName === 'teams.show'">
                            Team Settings
                        </nav-link>

                        <nav-link v-if="$page.props.jetstream.canCreateTeams"
                                  :is-responsive="true"
                                  :href="route('teams.create')"
                                  :active="$page.props.currentRouteName === 'teams.create'">
                            Create New Team
                        </nav-link>

                        <div class="border-t border-gray-200"/>

                        <!-- Team Switcher -->
                        <div class="block px-4 py-2 text-xs text-gray-400">
                            Switch Teams
                        </div>

                        <template v-for="team in $page.props.user.all_teams">
                            <form :key="team.id" @submit.prevent="switchToTeam(team)">
                                <nav-link :is-responsive="true" as="button">
                                    <div class="flex items-center">
                                        <svg v-if="team.id === $page.props.user.current_team_id"
                                             class="mr-2 h-5 w-5 text-green-400"
                                             fill="none"
                                             stroke-linecap="round"
                                             stroke-linejoin="round"
                                             stroke-width="2"
                                             stroke="currentColor"
                                             viewBox="0 0 24 24">
                                            <path d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/>
                                        </svg>

                                        <div>{{ team.name }}</div>
                                    </div>
                                </nav-link>
                            </form>
                        </template>
                    </template>
                </div>
            </div>
        </div>
    </div>
</template>

<script type="text/ecmascript-6">
    import Logo     from "../Components/Logo"
    import NavLink  from "../Components/NavLink"
    import NavMenu  from "./NavMenu"
    import UserMenu from "./UserMenu"

    export default {
        name: "TopNavBar",

        components: {
            NavMenu,
            UserMenu,
            Logo,
            NavLink,
        },

        data: () => ({
            showingNavigationDropdown: false,
        }),

        methods: {
            switchToTeam(team) {
                this.$inertia.put(this.route("current-team.update"), {
                    team_id: team.id,
                }, {
                    preserveState: false,
                })
            },
        },
    }
</script>
