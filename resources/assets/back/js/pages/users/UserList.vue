<template>
    <layout title="User Management">
        <template v-slot:actions>
            <inertia-link :href="route('back.users.create')"
                          class="bg-gray-900 focus:outline-none hover:opacity-75
                          hover:shadow-md outline-none px-4 py-2 rounded shadow text-white text-xs uppercase"
                          style="transition: all .15s ease;">
                <i class="mr-1 fas fa-plus"/> Add new user
            </inertia-link>
        </template>

        <template v-slot>
            <div class="relative flex flex-col min-w-0 break-words w-full mb-6 rounded justify-center items-center" style="min-height: 200px;">
                <data-table :table-data="$page.users" :queries="$page.queries" @loaddata="loadData">
                    <template v-slot:thead>
                        <th class="px-5 py-3 border-b-2 border-gray-200 bg-gray-100 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">
                            User
                        </th>
                        <th class="px-5 py-3 border-b-2 border-gray-200 bg-gray-100 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">
                            Accounts
                        </th>
                        <th class="px-5 py-3 border-b-2 border-gray-200 bg-gray-100 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">
                            Role
                        </th>
                        <th class="px-5 py-3 border-b-2 border-gray-200 bg-gray-100 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">
                            Registered On
                        </th>
                        <th class="px-5 py-3 border-b-2 border-gray-200 bg-gray-100 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider"/>
                    </template>

                    <template v-slot:tbody="{row: user}">
                        <td class="px-5 py-5 border-b border-gray-200 bg-white text-sm">
                            <div class="flex items-center">
                                <div class="flex-shrink-0 w-10 h-10">
                                    <user-profile-image :user="user" height="h-full" width="w-full"/>
                                </div>
                                <div class="ml-3">
                                    <p class="text-gray-900 whitespace-no-wrap">
                                        {{ user.display_name }}
                                    </p>
                                </div>
                            </div>
                        </td>

                        <td class="px-5 py-5 border-b border-gray-200 bg-white text-sm">
                            <p class="text-gray-900 whitespace-no-wrap">
                                Username: {{ user.username }}
                            </p>
                            <p class="text-gray-900 whitespace-no-wrap">
                                Email: {{ user.email }}
                            </p>
                        </td>

                        <td class="px-5 py-5 border-b border-gray-200 bg-white text-sm">
                            <p class="text-gray-900 whitespace-no-wrap">
                                {{ user.role }}
                            </p>
                        </td>

                        <td class="px-5 py-5 border-b border-gray-200 bg-white text-sm">
                            <p class="text-gray-900 whitespace-no-wrap">
                                {{ user.created_at.formatted }}
                            </p>
                        </td>

                        <td class="px-5 py-5 border-b border-gray-200 bg-white text-sm">
                            <div class="flex items-center">
                                <inertia-link :href="route('back.users.edit',user.id)"
                                              class="text-xl text-gray-500 hover:text-gray-800 inline-block mr-3"
                                              style="transition: all .15s ease;">
                                    <i class="fas fa-pen-square"/>
                                </inertia-link>

                                <button v-if="$page.auth.user.id!==user.id" v-on:click="deleteUser(user.id)"
                                        class="text-xl text-gray-500 hover:text-gray-800 inline-block mr-3 cursor-pointer inline-block outline-none"
                                        style="transition: all .15s ease;">
                                    <i class="fas fa-trash"/>
                                </button>
                            </div>
                        </td>
                    </template>
                </data-table>
            </div>
        </template>
    </layout>
</template>

<script type="text/ecmascript-6">
    import {UserProfileImage} from "../../components"
    import {DataTable} from "../../components/DataTable"
    import Layout from "../../layouts/Layout"

    export default {
        name: "UserList",

        components: {Layout, UserProfileImage, DataTable},

        data: () => ({
            user_id: 1244,
        }),

        methods: {
            loadData(query) {
                this.$inertia.visit(this.route("back.users.index"), {
                    method: "get",
                    data: query,
                    preserveState: true,
                    preserveScroll: true,
                })
            },

            deleteUser(userId) {
                this.$inertia.delete(`/users/${userId}`)
            }
        },
    }
</script>
