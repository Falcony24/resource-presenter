<?php

namespace Database\Seeders;

use App\Models\CommoditiesPrice;
use App\Models\CommoditiesPricesUnit;
use App\Models\CommoditiesType;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Log;

class CommoditiesPricesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        set_time_limit(30000);

        foreach (CommoditiesType::pluck('name')->toArray() as $commodityType) {

            $tmp = json_decode(file_get_contents("http://dataservices.imf.org/REST/SDMX_JSON.svc/CompactData/PCPS/M.." .
                $commodityType .
                "?startPeriod=1900&endPeriod=" . date('Y')), true);

            // Sprawdzenie czy dane są prawidłowe
            if (!isset($tmp['CompactData']['DataSet']['Series'])) {
                Log::warning('Brak danych dla commodityType: ' . $commodityType);
                Log::warning('Odpowiedź API: ' . json_encode($tmp));
                continue;  // pomiń i przejdź do następnego surowca
            }

            $commodityId = CommoditiesType::where('name', $commodityType)->first()->id;

            foreach ($tmp['CompactData']['DataSet']['Series'] as $batch) {
                $unit = $batch['@UNIT_MEASURE'];
                $unitId = CommoditiesPricesUnit::where('symbol', $unit)->first()->id;
                $values = $batch['Obs'];

                foreach ($values as $value) {
                    CommoditiesPrice::create([
                        'commodity' => $commodityId,
                        'date' => date_create($value['@TIME_PERIOD'])->format("Y-m-t"),
                        'value' => $value['@OBS_VALUE'],
                        'unit' => $unitId,
                    ])->save();
                }
            }
        };
    }
}
