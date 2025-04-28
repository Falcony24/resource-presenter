<?php

use App\Models\CommoditiesPrice;
use App\Models\CommoditiesPricesUnit;
use App\Models\CommoditiesType;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/user', function (Request $request) {
    return $request->user();
});

Route::get('/commoditiesTypes', function (Request $request) {
    $tmp = [];

    CommoditiesType::all()->each(function ($commodityType) use (&$tmp) {
        $tmp[] = ["name" => $commodityType->name,
            "description" => $commodityType->description];
    });

    return $tmp;
});

Route::get('/commodityUnits/{commodity}', function (Request $request, $commodity) {
    $com = CommoditiesType::where('name', "$commodity")->firstOr(function () {
        $result = ["error" => true, "message" => "Commodity not found"];
        return $result;
    });

    $result = [];

    $com->prices()->groupBy('unit')->get()->each(function ($price) use (&$result) {
        $result[] = $price->unit()->get()->first()->name;
    });

    return $result;
});

Route::get('/commodityPrices/{unit}/{commodity}', function (Request $request, $unit, $commodity) {
    $errorMessege = "";

    $commodityType = CommoditiesType::where('name', '=', $commodity)->firstOr(function () use (&$errorMessege) {
        $errorMessege .= "Commodity not found\n";
    });
    $commodityUnit = CommoditiesPricesUnit::where('name', '=', $unit)->firstOr(function () use (&$errorMessege) {
        $errorMessege .= "Unit not found\n";
    });

    if($errorMessege === ""){
        $result = CommoditiesPrice::where('commodity', '=', $commodityType->id)->where('unit', '=', $commodityUnit->id)
            ->orderBy('date', 'asc')->get();
        if($result->isEmpty()){
            $errorMessege = "There are no commodities available for this unit\n";
        }
    }

    if($errorMessege !== "") {
        return ["error" => true, "message" => $errorMessege];
    } else {
        return $result;
    }
});

Route::get("test", function (Request $request) {

//    dd("" . date_create("1900-01")->format("Y-m-d"));
//    $url = "http://dataservices.imf.org/REST/SDMX_JSON.svc/CompactData/PCPS/M.." . CommoditiesType::first()->name . "?startPeriod=1600&endPeriod=" .
//        date('Y');
//
//    $response = file_get_contents($url);
//
//    $data = json_decode($response, true);
//
//    return $data;
//    dump(date_create("1900-01"));

//    $tmp = new \App\Models\CommoditiesPrice(['date' => '1900-01-01', 'value' => 1.00023012, 'unit' => 1, 'commodity' => 1]);
//    $tmp->save();

    set_time_limit(100000);

    $type = CommoditiesType::first();

    try{
        $url = "http://dataservices.imf.org/REST/SDMX_JSON.svc/CompactData/PCPS/M.." . $type->name . "?startPeriod=1600&endPeriod=" . date('Y');

        $response = file_get_contents($url);

        $data = json_decode($response, true);

        $unit = $data['CompactData']['DataSet']['Series'][0]["@UNIT_MEASURE"];

        $data = $data['CompactData']['DataSet']['Series'][0]["Obs"];

//            dd($unit);

//            dd($response);

        $unitID = CommoditiesPricesUnit::where('symbol', $unit)->first()->id;

//            dd($unitID);

        set_time_limit(1000000);

        $recordData = [];

        foreach($data as $item){
            $recordData[] = [
                'date' => "'" . date_create($item['@TIME_PERIOD'])->format("Y-m-d") . "'",
                'value' => $item['@OBS_VALUE'],
                'unit' => $unitID
            ];
        }

        $type->prices()->createMany($recordData);

    } catch (\Exception $exception) {
        dd($exception->getMessage());
    }

//    CommoditiesType::get()->first(function (CommoditiesType $commodityType) {
//        try{
//            $url = "http://dataservices.imf.org/REST/SDMX_JSON.svc/CompactData/PCPS/M.." . $commodityType->name . "?startPeriod=1600&endPeriod=" . date('Y');
//
//            $response = file_get_contents($url);
//
//            $data = json_decode($response, true);
//
//            $unit = $data['CompactData']['DataSet']['Series'][0]["@UNIT_MEASURE"];
//
//            $data = $data['CompactData']['DataSet']['Series'][0]["Obs"];
//
////            dd($unit);
//
////            dd($response);
//
//            $unitID = CommoditiesPricesUnit::where('symbol', $unit)->first()->id;
//
////            dd($unitID);
//
//            set_time_limit(1000000);
//
//            $recordData = [];
//
//            foreach($data as $item){
//                $recordData[] = [
//                    'date' => "'" . date_create($item['@TIME_PERIOD'])->format("Y-m-d") . "'",
//                    'value' => $item['@OBS_VALUE'],
//                    'unit' => $unitID
//                ];
//            }
//
//            $commodityType->prices()->createMany($recordData);
//
//        } catch (\Exception $exception) {
//            dd($exception->getMessage());
//        }
//    });


//    CommoditiesType::first()->each(function (CommoditiesType $commodityType) {
//        $url = "http://dataservices.imf.org/REST/SDMX_JSON.svc/CompactData/PCPS/M.." . $commodityType->name . "?startPeriod=1600&endPeriod=" . date('Y');
//
//        $response = file_get_contents($url);
//
//        $data = json_decode($response, true);
//
////        dd($data);
//
//        $data = $data['CompactData']['DataSet']['Series'][0]["Obs"];
//
//        foreach($data as $item){
//            $commodityType->prices()->create([
//                'date' => date_create($item['@TIME_PERIOD'])->format("Y-m-d"),
//                'value' => $item['@OBS_VALUE'],
//                'unit' => 1
//            ]);
//        }
//    });
//
//    CommoditiesType::all()->each(function (CommoditiesType $commodityType) {
//        $url = "http://dataservices.imf.org/REST/SDMX_JSON.svc/CompactData/PCPS/M.." . $commodityType->name . "?startPeriod=1600&endPeriod=" . date('Y');
//
//        $response = file_get_contents($url);
//
//        $data = json_decode($response, true);
//
//        $data = $data['CompactData']['DataSet']['Series'][0];
//
//        set_time_limit(1000000);
//
//        foreach($data as $item){
//            $commodityType->prices()->create([
//                'date' => "'" . date_create($item['@TIME_PERIOD'])->format("Y-m-d") . "'",
//                'value' => $item['@OBS_VALUE'],
//                'unit' => 1
//            ])->save();
//        }
//    });
});

