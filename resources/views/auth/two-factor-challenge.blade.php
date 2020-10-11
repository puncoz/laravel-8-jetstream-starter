@section('title', '2FA')

<x-auth-layout>
    <div x-data="{ recovery: false }">
        <div class="mb-4 text-sm text-gray-600" x-show="!recovery">
            {{ __('Please confirm access to your account by entering the authentication code provided by your authenticator application.') }}
        </div>

        <div class="mb-4 text-sm text-gray-600" x-show="recovery">
            {{ __('Please confirm access to your account by entering one of your emergency recovery codes.') }}
        </div>

        <x-common.form action="/two-factor-challenge">
            <div x-show="!recovery">
                <x-auth.form-input name="code">
                    <x-common.label value="{{ __('Code') }}"/>
                    <x-common.input class="block mt-1 w-full"
                                    type="text"
                                    name="code"
                                    x-ref="code"
                                    autofocus
                                    autocomplete="one-time-code"/>

                    <x-common.form-error name="code"/>
                </x-auth.form-input>
            </div>

            <div x-show="recovery">
                <x-auth.form-input name="recovery_code">
                    <x-common.label value="{{ __('Recovery Code') }}"/>
                    <x-common.input class="block mt-1 w-full"
                                    type="text"
                                    name="recovery_code"
                                    x-ref="recovery_code"
                                    autofocus
                                    autocomplete="one-time-code"/>

                    <x-common.form-error name="recovery_code"/>
                </x-auth.form-input>
            </div>

            <div class="flex items-center justify-end mt-4 gap-2">
                <button type="button" class="text-sm text-gray-600 hover:text-gray-900 underline cursor-pointer"
                        x-show="! recovery"
                        x-on:click="
                                        recovery = true;
                                        $nextTick(() => { $refs.recovery_code.focus() })
                                    ">
                    {{ __('Use a recovery code') }}
                </button>

                <button type="button" class="text-sm text-gray-600 hover:text-gray-900 underline cursor-pointer"
                        x-show="recovery"
                        x-on:click="
                                        recovery = false;
                                        $nextTick(() => { $refs.code.focus() })
                                    ">
                    {{ __('Use an authentication code') }}
                </button>

                <x-common.button>
                    {{ __('Login') }}
                </x-common.button>
            </div>
        </x-common.form>
    </div>
</x-auth-layout>
