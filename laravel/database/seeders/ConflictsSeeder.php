<?php

namespace Database\Seeders;

use App\Models\Conflict;
use App\Models\Country;
use Illuminate\Database\Seeder;

class ConflictsSeeder extends Seeder
{
    /**
     * Uruchomienie seeda.
     */
    public function run(): void
    {
        set_time_limit(100000);

        $url = 'https://war-memorial.net/wars_all.asp?q=3';
        $domain = 'https://war-memorial.net/';

        $response = $this->curl_get_contents($url);
        $response = mb_convert_encoding($response, 'UTF-8', 'ISO-8859-1');
        $containerStart = strpos($response, '<div class="maincol semi-wide">');

        $start = strpos($response, '<table ', $containerStart);
        $end = strpos($response, '</table>', $start);

        if ($start === false || $end === false) {
            throw new \Exception("Nie udało się pobrać zawartości ze strony war-memorial.net");
        }

        $end += strlen('</table>');
        $table = substr($response, $start, $end - $start);

        $rowStart = 0;
        $iter = 0;

        $warsData = [];

        while (true) {
            $rowStart = strpos($table, '<tr', $rowStart);
            if ($rowStart === false) {
                break;
            }

            $rowEnd = strpos($table, '</tr>', $rowStart);
            if ($rowEnd === false) {
                break;
            }

            $rowEnd += strlen('</tr>');
            $row = substr($table, $rowStart, $rowEnd - $rowStart);

            if ($iter !== 0) { // pomijamy nagłówek tabeli

                // Pobieranie nazwy wojny
                $tdPos = strpos($row, '<td ');
                $warNameStart = strpos($row, '>', $tdPos) + 1;
                $warNameEnd = strpos($row, '</td>', $tdPos);
                $warName = str_replace(["\t", "\n", "\r\n", "\n\r", "\r"], '', strip_tags(substr($row, $warNameStart, $warNameEnd - $warNameStart)));
                $warName = str_replace(['', '', '  ', "''"], ["'", "-", " ", '"'], $warName);
                $warName = ltrim($warName, ' ');

                // Pobieranie linku do szczegółów
                $warLinkStart = strpos($row, '<a href="') + 9;
                $warLinkEnd = strpos($row, '"', $warLinkStart);
                $warLink = substr($row, $warLinkStart, $warLinkEnd - $warLinkStart);
                $warLink = str_replace(['', ''], ["'", "-"], $warLink);

                // Pobieranie dat
                $tdPos = strpos($row, '<td ', $tdPos + 1);
                $dateStart = strpos($row, '>', $tdPos) + 1;
                $dateEnd = strpos($row, '</td>', $tdPos);
                $dates = explode('-', substr($row, $dateStart, $dateEnd - $dateStart));

                // Pobieranie liczby ofiar
                $tdPos = strpos($row, '<td ', $tdPos + 1);
                $casualtiesStart = strpos($row, '>', $tdPos) + 1;
                $casualtiesEnd = strpos($row, '</td>', $tdPos);
                $casualties = substr($row, $casualtiesStart, $casualtiesEnd - $casualtiesStart);
                $casualties = str_replace(',', '', $casualties);

                // Pobieranie szczegółowych informacji o konflikcie
                try {
                    $conflict_details = $this->curl_get_contents($domain . $warLink);

                    $curPos = strpos($conflict_details, 'Nation(s) involved and/or conflict territory');
                    if ($curPos !== false) {
                        $curPos = strpos($conflict_details, '<a ', $curPos);
                        if ($curPos !== false) {
                            $curPos = strpos($conflict_details, '<a ', $curPos + 1);
                            if ($curPos !== false) {
                                $countriesEnd = strpos($conflict_details, '</p>', $curPos);
                                if ($countriesEnd !== false) {
                                    $countriesRaw = substr($conflict_details, $curPos, $countriesEnd - $curPos);
                                    $countries = explode(', ', strip_tags($countriesRaw));
                                    $countries = array_filter($countries, fn($v) => trim($v) !== '');
                                } else {
                                    $countries = [];
                                }
                            } else {
                                $countries = [];
                            }
                        } else {
                            $countries = [];
                        }
                    } else {
                        $countries = [];
                    }
                } catch (\Exception $e) {
                    echo "Nie udało się pobrać szczegółów konfliktu ze strony {$domain}{$warLink}: " . $e->getMessage() . "\n";
                    $countries = [];
                }

                $warsData[] = [
                    'war_name' => $warName,
                    'war_link' => $domain . $warLink,
                    'start_date' => $dates[0] ?? '',
                    'end_date' => $dates[1] ?? '',
                    'casualties' => $casualties,
                    'countries' => $countries,
                ];
            }

            $rowStart = $rowEnd;
            $iter++;
            if ($iter > 10000) {
                break;
            }
        }

        // Zapis do bazy danych
        foreach ($warsData as $warsDataItem) {
            // Tworzenie poprawnych dat
            $startDate = $warsDataItem['start_date'] ? date_create(trim($warsDataItem['start_date']) . '-01-01') : null;
            $endDate = $warsDataItem['end_date'] ? date_create(trim($warsDataItem['end_date']) . '-12-31') : null;

            $conflict = Conflict::make([
                'name' => $warsDataItem['war_name'],
                'link' => $warsDataItem['war_link'],
                'start_date' => $startDate ? $startDate->format('Y-m-d') : null,
                'end_date' => $endDate ? $endDate->format('Y-m-d') : null,
                'casualties' => $warsDataItem['casualties'],
            ]);
            $conflict->save();

            // Powiązanie konfliktu z krajami
            foreach ($warsDataItem['countries'] as $country) {
                $involvedCountry = Country::firstOrCreate(['name' => $country]);
                $conflict->countries()->syncWithoutDetaching([$involvedCountry->id]);
            }
        }
    }

    /**
     * Pobieranie zawartości URL z użyciem cURL.
     */
    private function curl_get_contents(string $url): string
    {
        $ch = curl_init($url);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_FOLLOWLOCATION, true);
        curl_setopt($ch, CURLOPT_TIMEOUT, 30);
        $result = curl_exec($ch);
        if (curl_errno($ch)) {
            throw new \Exception('Błąd cURL: ' . curl_error($ch) . ' dla URL: ' . $url);
        }
        curl_close($ch);
        return $result;
    }
}
