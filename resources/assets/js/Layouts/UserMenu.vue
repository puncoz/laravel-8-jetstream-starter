<template>
    <div class="hidden sm:flex sm:items-center sm:ml-6">
        <div class="ml-3 relative">
            <drop-down-menu align="right" width="48">
                <template #trigger>
                    <button v-if="$page.jetstream.managesProfilePhotos"
                            class="flex text-sm border-2 border-transparent rounded-full focus:outline-none
                            focus:border-gray-300 transition duration-150 ease-in-out">
                        <img class="h-8 w-8 rounded-full object-cover"
                             :src="$page.user.profile_photo_url"
                             :alt="$page.user.name">
                    </button>

                    <button v-else
                            class="flex items-center text-sm font-medium text-gray-500 hover:text-gray-700
                                    hover:border-gray-300 focus:outline-none focus:text-gray-700
                                    focus:border-gray-300 transition duration-150 ease-in-out">
                        <span>{{ $page.user.name }}</span>

                        <span class="ml-1">
                            <svg class="fill-current h-4 w-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20">
                                <path fill-rule="evenodd"
                                      d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z"
                                      clip-rule="evenodd"/>
                            </svg>
                        </span>
                    </button>
                </template>

                <template #content>
                    <!-- Account Management -->
                    <div class="block px-4 py-2 text-xs text-gray-400">
                        Manage Account
                    </div>

                    <drop-down-link :href="route('profile.show')">
                        Account Setting
                    </drop-down-link>

                    <drop-down-link v-if="$page.jetstream.hasApiFeatures" :href="route('api-tokens.index')">
                        API Tokens
                    </drop-down-link>

                    <div class="border-t border-gray-100"/>

                    <!-- Team Management -->
                    <template v-if="$page.jetstream.hasTeamFeatures">
                        <div class="block px-4 py-2 text-xs text-gray-400">
                            Manage Team
                        </div>

                        <!-- Team Settings -->
                        <drop-down-link :href="route('teams.show', $page.user.current_team)">
                            Team Settings
                        </drop-down-link>

                        <drop-down-link v-if="$page.jetstream.canCreateTeams" :href="route('teams.create')">
                            Create New Team
                        </drop-down-link>

                        <div class="border-t border-gray-100"/>

                        <!-- Team Switcher -->
                        <div class="block px-4 py-2 text-xs text-gray-400">
                            Switch Teams
                        </div>

                        <template v-for="(team, teamIdx) in $page.user.all_teams">
                            <form :key="teamIdx" @submit.prevent="switchToTeam(team)">
                                <drop-down-link as="button">
                                    <div class="flex items-center">
                                        <svg v-if="team.id === $page.user.current_team_id"
                                             class="mr-2 h-5 w-5 text-success-400"
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
                                </drop-down-link>
                            </form>
                        </template>

                        <div class="border-t border-gray-100"/>
                    </template>

                    <!-- Authentication -->
                    <drop-down-link :href="route('logout')" method="post">
                        Logout
                    </drop-down-link>
                </template>
            </drop-down-menu>
        </div>
    </div>
</template>

<script type="text/ecmascript-6">
    import DropDownLink from "../Components/DropDownLink"
    import DropDownMenu from "../Components/DropDownMenu"

    export default {
        name: "UserMenu",

        components: {
            DropDownMenu,
            DropDownLink,
        },

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
