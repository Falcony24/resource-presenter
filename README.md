@ -1,50 +1 @@
Wprowadzenie do projektu
1. Opis
   Celem projektu jest zebranie oraz porównanie danych dotyczących trwających i historycznych konfliktów zbrojnych z danymi o cenach kluczowych surowców.
2. Cel projektu
   Projekt ma na celu zidentyfikowanie potencjalnych zależności między wydarzeniami geopolitycznymi a zmianami na rynkach surowcowych.
3. Zakres Projektu
   😊
4. Wymagania Funkcjonalne
   😊
5. Wymagania Niefunkcjonalne
   Wydajność
   •	API powinno obsługiwać minimum X zapytań na sekundę bez zauważalnych opóźnień.
   •	Czas odpowiedzi API nie powinien przekraczać 500 ms w typowych warunkach.
   Skalowalność
   •	Aplikacja powinna być łatwa do skalowania poziomego dzięki konteneryzacji.
   •	Redis może być wykorzystany do buforowania i kolejkowania, aby wspierać obciążenie.
   Niezawodność i dostępność
   •	System powinien być dostępny co najmniej 99% czasu.
   •	Redis powinien zapewniać mechanizm tymczasowego przechowywania danych w przypadku awarii backendu.
   Bezpieczeństwo
   •	Komunikacja między frontendem a backendem będzie odbywać się za pomocą HTTP.
   Przenośność
   •	Aplikacja powinna działać w dowolnym środowisku wspierającym Docker, niezależnie od systemu operacyjnego hosta.
   Utrzymywalność
   •	System powinien być podzielony na niezależne komponenty zgodnie z architekturą mikroserwisową lub modularną.
   Monitorowanie
   •	Monitorowanie odbywa się za pomocą Prometheus.
6. Technologie
   Frontend -
   Serwer API -
   MySQL – relacyjna baza danych wykorzystywana do przechowywania danych o konfliktach zbrojnych oraz cenach surowców, umożliwiająca przetwarzanie i analizę.
   Redis – system cache’ujący działający w pamięci operacyjnej, używany do szybkiego dostępu do najczęściej wykorzystywanych danych, co poprawia wydajność aplikacji.
   Docker – służy do konteneryzacji aplikacji, co umożliwia łatwe uruchamianie i skalowanie projektu w odizolowanym środowisku niezależnym od systemu operacyjnego.
   Prometheus – system monitorowania i zbierania metryk, wykorzystywany do śledzenia wydajności aplikacji i infrastruktury w czasie rzeczywistym.
7. Architektura system
   Frontend -
   Backend -
8. Realizacja Projektu
    1. Analiza i projektowanie
       Podstawą stworzenia serwisu jest analiza problemu, który ma zostać w nim przedstawiony. Nawet przy wstępnym rozeznaniu w temacie warto przystąpić do analizy wymagań funkcjonalnych, uwzględniając przyszłościowy model przechowywania danych w bazie danych. Należy także rozważyć, skąd serwis będzie pozyskiwał dane oraz które z nich są publicznie dostępne.
    2. Implementacja API
       Kolejnym krokiem w budowie serwisu jest zaprojektowanie bazy danych przy użyciu MySQL oraz utworzenie interfejsu API w PHP. Struktura bazy danych powinna być dopasowana do rodzaju i źródeł gromadzonych informacji, z uwzględnieniem relacji między danymi.
    3. Implementacja frontendu
    4. Konteneryzacja systemu
       Rozbicie każdej usługi na osobny kontener.
<!-- 9. Wnioski
10. Harmonogram -->
<!-- 11. Zasoby -->
<!-- 12. Ryzyka -->
Wykorzystywane technologie i programy:
# resource-presenter