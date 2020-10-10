<template>
    <span>
        <span @click="startConfirmingPassword">
            <slot/>
        </span>

        <dialog-modal :show="confirmingPassword" @close="confirmingPassword = false">
            <template #title>
                {{ title }}
            </template>

            <template #content>
                {{ content }}

                <div class="mt-4">
                    <input-component ref="password"
                                     v-model="form.password"
                                     type="password"
                                     class="mt-1 block w-3/4"
                                     placeholder="Password"
                                     @keyup.enter.native="confirmPassword"/>

                    <input-error :message="form.error" class="mt-2"/>
                </div>
            </template>

            <template #footer>
                <secondary-button @click.native="confirmingPassword = false">
                    Nevermind
                </secondary-button>

                <button-component class="ml-2"
                                  :class="{ 'opacity-25': form.processing }"
                                  :disabled="form.processing"
                                  @click.native="confirmPassword">
                    {{ button }}
                </button-component>
            </template>
        </dialog-modal>
    </span>
</template>

<script>
    import Api             from "../Utils/Api"
    import ButtonComponent from "./Button"
    import DialogModal     from "./DialogModal"
    import InputComponent  from "./Input"
    import InputError      from "./InputError"
    import SecondaryButton from "./SecondaryButton"

    export default {
        name: "ConfirmsPassword",

        components: {
            ButtonComponent,
            DialogModal,
            InputComponent,
            InputError,
            SecondaryButton,
        },

        props: {
            title: { type: String, required: false, default: "Confirm Password" },
            content: {
                type: String,
                required: false,
                default: "For your security, please confirm your password to continue.",
            },
            button: { type: String, required: false, default: "Confirm" },
        },

        data() {
            return {
                confirmingPassword: false,

                form: this.$inertia.form({
                    password: "",
                    error: "",
                }, {
                    bag: "confirmPassword",
                }),
            }
        },

        methods: {
            async startConfirmingPassword() {
                this.form.error = ""

                const response = await Api.get(this.route("password.confirmation"))

                if (response.body.confirmed) {
                    this.$emit("confirmed")

                    return
                }

                this.confirmingPassword = true
                this.form.password = ""

                setTimeout(() => {
                    this.$refs.password.focus()
                }, 250)
            },

            async confirmPassword() {
                this.form.processing = true

                try {
                    // @todo route name is not available in vendor package
                    await Api.post("/user/confirm-password", {
                        password: this.form.password,
                    })

                    this.confirmingPassword = false
                    this.form.password = ""
                    this.form.error = ""
                    this.form.processing = false

                    this.$nextTick(() => this.$emit("confirmed"))
                } catch (error) {
                    this.form.processing = false
                    this.form.error = error.response.data.errors.password[0]
                }
            },
        },
    }
</script>
