<x-guest-layout>
    <div class="mb-6 p-4 bg-[#f9f7f2] text-[#413a1e] rounded-lg border border-[#928c61]/30 text-sm">
        {{ __('Forgot your password? No problem. Just let us know your email address and we will email you a password reset link that will allow you to choose a new one.') }}
    </div>

    <!-- Session Status -->
    <x-auth-session-status class="mb-6 p-4 bg-[#f9f7f2] text-[#413a1e] rounded-lg border border-[#928c61]/30" :status="session('status')" />

    <form method="POST" action="{{ route('password.email') }}" class="space-y-6">
        @csrf

        <!-- Email Address -->
        <div class="space-y-2">
            <x-input-label for="email" :value="__('Email')" class="text-[#413a1e] font-medium" />
            <x-text-input 
                id="email" 
                class="block w-full px-4 py-3 border border-[#928c61]/30 rounded-lg focus:ring-2 focus:ring-[#413a1e]/50 focus:border-[#928c61] transition"
                type="email" 
                name="email" 
                :value="old('email')" 
                required 
                autofocus 
            />
            <x-input-error :messages="$errors->get('email')" class="mt-1 text-red-600 text-sm" />
        </div>

        <div class="mt-6">
            <x-primary-button class="w-full justify-center px-6 py-3 bg-[#413a1e] hover:bg-[#928c61] text-white font-medium rounded-lg transition">
                {{ __('Email Password Reset Link') }}
            </x-primary-button>
        </div>
    </form>
</x-guest-layout>