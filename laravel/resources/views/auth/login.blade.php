<x-guest-layout>
    <!-- Session Status -->
    <x-auth-session-status
        class="mb-6 p-4 bg-[#f9f7f2] text-[#413a1e] rounded-lg border border-[#928c61]/30"
        :status="session('status')" />

    <form method="POST" action="{{ route('login') }}" class="space-y-6">
        @csrf

        <!-- Email Address -->
        <div class="space-y-2">
            <x-input-label for="email" :value="__('E-mail')" class="text-[#413a1e] font-medium" />
            <x-text-input 
                id="email" 
                class="block w-full px-4 py-3 border border-[#928c61]/30 rounded-lg
                       focus:ring-2 focus:ring-[#413a1e]/50 focus:border-[#928c61] transition"
                type="email" 
                name="email" 
                :value="old('email')" 
                required 
                autofocus 
                autocomplete="username" 
            />
            <x-input-error :messages="$errors->get('email')" class="mt-1 text-red-600 text-sm" />
        </div>

        <!-- Password -->
        <div class="space-y-2">
            <x-input-label for="password" :value="__('Hasło')" class="text-[#413a1e] font-medium" />
            <x-text-input 
                id="password" 
                class="block w-full px-4 py-3 border border-[#928c61]/30 rounded-lg
                       focus:ring-2 focus:ring-[#413a1e]/50 focus:border-[#928c61] transition"
                type="password" 
                name="password" 
                required 
                autocomplete="current-password" 
            />
            <x-input-error :messages="$errors->get('password')" class="mt-1 text-red-600 text-sm" />
        </div>

        <!-- Remember Me & Forgot Password -->
        <div class="flex items-center justify-between">
            <label for="remember_me" class="inline-flex items-center">
                <input id="remember_me" type="checkbox" 
                    class="rounded border-[#928c61]/50 text-[#413a1e] focus:ring-[#928c61]/30" 
                    name="remember">
                <span class="ms-2 text-sm text-[#413a1e]">{{ __('Zapamiętaj mnie') }}</span>
            </label>

            @if (Route::has('password.request'))
                <a class="text-sm text-[#928c61] hover:text-[#413a1e] font-medium transition" 
                   href="{{ route('password.request') }}">
                    {{ __('Zapomniałeś hasła?') }}
                </a>
            @endif
        </div>

        <!-- Submit Button -->
        <div class="mt-6">
            <x-primary-button
                class="w-full justify-center px-6 py-3 bg-[#5a4b22] hover:bg-[#b19f6a]
                       text-white font-medium rounded-lg transition">
                {{ __('Zaloguj się') }}
            </x-primary-button>
        </div>
    </form>
</x-guest-layout>
