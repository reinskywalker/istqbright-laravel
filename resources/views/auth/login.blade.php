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

        <form method="POST" action="{{ route('login') }}" class="mt-4">
            @csrf

            <div class="mt-4">
                <x-jet-label for="email" value="{{ __('Email') }}" class="text-gray-700" />
                <x-jet-input id="email" class="block mt-1 w-full bg-gray-100 border border-gray-300 rounded-md focus:outline-none focus:border-indigo-500 focus:ring focus:ring-indigo-200" type="email" name="email" :value="old('email')" required autofocus />
            </div>

            <div class="mt-4">
                <x-jet-label for="password" value="{{ __('Password') }}" class="text-gray-700" />
                <x-jet-input id="password" class="block mt-1 w-full bg-gray-100 border border-gray-300 rounded-md focus:outline-none focus:border-indigo-500 focus:ring focus:ring-indigo-200" type="password" name="password" required autocomplete="current-password" />
            </div>

            <div class="block mt-4">
                <label for="remember_me" class="flex items-center text-gray-700">
                    <x-jet-checkbox id="remember_me" name="remember" class="text-indigo-500" />
                    <span class="ml-2 text-sm">{{ __('Remember me') }}</span>
                </label>
            </div>

            <div class="flex items-center justify-between mt-4">
                <div class="text-sm">
                    @if(Route::has('register'))
                    <a href="{{ route('register') }}" class="underline text-indigo-500 hover:text-indigo-700">
                        {{ __('New User?') }}
                    </a>
                    @endif
                </div>

                <div class="text-sm">
                    @if (Route::has('password.request'))
                    <a href="{{ route('password.request') }}" class="underline text-indigo-500 hover:text-indigo-700">
                        {{ __('Forgot your password?') }}
                    </a>
                    @endif
                </div>

                <x-jet-button class="ml-4 bg-indigo-500 hover:bg-indigo-700 text-white">
                    {{ __('Log in') }}
                </x-jet-button>
            </div>
        </form>
    </x-jet-authentication-card>
</x-guest-layout>