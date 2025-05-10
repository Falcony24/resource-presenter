@props(['conflicts' => [], 'conflictsLocations' => getConflictsLocations()])
@javascript(['conflicts' => $conflicts, 'conflictsLocations' => $conflictsLocations])

<x-layouts.main :styleSheets="['css/table.css']">
    <body>
    <x-header-nav />

    <h1>Lista konfliktów zbrojnych</h1>
        <!-- Przycisk z ikonką plusa w prawym górnym rogu -->
        <a href="" style="position: absolute; top: 80px; right: 550px;">
            <img src="{{ asset('img/plus.png') }}" alt="Dodaj" style="width: 32px; height: 32px;">
        </a>

    <div class="filters">
        <input type="text" id="searchInput" placeholder="Szukaj konfliktu..." onkeyup="filterConflicts()">
        <select id="countryFilter" onchange="filterConflicts()">
            <option value="">Wszystkie państwa</option>
            @foreach($conflictsLocations as $location)
                <option value="{{ $loop->index }}">{{ $location }}</option>
            @endforeach
            <option value="1">Ukraina</option>
            <option value="2">Syria</option>
            <option value="3">Afganistan</option>
        </select>
        <div class="filter-date">
            <label for="startDateFilter">Data rozpoczęcia</label>
            <input type="date" id="startDateFilter" onchange="filterConflicts()">
        </div>
        <div class="filter-date">
            <label for="endDateFilter">Data zakończenia</label>
            <input type="date" id="endDateFilter" onchange="filterConflicts()">
        </div>
    </div>

<div class="login-prompt" style="display: flex; align-items: center; margin-bottom: 20px;">
    <p style="margin: 0;">Chcesz zaeksportować dane?</p>
    <form action="{{ route('register') }}" method="get" style="margin-left: 12px;">
        <button type="submit" style="padding: 8px 16px; background-color: #5e5437; color: white; border: none; border-radius: 4px;">
            Zarejestruj się
        </button>
    </form>
</div>



    <table>
        <thead>
        <tr>
            <th>Nazwa konfliktu</th>
            <th>Data rozpoczęcia</th>
            <th>Data zakończenia</th>
            <th>Państwo/Kontynent</th>
        </tr>
        </thead>
        <tbody id="conflictsTableBody">
        </tbody>
    </table>

    <div class="pagination" id="pagination"></div>

    <script src="{{ asset('js/konflikty.js') }}"></script>
    </body>
</x-layouts.main>
