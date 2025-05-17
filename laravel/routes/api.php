<?php

use App\Http\Controllers\CommodityController;
use App\Http\Controllers\ConflictController;
use App\Models\CommoditiesPrice;
use App\Models\CommoditiesPricesUnit;
use App\Models\CommoditiesType;
use App\Models\Conflict;
use App\Models\ConflictTest2;
use App\Models\Country;
use App\Utils\CompareDates as CompareDates;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;



Route::get('/commodities/create', [CommodityController::class, 'createPriceForm'])->name('commodities.create');
Route::post('/commodities/store', [CommodityController::class, 'storePrice'])->name('commodities.store');


Route::get('/user', function (Request $request) {
    return $request->user();
});

Route::get('/commoditiesTypes', [CommodityController::class, 'getTypes']);

Route::get('/commodityUnits/{commodity}', [CommodityController::class, 'getCommodityUnits']);

Route::get('/commodityPrices/{unit}/{commodity}', [CommodityController::class, 'getPrices']);

Route::get('/conflicts', [ConflictController::class, 'getConflicts']);

Route::get('/conflicts/description', [ConflictController::class, 'getDescription']);

Route::get('/test', function (Request $request) {

//    return print_r(explode(', ', "Cambodia,"));

    set_time_limit(100000);

    $url = 'https://war-memorial.net/wars_all.asp?q=3';
    $domain = 'https://war-memorial.net/';

    $response = file_get_contents($url);
    $containerStart = strpos($response, '<div class="maincol semi-wide">');

    $start = strpos($response, '<table ', $containerStart);
    $end = strpos($response, '</table>', $start);

    if ($start === false || $end === false) {
        return "ERROR";
    }

    $end += strlen('</table>');
    $table = substr($response, $start, $end - $start);

    $rowStart = 0;
    $iter = 0;

    $warsData = [];

    echo '<table>';

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
            echo $row;

            $tdPos = strpos($row, '<td ');
            $warNameStart = strpos($row, '>', $tdPos) + 1;
            $warNameEnd = strpos($row, '</td>', $tdPos);
            $warName = str_replace(['	', "\n", "\r\n", "\n\r", "\r"], '', strip_tags(substr($row, $warNameStart,
                $warNameEnd -
                $warNameStart)));

            $warLinkStart = strpos($row, '<a href="') + 9;
            $warLinkEnd = strpos($row, '"', $warLinkStart);
            $warLink = substr($row, $warLinkStart, $warLinkEnd - $warLinkStart);

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

    echo '</table>';

//    return print_r($warsData);

    foreach ($warsData as $warsDataItem) {
        $conflict = ConflictTest2::make([
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
        echo date_create(str_replace(' ', '', $warsDataItem['start_date']) . '-01-01')->format('Y-m-d') . '</br>';
    }

//    return substr($response, $start, $end - $start);

//    $finalRet = [];
//
//    set_time_limit(30000);
//
//    foreach(CommoditiesType::pluck('name')->toArray() as $commodityType) {
//
//        $tmp = json_decode(file_get_contents("http://dataservices.imf.org/REST/SDMX_JSON.svc/CompactData/PCPS/M.." .
//            $commodityType .
//            "?startPeriod=1900&endPeriod=" . date('Y')), true);
//
//        $commodityId = CommoditiesType::where('name', $commodityType)->first()->id;
//
//        foreach($tmp['CompactData']['DataSet']['Series'] as $batch){
//            $unit = $batch['@UNIT_MEASURE'];
//            $unitId = CommoditiesPricesUnit::where('symbol', $unit)->first()->id;
//            $values = $batch['Obs'];
//
//            foreach($values as $value){
//                CommoditiesPrice::create([
//                    'commodity' => $commodityId,
//                    'date' => date_create($value['@TIME_PERIOD'])->format("Y-m-t"),
//                    'value' => $value['@OBS_VALUE'],
//                    'unit' => $unitId,
//                ])->save();
//            }
//        }
//    };
//
////    return $tmp['CompactData']['DataSet']['Series'];
//
//    return CommoditiesType::first()->name;
//
//    CommoditiesType::all()->each(function (CommoditiesType $commodityType) {
//        try{
//            $url = "http://dataservices.imf.org/REST/SDMX_JSON.svc/CompactData/PCPS/M.." . $commodityType->name .
//                "?startPeriod=1900&endPeriod=" . date('Y');
//
//            $response = file_get_contents($url);
//
//            $data = json_decode($response, true);
//
//            return $data;
//
//            $finalRet[] = $data;

//            foreach ($data['CompactData']['DataSet']['Series'] as $batch){
//                $unit = $batch["@UNIT_MEASURE"];
//
//                $data = $batch["Obs"];
//
//                $unitID = CommoditiesPricesUnit::where('symbol', $unit)->first()->id;
//
//                set_time_limit(3000);
//
//                $recordData = [];
//                echo "ok";
//                foreach($data as $item){
//                    $recordData[] = [
//                        'date' => date_create($item['@TIME_PERIOD'])->format("Y-m-t"),
//                        'value' => $item['@OBS_VALUE'],
//                        'unit' => $unitID
//                    ];
//                }
//
//                $finalRet[] = $recordData;
//
////                $commodityType->prices()->createMany($recordData)->save();
//            }

//                $unit = $data['CompactData']['DataSet']['Series'][0]["@UNIT_MEASURE"];
//
//                $data = $data['CompactData']['DataSet']['Series'][0]["Obs"];
//
//                $unitID = CommoditiesPricesUnit::where('symbol', $unit)->first()->id;
//
//                set_time_limit(1000000);
//
//                $recordData = [];
//
//                foreach($data as $item){
//                    $recordData[] = [
//                        'date' => date_create($item['@TIME_PERIOD'])->format("Y-m-t"),
//                        'value' => $item['@OBS_VALUE'],
//                        'unit' => $unitID
//                    ];
//                }
//
//                $commodityType->prices()->createMany($recordData)->save();

//        } catch (\Exception $exception) {
//            return 'ERROR';
//        }
//    });
//
////    return json_encode($finalRet);
//    return $finalRet;

    //===================== wiki armed conflicts scraper =======================

//    $url = 'https://en.wikipedia.org/wiki/List_of_wars:_1990%E2%80%932002';
//    $url = 'https://api.wikimedia.org/core/v1/wikipedia/en/page/List_of_wars:_1990%E2%80%932002/html';
//    $protocolDomain = 'https://en.wikipedia.org/wiki';
//    $html = file_get_contents($url);
//
////    $pos = strpos($html, '<tbody>');
////    echo $pos;
//    $start = strpos($html, '<table ');
//    $end = strpos($html, '</table>');
//
//    $table = substr($html, $start, $end - $start + 8);
//    $result = '';
//    $rowBeg = 0;
//    $rowEnd = 0;
//
//
//    $iter = 0;
//
//    while(true){
//        $iter++;
//
//        $rowBeg = strpos($table, '<tr ', $rowBeg);
//        $rowEnd = strpos($table, '</tr>', $rowEnd);
//
//        if($iter < 3){
//            $rowBeg++;
//            $rowEnd++;
//            continue;
//        }
//
//        if($iter > 20){
//            break;
//        }
//
//        if($iter % 2 == 0){
//            echo '<div style="background-color: #dddddd">';
//        } else {
//            echo '<div style="background-color: #ffffff">';
//        }
//        echo substr($table, $rowBeg, $rowEnd - $rowBeg);
//        echo '</div>';
//        echo '</br>';
//
//        $rowBeg++;
//        $rowEnd++;
//    }

//    return $table;

});

//Route::get("test", function (Request $request) {
//
//    dd(phpversion());
//
//    CommoditiesType::all()->each(function (CommoditiesType $commodityType) {
//        try{
//            $url = "http://dataservices.imf.org/REST/SDMX_JSON.svc/CompactData/PCPS/M.." . $commodityType->name . "?startPeriod=1600&endPeriod=" . date('Y');
//
//            $response = file_get_contents($url);
//
//            $data = json_decode($response, true);
//
//            foreach ($data['CompactData']['DataSet']['Series'] as $batch){
//                $unit = $batch["@UNIT_MEASURE"];
//
//                $data = $batch["Obs"];
//
//                $unitID = CommoditiesPricesUnit::where('symbol', $unit)->first()->id;
//
//                set_time_limit(3000);
//
//                $recordData = [];
//
//                foreach($data as $item){
//                    $recordData[] = [
//                        'date' => date_create($item['@TIME_PERIOD'])->format("Y-m-t"),
//                        'value' => $item['@OBS_VALUE'],
//                        'unit' => $unitID
//                    ];
//                }
//
//                $commodityType->prices()->createMany($recordData)->save();
//            }
//
////                $unit = $data['CompactData']['DataSet']['Series'][0]["@UNIT_MEASURE"];
////
////                $data = $data['CompactData']['DataSet']['Series'][0]["Obs"];
////
////                $unitID = CommoditiesPricesUnit::where('symbol', $unit)->first()->id;
////
////                set_time_limit(1000000);
////
////                $recordData = [];
////
////                foreach($data as $item){
////                    $recordData[] = [
////                        'date' => date_create($item['@TIME_PERIOD'])->format("Y-m-t"),
////                        'value' => $item['@OBS_VALUE'],
////                        'unit' => $unitID
////                    ];
////                }
////
////                $commodityType->prices()->createMany($recordData)->save();
//
//        } catch (\Exception $exception) {
//            return $exception->getMessage();
//        }
//    });
//
//    dd(getConflictsIncompatibilities());
//
//    $tmpArr = Conflict::all()->groupBy('region')->toArray();
//
//    $return = [];
//
//    foreach($tmpArr as $key => $value){
//        $return[] = $key;
//    }
//
//    $tmpArr = $return;
//    $return = [];
//
//    foreach($tmpArr as $key => $value){
//        if(gettype($value) === 'integer'){
//            $return[] = $value;
//        } else {
//            $return = array_merge($return, array_map(function ($item) {
//                return (integer)$item;
//            }, explode(", ", $value)));
////            $return[] = explode(", ", $value);
//        }
//    }
//
//    $return = array_unique($return);
//
//    dd(getConflictsRegions());
//
//    dd(CompareDates::isLess(date_create('2025-04-29'), 'now'));
//
//    echo gettype("tmp") . '<br>';
//    echo get_class(date_create("now")) . '<br>';
//
//    dd();
//
//    $handle = fopen(base_path("UcdpPrioConflict_v24_1.csv"), "r");
//
//    if(!$handle) {
//        throw new Exception("Unable to open file!");
//    }
//
//    $result = [];
//    $createData = [];
//
//    while($part = fgetcsv($handle)) {
//        if($part[0] === "conflict_id") {
//            continue;
//        }
//
//        Conflict::create([
//            'conflict_id' => $part[0],
//            'location' => $part[1],
//            'side_a' => $part[2],
//            'side_a_2nd' => $part[4],
//            'side_b' => $part[5],
//            'side_b_2nd' => $part[7],
//            'incompatibility' => $part[8],
//            'territory_name' => $part[9],
//            'year' => $part[10],
//            'intensity_level' => $part[11],
//            'cumulative_intensity' => $part[12],
//            'type_of_conflict' => $part[13],
//            'start_date' => date_create($part[14])->format('Y-m-d'),
//            'start_date_2nd' => date_create($part[16])->format('Y-m-d'),
//            'end_date' => date_create($part[19])->format('Y-m-d'),
//            'region' => $part[26],
//        ])->save();
//
//        $createData[] = [
//            'conflict_id' => $part[0],
//            'location' => $part[1],
//            'side_a' => $part[2],
//            'side_a_2nd' => $part[4],
//            'side_b' => $part[5],
//            'side_b_2nd' => $part[7],
//            'incompatibility' => $part[8],
//            'territory_name' => $part[9],
//            'year' => $part[10],
//            'intensity_level' => $part[11],
//            'cumulative_intensity' => $part[12],
//            'type_of_conflict' => $part[13],
//            'start_date' => date_create($part[14])->format('Y-m-d'),
//            'start_date_2nd' => date_create($part[16])->format('Y-m-d'),
//            'end_date' => date_create($part[19])->format('Y-m-d'),
//            'region' => $part[26],
//        ];
//    }
//
////    Conflict::makeMany($createData)->save();
//
//    return Conflict::all();
//
//    fclose($handle);
//
//    return $result;
//
//    return gettype($conflicts_csv = file_get_contents(base_path("UcdpPrioConflict_v24_1.csv")));
//
////    dd("" . date_create("1900-01")->format("Y-m-d"));
////    $url = "http://dataservices.imf.org/REST/SDMX_JSON.svc/CompactData/PCPS/M.." . CommoditiesType::first()->name . "?startPeriod=1600&endPeriod=" .
////        date('Y');
////
////    $response = file_get_contents($url);
////
////    $data = json_decode($response, true);
////
////    return $data;
////    dump(date_create("1900-01"));
//
////    $tmp = new \App\Models\CommoditiesPrice(['date' => '1900-01-01', 'value' => 1.00023012, 'unit' => 1, 'commodity' => 1]);
////    $tmp->save();
//
//    set_time_limit(100000);
//
//    $type = CommoditiesType::first();
//
//    try{
//        $url = "http://dataservices.imf.org/REST/SDMX_JSON.svc/CompactData/PCPS/M.." . $type->name . "?startPeriod=1600&endPeriod=" . date('Y');
//
//        $response = file_get_contents($url);
//
//        $data = json_decode($response, true);
//
//        $unit = $data['CompactData']['DataSet']['Series'][0]["@UNIT_MEASURE"];
//
//        $data = $data['CompactData']['DataSet']['Series'][0]["Obs"];
//
////            dd($unit);
//
////            dd($response);
//
//        $unitID = CommoditiesPricesUnit::where('symbol', $unit)->first()->id;
//
////            dd($unitID);
//
//        set_time_limit(1000000);
//
//        $recordData = [];
//
//        foreach($data as $item){
//            $recordData[] = [
//                'date' => "'" . date_create($item['@TIME_PERIOD'])->format("Y-m-d") . "'",
//                'value' => $item['@OBS_VALUE'],
//                'unit' => $unitID
//            ];
//        }
//
//        $type->prices()->createMany($recordData);
//
//    } catch (\Exception $exception) {
//        dd($exception->getMessage());
//    }
//
////    CommoditiesType::get()->first(function (CommoditiesType $commodityType) {
////        try{
////            $url = "http://dataservices.imf.org/REST/SDMX_JSON.svc/CompactData/PCPS/M.." . $commodityType->name . "?startPeriod=1600&endPeriod=" . date('Y');
////
////            $response = file_get_contents($url);
////
////            $data = json_decode($response, true);
////
////            $unit = $data['CompactData']['DataSet']['Series'][0]["@UNIT_MEASURE"];
////
////            $data = $data['CompactData']['DataSet']['Series'][0]["Obs"];
////
//////            dd($unit);
////
//////            dd($response);
////
////            $unitID = CommoditiesPricesUnit::where('symbol', $unit)->first()->id;
////
//////            dd($unitID);
////
////            set_time_limit(1000000);
////
////            $recordData = [];
////
////            foreach($data as $item){
////                $recordData[] = [
////                    'date' => "'" . date_create($item['@TIME_PERIOD'])->format("Y-m-d") . "'",
////                    'value' => $item['@OBS_VALUE'],
////                    'unit' => $unitID
////                ];
////            }
////
////            $commodityType->prices()->createMany($recordData);
////
////        } catch (\Exception $exception) {
////            dd($exception->getMessage());
////        }
////    });
//
//
////    CommoditiesType::first()->each(function (CommoditiesType $commodityType) {
////        $url = "http://dataservices.imf.org/REST/SDMX_JSON.svc/CompactData/PCPS/M.." . $commodityType->name . "?startPeriod=1600&endPeriod=" . date('Y');
////
////        $response = file_get_contents($url);
////
////        $data = json_decode($response, true);
////
//////        dd($data);
////
////        $data = $data['CompactData']['DataSet']['Series'][0]["Obs"];
////
////        foreach($data as $item){
////            $commodityType->prices()->create([
////                'date' => date_create($item['@TIME_PERIOD'])->format("Y-m-d"),
////                'value' => $item['@OBS_VALUE'],
////                'unit' => 1
////            ]);
////        }
////    });
////
////    CommoditiesType::all()->each(function (CommoditiesType $commodityType) {
////        $url = "http://dataservices.imf.org/REST/SDMX_JSON.svc/CompactData/PCPS/M.." . $commodityType->name . "?startPeriod=1600&endPeriod=" . date('Y');
////
////        $response = file_get_contents($url);
////
////        $data = json_decode($response, true);
////
////        $data = $data['CompactData']['DataSet']['Series'][0];
////
////        set_time_limit(1000000);
////
////        foreach($data as $item){
////            $commodityType->prices()->create([
////                'date' => "'" . date_create($item['@TIME_PERIOD'])->format("Y-m-d") . "'",
////                'value' => $item['@OBS_VALUE'],
////                'unit' => 1
////            ])->save();
////        }
////    });
//});

