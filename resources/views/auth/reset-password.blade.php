@section('title', 'Reset Password')

<x-auth-layout>
    <x-common.form action="{{ route('password.update') }}">
        <input type="hidden" name="token" value="{{ $request->route('token') }}">

        <x-auth.form-input name="email">
            <x-common.label value="{{ __('Email') }}"/>
            <x-common.input class="block mt-1 w-full"
                            type="email"
                            name="email"
                            :value="old('email', $request->email)"
                            autofocus/>

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

        <x-auth.form-input name="password_confirmation" class="mt-4">
            <x-common.label value="{{ __('Confirm Password') }}"/>
            <x-common.input class="block mt-1 w-full"
                            type="password"
                            name="password_confirmation"
                            autocomplete="new-password"/>

            <x-common.form-error name="password_confirmation"/>
        </x-auth.form-input>

        <div class="flex items-center justify-end mt-4">
            <x-common.button>
                {{ __('Reset Password') }}
            </x-common.button>
        </div>
    </x-common.form>
</x-auth-layout>
