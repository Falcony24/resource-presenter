<x-layouts.main title='Analiza' :styleSheets="['css/style.css', 'css/footer.css', 'css/analiza.css']" :scripts="['https://cdn
.tailwindcss.com', 'https://cdn.jsdelivr.net/npm/chart.js@4.4.0/dist/chart.umd.min.js', 'https://cdn.jsdelivr
.net/npm/chartjs-plugin-annotation@3.0.1/dist/chartjs-plugin-annotation.min.js', 'https://cdn.jsdelivr
.net/npm/chartjs-adapter-date-fns@3.0.0/dist/chartjs-adapter-date-fns.bundle.min.js']">
    @javascript(['commodities' => $commodities])
    <x-header-nav />
    <body>
    <div class="container mx-auto p-4">
        <h1 class="text-2xl font-bold mb-4"> Wpływ konfliktów na ceny surowców</h1>
        <div class="mb-4">
            <label for="resource" class="block text-sm font-medium text-gray-700"> Wybierz surowiec:</label>
            <select id="resource" class="mt-1 block w-full max-w-xs p-2 border border-gray-300 rounded-md">
                <option value="">Wybierz surowiec</option>
            </select>
        </div>

        <div class="mb-4">
            <label for="timeRange" class="block text-sm font-medium text-gray-700"> Wybierz zakres czasu:</label>
            <select id="timeRange" class="mt-1 block w-full max-w-xs p-2 border border-gray-300 rounded-md">
                <option value="1945-2025">1945 - 2025</option>
                <option value="1945-1955">1945 - 1955</option>
                <option value="1955-1965">1955 - 1965</option>
                <option value="1965-1975">1965 - 1975</option>
                <option value="1975-1985">1975 - 1985</option>
                <option value="1985-1995">1985 - 1995</option>
                <option value="1995-2005">1995 - 2005</option>
                <option value="2005-2015">2005 - 2015</option>
                <option value="2015-2025">2015 - 2025</option>
            </select>
        </div>
        <div class="filter-date">
            <label for="startDateFilter" class="block text-sm font-medium text-gray-700">Data rozpoczęcia</label>
            <input type="date" id="startDateFilter" onchange="filterConflicts()">
        </div>
        <div class="filter-date">
            <label for="endDateFilter" class="block text-sm font-medium text-gray-700">Data zakończenia</label>
            <input type="date" id="endDateFilter" onchange="filterConflicts()">
        </div>

        <div class="bg-white p-4 rounded shadow">
            <canvas id="priceChart"></canvas>

        </div>
    </div>

    <script src="{{ asset('js/analiza.js') }}"></script>
    </body>
</x-layouts.main>
