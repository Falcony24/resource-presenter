<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Eksport danych') }}
        </h2>
    </x-slot>

    <x-slot name="title">
        Eksport Danych
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <form method="POST" action="{{ route('export') }}" aria-label="Formularz eksportu danych">
                        @csrf

                        <div class="mb-4">
                            <label for="format" class="block text-sm font-medium text-gray-700">
                                Wybierz format
                            </label>
                            <select
                                name="format"
                                id="format"
                                class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-green-500 focus:border-green-500"
                                required
                            >
                                <option value="json">JSON</option>
                                <option value="xml">XML</option>
                            </select>
                        </div>

                        <div class="mb-4">
                            <label for="option" class="block text-sm font-medium text-gray-700">
                                Wybierz dane
                            </label>
                            <select
                                name="option"
                                id="option"
                                class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-green-500 focus:border-green-500"
                                required
                            >
                                <option value="conflicts">Konflikty</option>
                                <option value="commodities">Surowce</option>
                            </select>
                        </div>

                        <button
                            type="submit"
                            id="exportButton"
                            class="px-4 py-2 bg-green-600 text-white rounded hover:bg-green-700 focus:outline-none focus:ring-2 focus:ring-green-500 focus:ring-offset-2"
                            aria-label="Eksportuj dane do wybranego formatu"
                            title="Eksportuj dane"
                            aria-labelledby="exportButton"
                        >
                            Eksportuj
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
