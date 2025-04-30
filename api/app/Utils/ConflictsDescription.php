<?php

namespace App\Utils;

class ConflictsDescription
{
    static public $description = [
        'conflict_id' => 'Wskazuje na id sporu, możliwe jest, że to samo id będzie miał więcej niż jeden konflikt, oznacza to, że spór występuje pomiędzy tymi samymi stronami',
        'location' => 'Kraj wysuwauący roszczenia',
        'side_a' => 'Główny kraj wysuwający żądania',
        'side_a_2nd' => 'Inne strony konfliktu, może być puste',
        'side_b' => 'Państwo lub grupa, do której są skierowane żądania',
        'side_b_2nd' => 'Inne strony konfliktu, może być puste',
        'incompatibility' => ['description' => 'Typ wysuwanych żądań',
            'values' => [1 => 'dotyczy terytorium',
                2 => 'dotyczy żądu',
                3 => 'dotyczy i terytorium i żądu']],
        'territory_name' => 'Nazwa regionu o który jest prowadzony konflkit, jest pust jeżeli incompatibility = 2',
        'year' => 'Wybrany rok obserwacji konfliktu',
        'intensity_level' => ['description' => 'Liczba zgonów w wybranym roku obserwacji',
            'values' => [1 => 'liczba zgonów spowodowanych bitwami wynosi mniej niż 1000',
                2 => 'liczba zgonów spowodowanych bitwami wynosi więcej niż 1000']],
        'cumulative_intensity' => ['description' => 'Liczba zgonów spowodowanych walką w trakcie trwania całego konfliktu',
            'values' => [0 => 'Liczba zgonów spowodowanych walką w trakcie całego konfliktu wynosi mniej niż 1000',
                1 => 'Liczba zgonów spowodowanych walką w trakcie całego konfliktu wynosi więcej niż 1000']],
        'type_of_conflict' => '1 - konflikt pomiędzy państwem a grupą która nie jest państwem, pierwsza strona prowadzi działania poza granicami państwa o kontrolę nad jakimś terenem, 2 - obie strony konfliktu są państwami, 3 - pierwsza strona konfliktu jest państem a druga jest jedną lub wieloma grupami które nie są państwem, w konflikt nie są zaangażowane inne państwa, 3 - pierwsza strona konfliktu jest państem a druga jest jedną lub wieloma grupami które nie są państwem, w konflikt są zaangażowane inne państwa po jednej lub po drugiej stronie',
        'start_date' => 'data pierwszej odnotowanej śmierci związanej z działaniami zbrojnymi',
        'start_date_2nd' => 'data w której liczba śmierci związanych z działaniami zbrojnymi przekroczyła 25 w rok',
        'end_date' => 'data zakończenia konfliktu, która oznacza, że przez co najmniej rok od tej daty nie nastąpiły żadne działania konfliktowe. Może wynosić null, jeżeli konflikt cały czas trwa',
//        'region' => 'Podział świata na regiony 1 - Europa, 2 - Bliski wschód, 3 - Azja, 4 - Afryka, 5 - Ameryka'
        'region' => ['description' => 'Podział świata na regiony',
            'values' => [1 => 'Europa',
                2 => 'Bliski wschód',
                3 => 'Azja',
                4 => 'Afryka',
                5 => 'Ameryka']]
    ];
}
