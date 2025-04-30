Aby przygotować projekt z api do działania należy:
- zainstalować zależności:
    composer install
- zmienne środowiskowe:
    cp ./.env.example ./.env
- zainicjalizować plik bazy sqlite:
    touch ./api/database/database.sqlite
- zainicjalozować bazę oraz ją zapełnić danymi (to rozwiązanie tymczasowe):
    php artisan migrate:fresh --seed

Aby uruchomić server developerski należy z folderu z api uruchomić komendę:
    php artisan serve

Pobieranie listy dostępnych surowców:
    https://localhost:8000/api/commoditiesTypes

Pobieranie listy dostępnych jednostek dla kursu danego surowca:
    https://localhost:8000/api/commodityUnits/{commodity}

Pobieranie listy cen kusru surowca w poszczególnych miesiącach dla danego surowca w danej jednostce:
    https://localhost:8000/api/commodityUnits/{unit}/{commodity}
	
Pobieranie listy konfliktów:
	https://localhost:8000/api/conflicts?start_date=2010&start_date_2nd=2011&end_date=2012&region=1,2&location=Russia

Pobranie opisu danych konfliktów:
	https://localhost:8000/api/conflicts/description