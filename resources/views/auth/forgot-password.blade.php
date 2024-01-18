<x-guest-layout>
    <x-jet-authentication-card>
        <x-slot name="logo">
            <x-jet-authentication-card-logo />
        </x-slot>

        <div class="mb-4 text-sm text-gray-600">
            {{ __('Forgot your password? No problem. Just let us know your email address, and we will email you a password reset link that will allow you to choose a new one.') }}
        </div>

        @if (session('status'))
        <div class="mb-4 font-medium text-sm text-green-600">
            {{ session('status') }}
        </div>
        @endif

        <x-jet-validation-errors class="mb-4" />

        <form method="POST" action="{{ route('password.email') }}" class="mt-4">
            @csrf

            <div class="mb-4">
                <x-jet-label for="email" value="{{ __('Email') }}" class="text-gray-700" />
                <x-jet-input id="email" class="block w-full mt-1" type="email" name="email" :value="old('email')" required autofocus />
            </div>

            <div class="flex items-center justify-between mt-4">
                @if (Route::has('login'))
                <a href="{{ route('login') }}" class="text-sm text-gray-700 underline hover:text-gray-900">Back to Login</a>
                @endif
                <x-jet-button class="bg-indigo-500 hover:bg-indigo-700 text-white">
                    {{ __('Email Password Reset Link') }}
                </x-jet-button>
            </div>
        </form>
    </x-jet-authentication-card>
</x-guest-layout>