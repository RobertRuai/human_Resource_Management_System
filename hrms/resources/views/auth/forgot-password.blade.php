<x-guest-layout>
<div class="sign-in">
            <div class="guest">
                <a href="/">
                    <img src="{{ asset('images/favicon.png') }}" alt="Company Logo" class="guest-img w-30 h-30">
                </a>
            </div>
            <div class="guest-title">
                <h3>HRMS</h3>
            </div>
        <h6>Password Reset</h6>
    </div>
    <div class="mb-4 text-sm text-gray-600 mt-2 dark:text-gray-400">
        {{ __('Forgot your password? No problem. Just let us know your email address and we will email you a password reset link that will allow you to choose a new one.') }}
    </div>

    <!-- Session Status -->
    <x-auth-session-status class="mb-4" :status="session('status')" />

    <form method="POST" action="{{ route('password.email') }}" class="guest-form">
        @csrf

        <!-- Email Address -->
        <div>
            <x-input-label for="email" :value="__('Email')" />
            <x-text-input id="email" class="block mt-1 w-full" type="email" name="email" :value="old('email')" required autofocus />
            <x-input-error :messages="$errors->get('email')" class="mt-2" />
        </div>

        <div class="flex items-center justify-end mt-4">
            <x-primary-button class="guest-form-btn">
                {{ __('Email Password Reset Link') }}
            </x-primary-button>
        </div>
    </form>
</x-guest-layout>
