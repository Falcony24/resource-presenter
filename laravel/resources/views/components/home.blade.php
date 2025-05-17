@props(['styleSheets' => ['css/app.css']])

<x-layouts.main :styleSheets="['css/style.css', 'css/footer.css', 'https://unpkg.com/leaflet@1.9.3/dist/leaflet
.css']" title='Strona główna'>
    <x-header-nav />

    <header class="background-image">
        <h1>Konflikty a Ceny Surowców</h1>
        <p>Analiza wpływu konfliktów na rynki surowców.</p>
        <a href="{{ route('analysis') }}">
            <button>Zobacz</button>
        </a>

    </header>

    <section class="konflikty" id="konflikty">
        <h2>Mapa świata z głównymi konfliktami 2025</h2>
        <div class="map-and-cards">
            <div id="mapa-kontener"></div>

            <div class="card-container">
                <div class="card">
                    <h3>Ukraina</h3>
                    <p>Wojna wpływa na ceny energii, zboża i nawozów.</p>
                </div>
                <div class="card">
                    <h3>Bliski Wschód</h3>
                    <p>Napięcia zwiększają ceny ropy naftowej i gazu.</p>
                </div>
                <div class="card">
                    <h3>Afryka (Sahel)</h3>
                    <p>Konflikty ograniczają wydobycie złota i uranu.</p>
                </div>
                <div class="card">
                    <h3>Ameryka Łacińska</h3>
                    <p>Przemoc karteli wpływa na handel surowcami.</p>
                </div>
                <div class="card">
                    <h3>Azja Południowo-Wschodnia</h3>
                    <p>Niepokoje w regionie zaburzają rynek metali.</p>
                </div>
                <div class="card">
                    <h3>Iran i Zatoka Perska</h3>
                    <p>Napięcia wpływają na ceny ropy i gazu transportowanego cieśniną Ormuz.</p>
                </div>
            </div>
        </div>
    </section>

    <section id="podsumowanie">
        <h2>Jak konflikty wpływają na ceny surowców?</h2>
        <div class="impact-cards">
            <div class="impact-card">
                <img src="img/dostawa.png" alt="Zakłócenie dostaw">
                <h3>Zakłócenie dostaw</h3>
                <p>Konflikty mogą prowadzić do przerwania łańcuchów dostaw i ograniczenia dostępności surowców.</p>
            </div>
            <div class="impact-card">
                <img src="img/wykres.png" alt="Zmienność cen">
                <h3>Zmienność cen</h3>
                <p>Niepewność geopolityczna powoduje wahania cen na światowych rynkach.</p>
            </div>
            <div class="impact-card">
                <img src="img/produkcja.png" alt="Wpływ na produkcję">
                <h3>Wpływ na produkcję</h3>
                <p>Konflikty mogą ograniczać wydobycie i przetwarzanie surowców.</p>
            </div>
        </div>
    </section>

    <script src="https://unpkg.com/leaflet@1.9.3/dist/leaflet.js"></script>
    <script src="{{ asset('js/mapa.js') }}"></script>
    <script src="{{ asset('js/faq.js') }}"></script>
</x-layouts.main>
