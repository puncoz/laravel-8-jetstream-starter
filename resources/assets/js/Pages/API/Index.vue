<template>
    <app-layout page-title="Api Tokens" :full-width="true">
        <div>
            <div class="max-w-7xl mx-auto">
                <api-token-manager :tokens="tokens"
                                   :available-permissions="availablePermissions"
                                   :default-permissions="defaultPermissions"/>
            </div>
        </div>
    </app-layout>
</template>

<script>
    import AppLayout       from "./../../Layouts/AppLayout"
    import ApiTokenManager from "./Partials/ApiTokenManager"

    export default {
        name: "ApiTokens",

        components: {
            ApiTokenManager,
            AppLayout,
        },
        props: {
            tokens: { type: Array, required: true },
            availablePermissions: { type: Array, required: true },
            defaultPermissions: { type: Array, required: true },
        },
    }
</script>
