### Aplikacje tworzymy wpisując (najłatwiej) z głównego folderu projektu polecenie:
> **docker compose up -d --build**

albo

> **docker compose -f docker-compose.yml up -d --build**

Pierwszy sposób jest trybem dev, powiedzmy, tzn. zostanie użyte to co jest w docker-compose.override.yml.
Drugi sposób nie używa pliku .override.yml.

Jak kontenery zostaną stworzone trzeba ręcznie zapełnić bazę danymi:
> **php artisan migrate:fresh --seed**

Pobieranie listy dostępnych surowców:
http://localhost:8000/api/commoditiesTypes

Pobieranie listy dostępnych jednostek dla kursu danego surowca:
http://localhost:8000/api/commodityUnits/{commodity}

Pobieranie listy cen kusru surowca w poszczególnych miesiącach dla danego surowca w danej jednostce:
http://localhost:8000/api/commodityUnits/{unit}/{commodity}

Pobieranie listy konfliktów:
http://localhost:8000/api/conflicts?start_date=2010-01-01&end_date=2011-12-31&casualties_min=1000&casualties_max=2000

Pobranie opisu danych konfliktów:
http://localhost:8000/api/conflicts/description