<?php

namespace Database\Seeders;

use App\Models\CommoditiesPrice;
use App\Models\CommoditiesPricesUnit;
use App\Models\CommoditiesType;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class CommoditiesPricesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        CommoditiesType::all()->each(function (CommoditiesType $commodityType) {
            try{
                $url = "http://dataservices.imf.org/REST/SDMX_JSON.svc/CompactData/PCPS/M.." . $commodityType->name . "?startPeriod=1600&endPeriod=" . date('Y');

                $response = file_get_contents($url);

                $data = json_decode($response, true);

                foreach ($data['CompactData']['DataSet']['Series'] as $batch){
                    $unit = $batch["@UNIT_MEASURE"];

                    $data = $batch["Obs"];

                    $unitID = CommoditiesPricesUnit::where('symbol', $unit)->first()->id;

                    set_time_limit(3000);

                    $recordData = [];

                    foreach($data as $item){
                        $recordData[] = [
                            'date' => date_create($item['@TIME_PERIOD'])->format("Y-m-t"),
                            'value' => $item['@OBS_VALUE'],
                            'unit' => $unitID
                        ];
                    }

                    $commodityType->prices()->createMany($recordData)->save();
                }

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

            } catch (\Exception $exception) {

            }
        });
    }
}
