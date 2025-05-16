Aplikacje tworzymy wpisując (najłatwiej) z głównego folderu projektu polecenie:
docker compose up -d --build

Jak kontenery zostaną stworzone trzeba ręcznie zapełnić bazę danymi:
  php artisan migrate:fresh --seed

Pobieranie listy dostępnych surowców:
http://localhost:8000/api/commoditiesTypes

Pobieranie listy dostępnych jednostek dla kursu danego surowca:
http://localhost:8000/api/commodityUnits/{commodity}

Pobieranie listy cen kusru surowca w poszczególnych miesiącach dla danego surowca w danej jednostce:
http://localhost:8000/api/commodityUnits/{unit}/{commodity}

Pobieranie listy konfliktów:
http://localhost:8000/api/conflicts?start_date=2010&start_date_2nd=2011&end_date=2012&region=1,2&location=Russia

Pobranie opisu danych konfliktów:
http://localhost:8000/api/conflicts/description