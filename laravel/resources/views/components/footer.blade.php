<body>
    <div class="page-wrapper">
        <main class="main-content">
            @yield('content') {{-- lub właściwa sekcja --}}
        </main>

        <footer class="footer">
            <div class="footer-container">
                <div class="footer-section">
                    <h3>O projekcie</h3>
                    <p>Monitoring wpływu konfliktów na ceny surowców.</p>
                </div>
                <div class="footer-section">
                    <h3>Szybkie linki</h3>
                    <ul>
                        <li><a href="{{ route('conflicts') }}">Konflikty</a></li>
                        <li><a href="{{ route('commodities') }}">Surowce</a></li>
                        <li><a href="{{ route('analysis') }}">Analizy</a></li>
                    </ul>
                </div>
                <div class="footer-section">
                    <h3>Kontakt</h3>
                    <p>info@geoconflicts.com</p>
                </div>
            </div>
            <div class="footer-bottom">
                © 2025 Confl. Wszystkie prawa zastrzeżone.
            </div>
        </footer>
    </div>
</body>
