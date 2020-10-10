@section('title', 'Login')

<x-auth-layout>
    <x-common.form action="{{ route('login') }}">

        <x-auth.form-input name="email">
            <x-common.label value="{{ __('Email') }}"/>
            <x-common.input class="block mt-1 w-full"
                            type="email"
                            name="email"
                            :value="old('email')"
                            autofocus/>

            <x-common.form-error name="email"/>
        </x-auth.form-input>

        <x-auth.form-input name="password" class="mt-4">
            <x-common.label value="{{ __('Password') }}"/>
            <x-common.input class="block mt-1 w-full"
                            type="password"
                            name="password"
                            autocomplete="current-password"/>

            <x-common.form-error name="password"/>
        </x-auth.form-input>

        <x-auth.form-input name="remember" class="block mt-4">
            <x-common.checkbox labelClass="flex items-center" name="remember">
                <span class="ml-2 text-sm text-primary-shades-400">{{ __('Remember me') }}</span>
            </x-common.checkbox>
        </x-auth.form-input>

        <div class="flex items-center justify-end mt-4">
            <x-auth.additional-link route="password.request" text="{{ __('Forgot your password?') }}"/>

            <x-common.button class="ml-4">
                {{ __('Login') }}
            </x-common.button>
        </div>

    </x-common.form>

    <hr class="m-5"/>

    <div class="text-center">
        <x-auth.additional-link route="register" text="{{ __('New User? Register Now.') }}"/>
    </div>
</x-auth-layout>
