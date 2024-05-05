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

        <form method="POST" action="{{ route('login') }}" class="mt-8">
            @csrf

            <div class="mb-4">
                <x-jet-label for="email" value="{{ __('Email') }}" />
                <x-jet-input id="email" class="block w-full mt-1" type="email" name="email" :value="old('email')" required autofocus />
            </div>

            <div class="mb-4">
                <x-jet-label for="password" value="{{ __('Password') }}" />
                <x-jet-input id="password" class="block w-full mt-1" type="password" name="password" required autocomplete="current-password" />
            </div>

            <div class="mb-4 flex items-center">
                <label for="remember_me" class="flex items-center">
                    <x-jet-checkbox id="remember_me" name="remember" class="mr-2" />
                    <span class="text-sm text-gray-600">{{ __('Remember me') }}</span>
                </label>
            </div>

            <div class="mb-6">
                <x-jet-button class="w-full">
                    {{ __('Log in') }}
                </x-jet-button>
            </div>

            <div class="flex items-center justify-between">
                @if(Route::has('register'))
                <div class="w-1/2 text-left">
                    <a href="{{ route('register') }}" class="text-blue-500 text-sm tracking-tight">
                        {{ __('Register') }}</a>
                </div>
                @endif

                <div class="w-full md:w-1/3 border-t border-gray-400">
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
