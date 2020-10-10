@section('title', 'Forget Password')

<x-auth-layout>
    <div class="mb-4 text-sm text-gray-600">
        {{ __('Forgot your password? No problem. Just let us know your email address and we will email you a password reset link that will allow you to choose a new one.') }}
    </div>

    <x-common.form action="{{ route('password.email') }}">
        <x-auth.form-input name="email">
            <x-common.label value="{{ __('Email') }}"/>
            <x-common.input class="block mt-1 w-full"
                            type="email"
                            name="email"
                            :value="old('email')"
                            autofocus/>

            <x-common.form-error name="email"/>
        </x-auth.form-input>

        <div class="flex items-center justify-end mt-4">
            <x-common.button>
                {{ __('Email Password Reset Link') }}
            </x-common.button>
        </div>
    </x-common.form>

    <hr class="m-5"/>

    <div class="text-center">
        <x-auth.additional-link route="login" text="{{ __('Back to login') }}"/>
    </div>
</x-auth-layout>
