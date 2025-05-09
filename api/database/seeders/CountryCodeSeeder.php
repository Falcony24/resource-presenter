<?php

namespace Database\Seeders;

use App\Models\CountryCode;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class CountryCodeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $url = 'https://en.wikipedia.org/wiki/List_of_ISO_3166_country_codes';
        $protocolDomain = 'https://en.wikipedia.org/wiki';
        $html = file_get_contents($url);
        $tmp_pos = strpos($html, '<h2 id="Current_ISO_3166_country_codes">Current ISO 3166 country codes</h2>');
        $html = substr($html, $tmp_pos);
        $html = substr($html, strpos($html, '<table class="sortable wikitable sticky-header-multi sort-under col1left col2left" style="text-align: center">'));
        $html = substr($html, 0 , strpos($html, '</table>'));

        $rowNum = 0;
        $iter = 0;
        echo '<table>';
        while($rowNum !== false) {
            $iter++;
            $start = strpos($html, '<tr>', $rowNum);
            $end = strpos($html, '</tr>', $start);
            $rowNum = $end + 5;
            if($iter < 3){
                continue;
            }
            if ($start === false || $end === false) {
                break;
            }
            $row = substr($html, $start, $end - $start + 5);
            $rowPos = 0;
            $tmp = substr($row, strpos($row, '<a href="', strpos($row, '<a href="') + 9));
            $tmp = substr($tmp, 9);
            $wikiUrl = $protocolDomain . substr($tmp, 0, strpos($tmp, '"'));

            $tmp = substr($tmp, strpos($tmp, '>') + 1);
            $countryName = substr($tmp, 0, strpos($tmp, '<'));

            $tmp = substr($tmp, strpos($tmp, '<td'));
            $tmp = substr($tmp, strpos($tmp, '>') + 1);
            $tmp = substr($tmp, strpos($tmp, '>') + 1);
            $offitialCountryName = substr($tmp, 0 , strpos($tmp, '<'));

            $tmp = substr($tmp, strpos($tmp, '<td') + 3);
            $tmp = substr($tmp, strpos($tmp, '<td') + 3);
            $tmp = substr($tmp, strpos($tmp, '<span') + 5);
            $tmp = substr($tmp, strpos($tmp, '>') + 1);
            $a_2_code = substr($tmp,0, strpos($tmp, '</span>'));

            if($a_2_code == ""){
                continue;
            }

            $tmp = substr($tmp, strpos($tmp, '<td') + 3);
            $tmp = substr($tmp, strpos($tmp, '<span'));
            $tmp = substr($tmp, strpos($tmp, '>') + 1);
            $a_3_code = substr($tmp, 0, strpos($tmp, '</span>'));

            $tmp = substr($tmp, strpos($tmp, '<td') + 4);
            $tmp = substr($tmp, strpos($tmp, '<span') + 5);
            $tmp = substr($tmp, strpos($tmp, '>') + 1);
            $num_code = substr($tmp, 0, strpos($tmp, '</span>'));

            CountryCode::make([
                'iso_name' => $countryName,
                'official_state_name' => $offitialCountryName,
                'wiki_link' => $wikiUrl,
                'iso_a-2_code' => $a_2_code,
                'iso_a-3_code' => $a_3_code,
                'iso_num_code' => $num_code,
            ])->save();
        }
    }
}
