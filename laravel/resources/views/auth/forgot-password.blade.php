<x-guest-layout>
    <div class="mb-6 p-4 bg-[#f9f7f2] text-[#413a1e] rounded-lg border border-[#928c61]/30 text-sm">
        {{ __('Zapomniałeś hasła? Nie ma problemu. Wystarczy, że podasz nam swój adres e-mail, a wyślemy Ci link do resetowania hasła, dzięki któremu będziesz mógł wybrać nowe.') }}
    </div>

    <!-- Session Status -->
    <x-auth-session-status class="mb-6 p-4 bg-[#f9f7f2] text-[#413a1e] rounded-lg border border-[#928c61]/30" :status="session('status')" />

    <form method="POST" action="{{ route('password.email') }}" class="space-y-6">
        @csrf

        <!-- Email Address -->
        <div class="space-y-2">
            <x-input-label for="email" :value="__('E-mail')" class="text-[#413a1e] font-medium" />
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
                {{ __('Wyślij link do resetowania hasła') }}
            </x-primary-button>
        </div>
    </form>
</x-guest-layout>
