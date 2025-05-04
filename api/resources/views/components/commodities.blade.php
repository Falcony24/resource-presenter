@props(['commodities' => []])
@javascript(['commodities' => $commodities])

<x-layouts.main :styleSheets="['css/table.css']">
    <body>
    <x-header-nav />
    <div id="data"></div>

    <h1>Lista surowców</h1>

    <div class="filters">
        <input type="text" id="searchInput" placeholder="Szukaj surowca..." onkeyup="filterResources()">
    </div>

    <table>
        <thead>
        <tr>
            <th>Nazwa</th>
            <th>Opis</th>
        </tr>
        </thead>
        <tbody id="resourcesTableBody">

        </tbody>
    </table>

    <div class="pagination" id="pagination"></div>


    <script src="{{ asset('js/surowce.js') }}"></script>

    </body>
</x-layouts.main>
