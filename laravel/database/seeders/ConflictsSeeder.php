<?php

namespace Database\Seeders;

use App\Models\Conflict;
use App\Models\Country;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use ZipArchive;

class ConflictsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        set_time_limit(100000);

        $url = 'https://war-memorial.net/wars_all.asp?q=3';
        $domain = 'https://war-memorial.net/';

        $response = file_get_contents($url);
        $response = mb_convert_encoding($response, 'UTF-8', 'ISO-8859-1');;
        $containerStart = strpos($response, '<div class="maincol semi-wide">');

        $start = strpos($response, '<table ', $containerStart);
        $end = strpos($response, '</table>', $start);

        if ($start === false || $end === false) {
            throw new \Exception("Cannot get contents from war-memorail.net");
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
            if($iter !== 0){

                $tdPos = strpos($row, '<td ');
                $warNameStart = strpos($row, '>', $tdPos) + 1;
                $warNameEnd = strpos($row, '</td>', $tdPos);
                $warName = str_replace(['	', "\n", "\r\n", "\n\r", "\r"], '', strip_tags(substr($row, $warNameStart,
                    $warNameEnd - $warNameStart)));
                $warName = str_replace('', "'", $warName);
                $warName = str_replace('', "-", $warName);
                $warName = str_replace('  ', " ", $warName);
                $warName = str_replace("''", '"', $warName);
                if(str_starts_with(' ', $warName)){
                    $warName = substr($warName, 1);
                }

                $warLinkStart = strpos($row, '<a href="') + 9;
                $warLinkEnd = strpos($row, '"', $warLinkStart);
                $warLink = substr($row, $warLinkStart, $warLinkEnd - $warLinkStart);
                $warLink = str_replace('', "'", $warLink);
                $warLink = str_replace('', "-", $warLink);

                $tdPos = strpos($row, '<td ', $tdPos + 1);
                $dateStart = strpos($row, '>', $tdPos) + 1;
                $dateEnd = strpos($row, '</td>', $tdPos);
                $dates = explode('-', substr($row, $dateStart, $dateEnd - $dateStart));

                $tdPos = strpos($row, '<td ', $tdPos + 1);
                $casualtiesStart = strpos($row, '>', $tdPos) + 1;
                $casualtiesEnd = strpos($row, '</td>', $tdPos);
                $casualties = substr($row, $casualtiesStart, $casualtiesEnd - $casualtiesStart);
                $casualties = str_replace(',', '', $casualties);

                $conflict_details = file_get_contents($domain . $warLink);
                $curPos = strpos($conflict_details, 'Nation(s) involved and/or conflict territory');
                $curPos = strpos($conflict_details, '<a ', $curPos);
                $curPos = strpos($conflict_details, '<a ', $curPos + 1);
                $countriesEnd = strpos($conflict_details, '</p>', $curPos);
                $countries = explode(', ', strip_tags(substr($conflict_details, $curPos, $countriesEnd - $curPos)));
                $countries = array_diff($countries, ['', ' ']);

                $warsData[] = [
                    'war_name' => $warName,
                    'war_link' => $domain . $warLink,
                    'start_date' => $dates[0],
                    'end_date' => $dates[1],
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

        foreach ($warsData as $warsDataItem) {
            $conflict = Conflict::make([
                'name' => $warsDataItem['war_name'],
                'link' => $warsDataItem['war_link'],
                'start_date' => date_create(str_replace(' ', '', $warsDataItem['start_date']) . '-01-01')->format('Y-01-01'),
                'end_date' => date_create(str_replace(' ', '', $warsDataItem['end_date']) . '-12-31')->format('Y-01-01'),
                'casualties' => $warsDataItem['casualties'],
            ]);

            $conflict->save();

            foreach($warsDataItem['countries'] as $country) {
                $involvedCountry = Country::firstOrCreate(['name' => $country]);
                $involvedCountry->save();

                $conflict->countries()->attach($involvedCountry->id);
            }
        }
    }
}
