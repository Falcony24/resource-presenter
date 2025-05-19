@props(['conflicts' => getConflictsWithLocations(), 'conflictsLocations' => getConflictsLocations()])

@javascript(['conflicts' => getConflictsWithLocations(), 'conflictsLocations' => $conflictsLocations])

<x-layouts.main :styleSheets="['css/table.css', 'css/footer.css']" title='Lista konfliktów'>
    <body>
    <x-header-nav />
<header class="page-header">
  <h1 class="page-header__title">Lista konfliktów zbrojnych</h1>
  <a href="#" class="page-header__add">
    <img src="{{ asset('img/plus.png') }}" alt="Dodaj">
  </a>
</header>

    <div class="filters">
        <input type="text" id="searchInput" placeholder="Szukaj konfliktu..." onkeyup="filterConflicts()">
        <select id="countryFilter" onchange="filterConflicts()">
            <option value="">Wszystkie państwa</option>
            @foreach($conflictsLocations as $location)
                <option value="{{ $location['id'] }}">{{ $location['name'] }}</option>
            @endforeach
        </select>
        <div class="filter-year-range">
            <label for="yearRangeFilter">Zakres lat: <span id="yearRangeValue">1900 - 2023</span></label>
            <div class="year-slider-container">
                <div class="slider-wrapper">
                    <input type="range" class="year-slider" id="yearRangeMin" min="1900" max="2023" value="1900" oninput="updateYearRange()">
                    <input type="range" class="year-slider" id="yearRangeMax" min="1900" max="2023" value="2023" oninput="updateYearRange()">
                </div>
            </div>
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
            <th>Rok rozpoczęcia</th>
            <th>Rok zakończenia</th>
            <th>Ofiary</th>
            <th>Państwo</th>
        </tr>
        </thead>
        <tbody id="conflictsTableBody">
        </tbody>
    </table>

    <div class="pagination" id="pagination"></div>

    <script src="{{ asset('js/konflikty.js') }}"></script>

    </body>
</x-layouts.main>