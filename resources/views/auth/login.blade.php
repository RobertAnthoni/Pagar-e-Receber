<x-guest-layout>
    <x-authentication-card>
        <x-slot name="logo">
            <img
                src="data:image/png;base64,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">
        </x-slot>

        <x-validation-errors class="mb-4" />

        @if (session('status'))
            <div class="mb-4 font-medium text-sm text-green-600">
                {{ session('status') }}
            </div>
        @endif

        <form method="POST" action="{{ route('login') }}">
            @csrf

            <div>
                <x-label for="email" value="{{ __('Email') }}" />
                <x-input id="email" class="block mt-1 w-full" type="email" name="email" :value="old('email')" required
                    autofocus autocomplete="username" />
            </div>

            <div class="mt-4">
                <x-label for="password" value="{{ __('Password') }}" />
                <x-input id="password" class="block mt-1 w-full" type="password" name="password" required
                    autocomplete="current-password" />
            </div>

            <div class="block mt-4">
                <label class="flex items-center">
                    <span class="ml-2 text-sm text-gray-600">{{ __('Não tem uma conta?') }}</span>
                    <a href="{{ route('register') }}" class="ml-2 text-sm text-indigo-600">
                        Registrar-se.
                    </a>
                </label>
            </div>


            <div class="flex items-center justify-end mt-4">
                @if (Route::has('password.request'))
                    <a class="underline text-sm text-gray-600 hover:text-gray-900 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500"
                        href="{{ route('password.request') }}">
                        {{ __('Forgot your password?') }}
                    </a>
                @endif

                <x-button class="ml-4">
                    {{ __('Log in') }}
                </x-button>
            </div>
        </form>
    </x-authentication-card>
</x-guest-layout>
