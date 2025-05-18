<x-guest-layout>
    <form method="POST" action="{{ route('register') }}" class="space-y-6">
        @csrf

        <!-- Name -->
        <div class="space-y-2">
            <x-input-label for="name" :value="__('Imię')" class="text-[#413a1e] font-medium" />
            <x-text-input 
                id="name" 
                class="block w-full px-4 py-3 border border-[#928c61]/30 rounded-lg focus:ring-2 focus:ring-[#413a1e]/50 focus:border-[#928c61] transition"
                type="text" 
                name="name" 
                :value="old('name')" 
                required 
                autofocus 
                autocomplete="name" 
            />
            <x-input-error :messages="$errors->get('name')" class="mt-1 text-red-600 text-sm" />
        </div>

        <!-- Email -->
        <div class="space-y-2">
            <x-input-label for="email" :value="__('Email')" class="text-[#413a1e] font-medium" />
            <x-text-input 
                id="email" 
                class="block w-full px-4 py-3 border border-[#928c61]/30 rounded-lg focus:ring-2 focus:ring-[#413a1e]/50 focus:border-[#928c61] transition"
                type="email" 
                name="email" 
                :value="old('email')" 
                required 
                autocomplete="email" 
            />
            <x-input-error :messages="$errors->get('email')" class="mt-1 text-red-600 text-sm" />
        </div>

        <!-- Password -->
        <div class="space-y-2">
            <x-input-label for="password" :value="__('Hasło')" class="text-[#413a1e] font-medium" />
            <x-text-input 
                id="password" 
                class="block w-full px-4 py-3 border border-[#928c61]/30 rounded-lg focus:ring-2 focus:ring-[#413a1e]/50 focus:border-[#928c61] transition"
                type="password" 
                name="password" 
                required 
                autocomplete="new-password" 
            />
            <x-input-error :messages="$errors->get('password')" class="mt-1 text-red-600 text-sm" />
        </div>

        <!-- Confirm Password -->
        <div class="space-y-2">
            <x-input-label for="password_confirmation" :value="__('Potwierdź hasło')" class="text-[#413a1e] font-medium" />
            <x-text-input 
                id="password_confirmation" 
                class="block w-full px-4 py-3 border border-[#928c61]/30 rounded-lg focus:ring-2 focus:ring-[#413a1e]/50 focus:border-[#928c61] transition"
                type="password" 
                name="password_confirmation" 
                required 
                autocomplete="new-password" 
            />
            <x-input-error :messages="$errors->get('password_confirmation')" class="mt-1 text-red-600 text-sm" />
        </div>

        <div class="flex items-center justify-between mt-8">
            <a class="text-sm text-[#928c61] hover:text-[#413a1e] font-medium transition" href="{{ route('login') }}">
                {{ __('Masz już konto?') }}
            </a>

            <x-primary-button class="px-6 py-3 bg-[#413a1e] hover:bg-[#928c61] text-white font-medium rounded-lg transition">
                {{ __('Zarejestruj się') }}
            </x-primary-button>
        </div>
    </form>
</x-guest-layout>