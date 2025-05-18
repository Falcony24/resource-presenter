<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-[#413a1e] leading-tight">
            {{ __('Eksport danych') }}
        </h2>
    </x-slot>

    <x-slot name="title">
        Eksport Danych
    </x-slot>

    <div class="py-12 bg-[#efe7d8] min-h-screen">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg border border-[#928c61]/30">
                <div class="p-6 text-[#413a1e]">
                    <form method="POST" action="{{ route('export') }}" aria-label="Formularz eksportu danych" class="space-y-6">
                        @csrf

                        <!-- Format Selection -->
                        <div class="space-y-2">
                            <label for="format" class="block text-sm font-medium text-[#413a1e]">
                                Wybierz format
                            </label>
                            <select
                                name="format"
                                id="format"
                                class="mt-1 block w-full px-4 py-3 border border-[#928c61]/50 rounded-lg focus:ring-2 focus:ring-[#928c61] focus:border-[#413a1e] transition bg-[#efe7d8]/20"
                                required
                            >
                                <option value="json">JSON</option>
                                <option value="xml">XML</option>
                            </select>
                        </div>

                        <!-- Data Selection -->
                        <div class="space-y-2">
                            <label for="option" class="block text-sm font-medium text-[#413a1e]">
                                Wybierz dane
                            </label>
                            <select
                                name="option"
                                id="option"
                                class="mt-1 block w-full px-4 py-3 border border-[#928c61]/50 rounded-lg focus:ring-2 focus:ring-[#928c61] focus:border-[#413a1e] transition bg-[#efe7d8]/20"
                                required
                            >
                                <option value="conflicts">Konflikty</option>
                                <option value="commodities">Surowce</option>
                            </select>
                        </div>

                        <!-- Export Button -->
                        <div class="mt-8">
                            <button
                                type="submit"
                                id="exportButton"
                                class="w-full px-6 py-3 bg-[#413a1e] hover:bg-[#928c61] text-white font-medium rounded-lg transition-all duration-300 focus:outline-none focus:ring-2 focus:ring-[#928c61] focus:ring-offset-2 shadow-md hover:shadow-lg"
                                aria-label="Eksportuj dane do wybranego formatu"
                            >
                                Eksportuj
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 inline-block ml-2 -mr-1" viewBox="0 0 20 20" fill="currentColor">
                                    <path fill-rule="evenodd" d="M3 17a1 1 0 011-1h12a1 1 0 110 2H4a1 1 0 01-1-1zm3.293-7.707a1 1 0 011.414 0L9 10.586V3a1 1 0 112 0v7.586l1.293-1.293a1 1 0 111.414 1.414l-3 3a1 1 0 01-1.414 0l-3-3a1 1 0 010-1.414z" clip-rule="evenodd" />
                                </svg>
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>