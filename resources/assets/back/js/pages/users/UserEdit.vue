<template>
    <layout title="Edit User">
        <div class="relative min-w-0 break-words bg-white w-full mb-6 shadow-lg rounded p-10" style="min-height: 200px;">
            <form class="w-full max-w-xl" @submit.prevent="submit">
                <div class="flex flex-wrap -mx-3 mb-6">
                    <div class="w-full px-3 mb-6 md:mb-0">
                        <label class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2" for="first_name">
                            Full Name
                        </label>
                        <input id="first_name"
                               v-model="form.full_name"
                               class="appearance-none block w-full bg-gray-200 text-gray-700 border border-red-500 rounded py-3 px-4 mb-3 leading-tight focus:outline-none focus:bg-white"
                               type="text"
                               placeholder="Jane Doe">
                        <p v-if="$page.errors.has('full_name')" class="text-danger text-xs italic">
                            {{ $page.errors.get('full_name') }}
                        </p>
                    </div>
                </div>

                <div class="flex flex-wrap -mx-3 mb-6">
                    <div class="w-full md:w-1/2 px-3 mb-6 md:mb-0">
                        <label class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2" for="email">
                            Email
                        </label>
                        <input id="email"
                               v-model="form.email"
                               class="appearance-none block w-full bg-gray-200 text-gray-700 border border-red-500 rounded py-3 px-4 mb-3 leading-tight focus:outline-none focus:bg-white"
                               type="email"
                               placeholder="Jane.doe@example.com">
                        <p v-if="$page.errors.has('email')" class="text-danger text-xs italic">
                            {{ $page.errors.get('email') }}
                        </p>
                    </div>
                    <div class="w-full md:w-1/2 px-3">
                        <label class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2" for="username">
                            Username
                        </label>
                        <input id="username"
                               v-model="form.username"
                               class="appearance-none block w-full bg-gray-200 text-gray-700 border border-gray-200 rounded py-3 px-4 leading-tight focus:outline-none focus:bg-white focus:border-gray-500"
                               type="text"
                               placeholder="jane.doe">
                        <p v-if="$page.errors.has('username')" class="text-danger text-xs italic">
                            {{ $page.errors.get('username') }}
                        </p>
                    </div>
                </div>

                <div class="flex flex-wrap -mx-3 mb-6">
                    <div class="w-full md:w-1/2 px-3 mb-6 md:mb-0">
                        <label class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2" for="role">
                            Role
                        </label>

                        <div class="relative">
                            <select id="role" v-model="form.role" class="block appearance-none w-full bg-gray-200 border border-gray-200 text-gray-700 py-3 px-4 pr-8 rounded leading-tight focus:outline-none focus:bg-white focus:border-gray-500">
                                <option v-for="option in Roles" :value="option">
                                    {{ option }}
                                </option>
                            </select>
                            <div class="pointer-events-none absolute inset-y-0 right-0 flex items-center px-2 text-gray-700">
                                <svg class="fill-current h-4 w-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20">
                                    <path d="M9.293 12.95l.707.707L15.657 8l-1.414-1.414L10 10.828 5.757 6.586 4.343 8z"/>
                                </svg>
                            </div>
                        </div>

                        <p v-if="$page.errors.has('role')" class="text-danger text-xs italic">
                            {{ $page.errors.get('role') }}
                        </p>
                    </div>
                </div>

                <div class="flex flex-wrap -mx-3 mb-6">
                    <div class="w-full px-3">
                        <label class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2" for="password">
                            Password
                        </label>
                        <input id="password"
                               v-model="form.password"
                               class="appearance-none block w-full bg-gray-200 text-gray-700 border border-gray-200 rounded py-3 px-4 mb-3 leading-tight focus:outline-none focus:bg-white focus:border-gray-500"
                               type="password"
                               placeholder="******************">
                        <p class="text-gray-600 text-xs italic">
                            Make it as long and as crazy as you'd like
                        </p>
                        <p v-if="$page.errors.has('password')" class="text-danger text-xs italic">
                            {{ $page.errors.get('password') }}
                        </p>
                    </div>
                </div>
                <div class="flex flex-wrap -mx-3 mb-6">
                    <div class="w-full px-3">
                        <label class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2" for="confirm_password">
                            Password Confirmation
                        </label>
                        <input id="confirm_password"
                               v-model="form.password_confirmation"
                               class="appearance-none block w-full bg-gray-200 text-gray-700 border border-gray-200 rounded py-3 px-4 mb-3 leading-tight focus:outline-none focus:bg-white focus:border-gray-500"
                               type="password"
                               placeholder="******************">
                        <p class="text-gray-600 text-xs italic">
                            Make it as long and as crazy as you'd like
                        </p>
                        <p v-if="$page.errors.has('password')" class="text-danger text-xs italic">
                            {{ $page.errors.get('password') }}
                        </p>
                    </div>
                </div>
                <div class="flex flex-wrap -mx-3 mb-2">
                    <div class="w-full md:w-1/3 px-3 mb-6 md:mb-0">
                        <button
                            class="bg-primary text-white text-white
                                 font-semibold py-2 px-4 border border-primary rounded shadow">
                            Update
                        </button>
                    </div>
                </div>
            </form>
        </div>
    </layout>
</template>

<script type="text/ecmascript-6">
    import Layout from "../../layouts/Layout"

    export default {
        name: "UserEdit",

        components: { Layout },

        props: { user: Object, Roles: Array },
        data: () => ({
            form: {
                full_name: null,
                email: null,
                username: null,
                password: null,
                role: null,
                password_confirmation: null,
            },
        }),

        watch: {
            user: {
                immediate: true,
                handler(user) {
                    this.form.full_name = `${user.full_name.first_name} ${(user.full_name.middle_name) ? user.full_name.middle_name : ""} ${user.full_name.last_name}`;
                    this.form.email = user.email
                    this.form.username = user.username
                    this.form.role = user.roles[0].name
                },
            },
        },

        computed: {},

        mounted() {
        },

        methods: {
            submit() {
                this.$inertia.put(`/users/${this.user.id}`, this.form)
            },
        },
    }
</script>
