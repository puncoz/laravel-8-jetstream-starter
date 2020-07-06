<template>
    <layout title="Edit User">
        <div class="relative min-w-0 break-words bg-white w-full mb-6 shadow-lg rounded p-10" style="min-height: 200px;">
            <div class="rounded rounded-t-lg overflow-hidden shadow max-w-xs my-3">
                <img src="https://i.imgur.com/dYcYQ7E.png" class="w-full"/>
                <div class="flex justify-center -mt-8">
                    <img src="https://i.imgur.com/8Km9tLL.jpg" class="rounded-full border-solid border-white border-2 -mt-3">
                </div>
                <div class="text-center px-3 pb-6 pt-2">
                    <h3 class="text-black text-sm bold font-sans" v-text="`${(user.full_name.first_name)?user.full_name.first_name:''} ${(user.full_name.middle_name)?user.full_name.middle_name:''} ${(user.full_name.last_name)?user.full_name.last_name:''} `"></h3>
                    <p class="mt-2 font-sans font-light text-grey-dark" v-text="user.email"></p>
                    <p class="mt-2 font-sans font-light text-grey-dark" v-text="user.username"></p>
                </div>
                <div class="flex justify-center pb-3 text-grey-dark">

                </div>
            </div>
        </div>
    </layout>
</template>

<script type="text/ecmascript-6">
    import Layout from "../../layouts/Layout"

    export default {
        name: "UserView",

        components: {Layout},

        props: {user: Object},

        watch: {},

        data: () => ({}),

        computed: {},

        mounted() {
        },

        methods: {},
    }
</script>
