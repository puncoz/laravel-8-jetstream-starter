<template>
    <div>
        <!-- Generate API Token -->
        <form-section @submitted="createApiToken">
            <template #title>
                Create API Token
            </template>

            <template #description>
                API tokens allow third-party services to authenticate with our application on your behalf.
            </template>

            <template #form>
                <!-- Token Name -->
                <div class="col-span-6 sm:col-span-4">
                    <label-component for="name" value="Name"/>
                    <input-component id="name"
                                     v-model="createApiTokenForm.name"
                                     type="text"
                                     class="mt-1 block w-full"
                                     autofocus/>
                    <input-error :message="createApiTokenForm.error('name')" class="mt-2"/>
                </div>

                <!-- Token Permissions -->
                <div v-if="availablePermissions.length > 0" class="col-span-6">
                    <label-component for="permissions" value="Permissions"/>

                    <div class="mt-2 grid grid-cols-1 md:grid-cols-2 gap-4">
                        <div v-for="(permission, permissionIdx) in availablePermissions" :key="permissionIdx">
                            <label class="flex items-center">
                                <input v-model="createApiTokenForm.permissions"
                                       type="checkbox"
                                       class="form-checkbox"
                                       :value="permission">
                                <span class="ml-2 text-sm text-gray-600">{{ permission }}</span>
                            </label>
                        </div>
                    </div>
                </div>
            </template>

            <template #actions>
                <action-message :on="createApiTokenForm.recentlySuccessful" class="mr-3">
                    Created.
                </action-message>

                <button-component :class="{ 'opacity-25': createApiTokenForm.processing }"
                                  :disabled="createApiTokenForm.processing">
                    Create
                </button-component>
            </template>
        </form-section>

        <div v-if="tokens.length > 0">
            <section-border/>

            <!-- Manage API Tokens -->
            <div class="mt-10 sm:mt-0">
                <action-section>
                    <template #title>
                        Manage API Tokens
                    </template>

                    <template #description>
                        You may delete any of your existing tokens if they are no longer needed.
                    </template>

                    <!-- API Token List -->
                    <template #content>
                        <div class="space-y-6">
                            <div v-for="(token, tokenIdx) in tokens"
                                 :key="tokenIdx"
                                 class="flex items-center justify-between">
                                <div>
                                    {{ token.name }}
                                </div>

                                <div class="flex items-center">
                                    <div v-if="token.last_used_at" class="text-sm text-gray-400">
                                        Last used {{ fromNow(token.last_used_at) }}
                                    </div>

                                    <button
                                        v-if="availablePermissions.length > 0"
                                        class="cursor-pointer ml-6 text-sm text-gray-400 underline focus:outline-none"
                                        @click="manageApiTokenPermissions(token)">
                                        Permissions
                                    </button>

                                    <button class="cursor-pointer ml-6 text-sm text-red-500 focus:outline-none"
                                            @click="confirmApiTokenDeletion(token)">
                                        Delete
                                    </button>
                                </div>
                            </div>
                        </div>
                    </template>
                </action-section>
            </div>
        </div>

        <!-- Token Value Modal -->
        <dialog-modal :show="displayingToken" @close="displayingToken = false">
            <template #title>
                API Token
            </template>

            <template #content>
                <div class="text-gray-600">
                    Please copy your new API token. For your security, it won't be shown again.
                </div>

                <div v-if="$page.jetstream.flash.token"
                     class="bg-gray-300 font-mono mt-4 px-4 py-2 rounded text-gray-800 text-sm">
                    {{ $page.jetstream.flash.token }}
                </div>
            </template>

            <template #footer>
                <secondary-button @click.native="displayingToken = false">
                    Close
                </secondary-button>
            </template>
        </dialog-modal>

        <!-- API Token Permissions Modal -->
        <dialog-modal :show="!!managingPermissionsFor" @close="managingPermissionsFor = null">
            <template #title>
                API Token Permissions
            </template>

            <template #content>
                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                    <div v-for="(permission, permissionIdx) in availablePermissions" :key="permissionIdx">
                        <label class="flex items-center">
                            <input v-model="updateApiTokenForm.permissions"
                                   type="checkbox"
                                   class="form-checkbox"
                                   :value="permission">
                            <span class="ml-2 text-sm text-gray-600">{{ permission }}</span>
                        </label>
                    </div>
                </div>
            </template>

            <template #footer>
                <secondary-button @click.native="managingPermissionsFor = null">
                    Nevermind
                </secondary-button>

                <button-component class="ml-2"
                                  :class="{ 'opacity-25': updateApiTokenForm.processing }"
                                  :disabled="updateApiTokenForm.processing"
                                  @click.native="updateApiToken">
                    Save
                </button-component>
            </template>
        </dialog-modal>

        <!-- Delete Token Confirmation Modal -->
        <confirmation-modal :show="!!apiTokenBeingDeleted" @close="apiTokenBeingDeleted = null">
            <template #title>
                Delete API Token
            </template>

            <template #content>
                Are you sure you would like to delete this API token?
            </template>

            <template #footer>
                <secondary-button @click.native="apiTokenBeingDeleted = null">
                    Nevermind
                </secondary-button>

                <danger-button class="ml-2"
                               :class="{ 'opacity-25': deleteApiTokenForm.processing }"
                               :disabled="deleteApiTokenForm.processing"
                               @click.native="deleteApiToken">
                    Delete
                </danger-button>
            </template>
        </confirmation-modal>
    </div>
</template>

<script>
    import ActionMessage     from "../../../Components/ActionMessage"
    import ActionSection     from "../../../Components/ActionSection"
    import ButtonComponent   from "../../../Components/Button"
    import ConfirmationModal from "../../../Components/ConfirmationModal"
    import DangerButton      from "../../../Components/DangerButton"
    import DialogModal       from "../../../Components/DialogModal"
    import FormSection       from "../../../Components/FormSection"
    import InputComponent    from "../../../Components/Input"
    import InputError        from "../../../Components/InputError"
    import LabelComponent    from "../../../Components/Label"
    import SecondaryButton   from "../../../Components/SecondaryButton"
    import SectionBorder     from "../../../Components/SectionBorder"

    export default {
        components: {
            DangerButton,
            ConfirmationModal,
            SecondaryButton,
            DialogModal,
            ActionSection,
            SectionBorder,
            ButtonComponent,
            ActionMessage,
            InputError,
            InputComponent,
            LabelComponent,
            FormSection,
        },

        props: {
            tokens: { type: Array, required: true },
            availablePermissions: { type: Array, required: true },
            defaultPermissions: { type: Array, required: true },
        },

        data() {
            return {
                createApiTokenForm: this.$inertia.form({
                    name: "",
                    permissions: this.defaultPermissions,
                }, {
                    bag: "createApiToken",
                    resetOnSuccess: true,
                }),

                updateApiTokenForm: this.$inertia.form({
                    permissions: [],
                }, {
                    resetOnSuccess: false,
                    bag: "updateApiToken",
                }),

                deleteApiTokenForm: this.$inertia.form(),

                displayingToken: false,
                managingPermissionsFor: null,
                apiTokenBeingDeleted: null,
            }
        },

        methods: {
            createApiToken() {
                this.createApiTokenForm.post(this.route("api-tokens.store"), {
                    preserveScroll: true,
                }).then(response => {
                    if (!this.createApiTokenForm.hasErrors()) {
                        this.displayingToken = true
                    }
                })
            },

            manageApiTokenPermissions(token) {
                this.updateApiTokenForm.permissions = token.abilities

                this.managingPermissionsFor = token
            },

            updateApiToken() {
                this.updateApiTokenForm.put(this.route("api-tokens.update", this.managingPermissionsFor), {
                    preserveScroll: true,
                    preserveState: true,
                }).then(response => {
                    this.managingPermissionsFor = null
                })
            },

            confirmApiTokenDeletion(token) {
                this.apiTokenBeingDeleted = token
            },

            deleteApiToken() {
                this.deleteApiTokenForm.delete(this.route("api-tokens.destroy", this.managingPermissionsFor), {
                    preserveScroll: true,
                    preserveState: true,
                }).then(() => {
                    this.apiTokenBeingDeleted = null
                })
            },

            fromNow(timestamp) {
                return moment(timestamp).local().fromNow()
            },
        },
    }
</script>
