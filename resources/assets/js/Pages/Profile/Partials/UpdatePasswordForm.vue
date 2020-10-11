<template>
    <form-section @submitted="updatePassword">
        <template #title>
            Update Password
        </template>

        <template #description>
            Ensure your account is using a long, random password to stay secure.
        </template>

        <template #form>
            <div class="col-span-6 sm:col-span-4">
                <label-component for="current_password" text="Current Password"/>
                <input-component id="current_password"
                                 ref="current_password"
                                 v-model="form.current_password"
                                 type="password"
                                 class="mt-1 block w-full"
                                 autocomplete="current-password"/>
                <input-error :message="form.error('current_password')" class="mt-2"/>
            </div>

            <div class="col-span-6 sm:col-span-4">
                <label-component for="password" text="New Password"/>
                <input-component id="password"
                                 v-model="form.password"
                                 type="password"
                                 class="mt-1 block w-full"
                                 autocomplete="new-password"/>
                <input-error :message="form.error('password')" class="mt-2"/>
            </div>

            <div class="col-span-6 sm:col-span-4">
                <label-component for="password_confirmation" text="Confirm Password"/>
                <input-component id="password_confirmation"
                                 v-model="form.password_confirmation"
                                 type="password"
                                 class="mt-1 block w-full"
                                 autocomplete="new-password"/>
                <input-error :message="form.error('password_confirmation')" class="mt-2"/>
            </div>
        </template>

        <template #actions>
            <action-message :on="form.recentlySuccessful" class="mr-3">
                Saved.
            </action-message>

            <button-component :class="{ 'opacity-25': form.processing }" :disabled="form.processing">
                Save
            </button-component>
        </template>
    </form-section>
</template>

<script>
    import ActionMessage   from "./../../../Components/ActionMessage"
    import ButtonComponent from "./../../../Components/Button"
    import FormSection     from "./../../../Components/FormSection"
    import InputComponent  from "./../../../Components/Input"
    import InputError      from "./../../../Components/InputError"
    import LabelComponent  from "./../../../Components/Label"

    export default {
        name: "UpdatePasswordForm",

        components: {
            ActionMessage,
            ButtonComponent,
            FormSection,
            InputComponent,
            InputError,
            LabelComponent,
        },

        data() {
            return {
                form: this.$inertia.form({
                    current_password: "",
                    password: "",
                    password_confirmation: "",
                }, {
                    bag: "updatePassword",
                }),
            }
        },

        methods: {
            updatePassword() {
                this.form.put(this.route("user-password.update"), {
                    preserveScroll: true,
                }).then(() => {
                    this.$refs.current_password.focus()
                })
            },
        },
    }
</script>
