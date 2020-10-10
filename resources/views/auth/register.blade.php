@section('title', 'Register')

<x-auth-layout>
    <x-common.form action="{{ route('register') }}">
        <x-auth.form-input name="email">
            <x-common.label value="{{ __('Name') }}"/>
            <x-common.input class="block mt-1 w-full"
                            type="text"
                            name="name"
                            :value="old('name')"
                            autofocus
                            autocomplete="name"/>

            <x-common.form-error name="name"/>

            <x-auth.form-input name="email" class="mt-4">
                <x-common.label value="{{ __('Email') }}"/>
                <x-common.input class="block mt-1 w-full"
                                type="email"
                                name="email"
                                :value="old('email')"
                                autocomplete="email"/>

                <x-common.form-error name="email"/>
            </x-auth.form-input>

            <x-auth.form-input name="password" class="mt-4">
                <x-common.label value="{{ __('Password') }}"/>
                <x-common.input class="block mt-1 w-full"
                                type="password"
                                name="password"
                                autocomplete="new-password"/>

                <x-common.form-error name="password"/>
            </x-auth.form-input>

            <x-auth.form-input name="password" class="mt-4">
                <x-common.label value="{{ __('Confirm Password') }}"/>
                <x-common.input class="block mt-1 w-full"
                                type="password"
                                name="password_confirmation"
                                autocomplete="new-password"/>

                <x-common.form-error name="password_confirmation"/>
            </x-auth.form-input>

            <div class="flex items-center justify-end mt-4">
                <x-auth.additional-link route="login" text="{{ __('Already registered?') }}"/>

                <x-common.button class="ml-4">
                    {{ __('Login') }}
                </x-common.button>
            </div>
        </x-auth.form-input>
    </x-common.form>
</x-auth-layout>
