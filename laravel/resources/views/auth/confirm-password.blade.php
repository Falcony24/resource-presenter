<x-guest-layout title="Potwierdzanie hasła">
    <div class="mb-6 p-4 bg-[#f9f7f2] text-[#413a1e] rounded-lg border border-[#928c61]/30 text-sm">
        {{ __('This is a secure area of the application. Please confirm your password before continuing.') }}
    </div>

    <form method="POST" action="{{ route('password.confirm') }}" class="space-y-6">
        @csrf

        <!-- Password -->
        <div class="space-y-2">
            <x-input-label for="password" :value="__('Password')" class="text-[#413a1e] font-medium" />
            <x-text-input 
                id="password"
                class="block w-full px-4 py-3 border border-[#928c61]/30 rounded-lg focus:ring-2 focus:ring-[#413a1e]/50 focus:border-[#928c61] transition"
                type="password"
                name="password"
                required 
                autocomplete="current-password" 
            />
            <x-input-error :messages="$errors->get('password')" class="mt-1 text-red-600 text-sm" />
        </div>

        <div class="mt-6">
            <x-primary-button class="w-full justify-center px-6 py-3 bg-[#413a1e] hover:bg-[#928c61] text-white font-medium rounded-lg transition">
                {{ __('Confirm') }}
            </x-primary-button>
        </div>
    </form>
</x-guest-layout>
