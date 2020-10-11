<template>
    <form-section @submitted="updateProfileInformation">
        <template #title>
            Profile Information
        </template>

        <template #description>
            Update your account's profile information and email address.
        </template>

        <template #form>
            <!-- Profile Photo -->
            <div v-if="$page.jetstream.managesProfilePhotos" class="col-span-6 sm:col-span-4">
                <!-- Profile Photo File Input -->
                <input ref="photo"
                       type="file"
                       class="hidden"
                       accept=".jpg,.jpeg,.png"
                       @change="updatePhotoPreview">

                <label-component for="photo" text="Photo"/>

                <!-- Current Profile Photo -->
                <div v-show="!photoPreview" class="mt-2">
                    <img :src="$page.user.profile_photo_url"
                         alt="Current Profile Photo"
                         class="rounded-full h-20 w-20 object-cover">
                </div>

                <!-- New Profile Photo Preview -->
                <div v-show="photoPreview" class="mt-2">
                    <span class="block rounded-full w-20 h-20"
                          :style="`background-size: cover; background-repeat: no-repeat;
                                background-position: center center;
                                background-image: url('${photoPreview}');`"/>
                </div>

                <secondary-button class="mt-2 mr-2" type="button" @click.native.prevent="selectNewPhoto">
                    Select A New Photo
                </secondary-button>

                <secondary-button v-if="$page.user.profile_photo_path"
                                  type="button"
                                  class="mt-2"
                                  @click.native.prevent="deletePhoto">
                    Remove Photo
                </secondary-button>

                <input-error :message="form.error('photo')" class="mt-2"/>
            </div>

            <!-- Name -->
            <div class="col-span-6 sm:col-span-4">
                <label-component for="name" text="Name"/>
                <input-component id="name"
                                 v-model="form.name"
                                 type="text"
                                 class="mt-1 block w-full"
                                 autocomplete="name"/>
                <input-error :message="form.error('name')" class="mt-2"/>
            </div>

            <!-- Email -->
            <div class="col-span-6 sm:col-span-4">
                <label-component for="email" text="Email"/>
                <input-component id="email" v-model="form.email" type="email" class="mt-1 block w-full"/>
                <input-error :message="form.error('email')" class="mt-2"/>
            </div>

            <!-- Username -->
            <div class="col-span-6 sm:col-span-4">
                <label-component for="username" text="Username"/>
                <input-component id="username" v-model="form.username" type="text" class="mt-1 block w-full"/>
                <input-error :message="form.error('username')" class="mt-2"/>
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
    import SecondaryButton from "./../../../Components/SecondaryButton"

    export default {
        name: "UpdateProfileInformationForm",

        components: {
            ActionMessage,
            ButtonComponent,
            FormSection,
            InputComponent,
            InputError,
            LabelComponent,
            SecondaryButton,
        },

        props: {
            name: { type: String, required: true },
            email: { type: String, required: true },
            username: { type: String, required: true },
        },

        data() {
            return {
                form: this.$inertia.form({
                    _method: "PUT",
                    name: this.name,
                    username: this.username,
                    email: this.email,
                    photo: null,
                }, {
                    bag: "updateProfileInformation",
                    resetOnSuccess: false,
                }),

                photoPreview: null,
            }
        },

        methods: {
            updateProfileInformation() {
                if (this.$refs.photo) {
                    this.form.photo = this.$refs.photo.files[0]
                }

                this.form.post(this.route("user-profile-information.update"), {
                    preserveScroll: true,
                })
            },

            selectNewPhoto() {
                this.$refs.photo.click()
            },

            updatePhotoPreview() {
                const reader = new FileReader()

                reader.onload = (e) => {
                    this.photoPreview = e.target.result
                }

                reader.readAsDataURL(this.$refs.photo.files[0])
            },

            deletePhoto() {
                this.$inertia.delete(this.route("current-user-photo.destroy"), {
                    preserveScroll: true,
                }).then(() => {
                    this.photoPreview = null
                })
            },
        },
    }
</script>
