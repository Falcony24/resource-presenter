<?php

namespace Database\Seeders;

use App\Models\Commodities_type;
use App\Models\CommoditiesType;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class CommoditiesTypesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $response = file_get_contents("http://dataservices.imf.org/REST/SDMX_JSON.svc/DataStructure/PCPS");

        $data = json_decode($response, true);

        $data = $data['Structure']['CodeLists']['CodeList'][3]['Code'];

//        CommoditiesType::truncate();

        foreach($data as $item) {
            if($item["@value"] === "All_Indicators" || $item['Description']["#text"] === "All Indicators"){
                continue;
            }

            $commoditySymbol = $item["@value"];

            $commodityDesc = "";

            if(substr($item['Description']["#text"], 0, 26) === "Primary Commodity Prices, "){
                $commodityDesc = substr($item['Description']["#text"], 26, strlen($item['Description']["#text"]) - 26);
            } else {
                $commodityDesc = $item['Description']["#text"];
            }

            CommoditiesType::create(["name" => $commoditySymbol, "description" => $commodityDesc])->save();
        }
    }
}
