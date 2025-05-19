@props(['commodities' => []])
@javascript(['commodities' => $commodities])

<x-layouts.main :styleSheets="['css/table.css', 'css/footer.css']" title='Ceny surowców'>
    <body>
        <x-header-nav />
        <div id="data"></div>

<header class="page-header">
  <h1 class="page-header__title">Lista surowców</h1>
  <a href="{{ route('commodities.create') }}" class="page-header__add">
    <img src="{{ asset('img/plus.png') }}" alt="Dodaj">
  </a>
</header>


        <div class="filters">
            <input type="text" id="searchInput" placeholder="Szukaj surowca..." onkeyup="filterResources()">
        </div>

        <!-- Login prompt -->
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
                    <th>Nazwa</th>
                    <th>Opis</th>
                </tr>
            </thead>
            <tbody id="resourcesTableBody">
                <!-- Here you can dynamically render resources if needed -->
            </tbody>
        </table>

        <div class="pagination" id="pagination"></div>

        <script src="{{ asset('js/surowce.js') }}"></script>
    </body>
</x-layouts.main>
