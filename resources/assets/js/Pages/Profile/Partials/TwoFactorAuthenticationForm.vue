<template>
    <action-section>
        <template #title>
            Two Factor Authentication
        </template>

        <template #description>
            Add additional security to your account using two factor authentication.
        </template>

        <template #content>
            <h3 v-if="twoFactorEnabled" class="text-lg font-medium text-gray-900">
                You have <strong>enabled</strong> two factor authentication.
            </h3>

            <h3 v-else class="text-lg font-medium text-gray-900">
                You have <strong>not enabled</strong> two factor authentication.
            </h3>

            <div class="mt-3 max-w-xl text-sm text-gray-600">
                <p>
                    When two factor authentication is enabled, you will be prompted for a secure, random token during
                    authentication. You may retrieve this token from your phone's Google Authenticator application.
                </p>
            </div>

            <div v-if="twoFactorEnabled">
                <div v-if="qrCode">
                    <div class="mt-4 max-w-xl text-sm text-gray-600">
                        <p class="font-semibold">
                            Two factor authentication is now enabled. Scan the following QR code using your phone's
                            authenticator application.
                        </p>
                    </div>

                    <div class="mt-4" v-html="qrCode"/> <!-- eslint-disable-line vue/no-v-html -->
                </div>

                <div v-if="recoveryCodes.length > 0">
                    <div class="mt-4 max-w-xl text-sm text-gray-600">
                        <p class="font-semibold">
                            Store these recovery codes in a secure password manager. They can be used to recover access
                            to your account if your two factor authentication device is lost.
                        </p>
                    </div>

                    <div class="grid gap-1 max-w-xl mt-4 px-4 py-4 font-mono text-sm bg-gray-100 rounded-lg">
                        <div v-for="(code, index) in recoveryCodes" :key="index">
                            {{ code }}
                        </div>
                    </div>
                </div>
            </div>

            <div class="mt-5">
                <div v-if="! twoFactorEnabled">
                    <confirms-password @confirmed="enableTwoFactorAuthentication">
                        <button-component type="button" :class="{ 'opacity-25': enabling }" :disabled="enabling">
                            Enable
                        </button-component>
                    </confirms-password>
                </div>

                <div v-else>
                    <confirms-password @confirmed="regenerateRecoveryCodes">
                        <secondary-button v-if="recoveryCodes.length > 0" class="mr-3">
                            Regenerate Recovery Codes
                        </secondary-button>
                    </confirms-password>

                    <confirms-password @confirmed="showRecoveryCodes">
                        <secondary-button v-if="recoveryCodes.length === 0" class="mr-3">
                            Show Recovery Codes
                        </secondary-button>
                    </confirms-password>

                    <confirms-password @confirmed="disableTwoFactorAuthentication">
                        <danger-button
                            :class="{ 'opacity-25': disabling }"
                            :disabled="disabling">
                            Disable
                        </danger-button>
                    </confirms-password>
                </div>
            </div>
        </template>
    </action-section>
</template>

<script>
    import Api              from "../../../Utils/Api"
    import ActionSection    from "./../../../Components/ActionSection"
    import ButtonComponent  from "./../../../Components/Button"
    import ConfirmsPassword from "./../../../Components/ConfirmsPassword"
    import DangerButton     from "./../../../Components/DangerButton"
    import SecondaryButton  from "./../../../Components/SecondaryButton"

    export default {
        name: "TwoFactorAuthenticationForm",

        components: {
            ActionSection,
            ButtonComponent,
            ConfirmsPassword,
            DangerButton,
            SecondaryButton,
        },

        data() {
            return {
                enabling: false,
                disabling: false,

                qrCode: null,
                recoveryCodes: [],
            }
        },

        computed: {
            twoFactorEnabled() {
                return !this.enabling && this.$page.user.two_factor_enabled
            },
        },

        methods: {
            enableTwoFactorAuthentication() {
                this.enabling = true

                // @todo route name is not available in vendor package
                this.$inertia.post("/user/two-factor-authentication", {}, {
                    preserveScroll: true,
                }).then(() => {
                    return Promise.all([
                        this.showQrCode(),
                        this.showRecoveryCodes(),
                    ])
                }).then(() => {
                    this.enabling = false
                })
            },

            async showQrCode() {
                // @todo route name is not available in vendor package
                const response = await Api.get("/user/two-factor-qr-code")

                this.qrCode = response.body.svg
            },

            async showRecoveryCodes() {
                // @todo route name is not available in vendor package
                const response = await Api.get("/user/two-factor-recovery-codes")

                this.recoveryCodes = response.body
            },

            async regenerateRecoveryCodes() {
                // @todo route name is not available in vendor package
                await Api.post("/user/two-factor-recovery-codes")
                await this.showRecoveryCodes()
            },

            disableTwoFactorAuthentication() {
                this.disabling = true

                // @todo route name is not available in vendor package
                this.$inertia.delete("/user/two-factor-authentication", {
                    preserveScroll: true,
                }).then(() => {
                    this.disabling = false
                })
            },
        },
    }
</script>
