<template>
    <app-layout page-title="Account Setting" :full-width="true">
        <div>
            <div class="max-w-7xl mx-auto">
                <update-profile-information-form
                    :name="$page.user.name"
                    :username="$page.user.username"
                    :email="$page.user.email"/>

                <section-border/>

                <update-password-form class="mt-10 sm:mt-0"/>

                <div v-if="$page.jetstream.canManageTwoFactorAuthentication">
                    <section-border/>

                    <two-factor-authentication-form class="mt-10 sm:mt-0"/>
                </div>

                <section-border/>

                <logout-other-browser-sessions-form :sessions="sessions" class="mt-10 sm:mt-0"/>
            </div>
        </div>
    </app-layout>
</template>

<script>
    import SectionBorder                  from "./../../Components/SectionBorder"
    import AppLayout                      from "./../../Layouts/AppLayout"
    import LogoutOtherBrowserSessionsForm from "./Partials/LogoutOtherBrowserSessionsForm"
    import TwoFactorAuthenticationForm    from "./Partials/TwoFactorAuthenticationForm"
    import UpdatePasswordForm             from "./Partials/UpdatePasswordForm"
    import UpdateProfileInformationForm   from "./Partials/UpdateProfileInformationForm"

    export default {
        name: "ProfileSettings",

        components: {
            UpdateProfileInformationForm,
            AppLayout,
            SectionBorder,
            LogoutOtherBrowserSessionsForm,
            TwoFactorAuthenticationForm,
            UpdatePasswordForm,
        },

        props: {
            sessions: { type: Array, required: true },
        },
    }
</script>
