<x-guest-layout>

    <x-jet-authentication-card>
        <x-slot name="logo">
            <x-jet-authentication-card-logo />
        </x-slot>

        <x-jet-validation-errors class="mb-4" />
        @if (session('status'))
        <div class="mb-4 font-medium text-sm text-green-600">
            {{ session('status') }}
        </div>
        @endif

        <form method="POST" action="{{ route('login') }}">
            @csrf

            <div>
                <x-jet-label for="email" value="{{ __('Email') }}" />
                <x-jet-input id="email" class="block mt-1 w-full" type="email" name="email" :value="old('email')" required autofocus />
            </div>

            <div class="mt-4">
                <x-jet-label for="password" value="{{ __('Password') }}" />
                <x-jet-input id="password" class="block mt-1 w-full" type="password" name="password" required autocomplete="current-password" />
            </div>

            <div class="block mt-4">
                <label for="remember_me" class="flex items-center">
                    <x-jet-checkbox id="remember_me" name="remember" />
                    <span class="ml-2 text-sm text-gray-600">{{ __('Remember me') }}</span>
                </label>
            </div>

            <div class="block mx-auto mt-4">
                <x-jet-button class="leading-tight appearance-none mx-auto block w-full text-center">
                    {{ __('Log in') }}
                </x-jet-button>
            </div>

            <div class="flex items-center justify-end mt-4">
                @if(Route::has('register'))
                <div class="w-1/2 text-left">
                    <a href="{{ route('register') }}" class="text-blue-500 text-sm tracking-tight">
                        {{ __('Register') }}</a>
                </div>

                @endif

                <div class="w-full md:w-1/3 px-3 pt-4 mx-2 border-t border-gray-400">
                    <span class="text-center text-xs text-gray-700"></span>
                </div>
                @if (Route::has('password.request'))
                <div class="w-1/2 text-right">
                    <a href="{{ route('password.request') }}" class="text-blue-500 text-sm tracking-tight">
                        {{ __('Forget your password?') }}</a>
                </div>
                @endif

            </div>
        </form>
    </x-jet-authentication-card>
</x-guest-layout>