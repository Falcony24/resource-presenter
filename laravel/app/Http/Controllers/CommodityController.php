<?php

namespace App\Http\Controllers;

use App\Models\CommoditiesPrice;
use App\Models\CommoditiesPricesUnit;
use App\Models\CommoditiesType;
use Illuminate\Http\Request;

class CommodityController extends Controller
{
    public function getTypes(Request $request){
        $tmp = [];

        CommoditiesType::all()->each(function ($commodityType) use (&$tmp) {
            $tmp[] = ["name" => $commodityType->name,
                "description" => $commodityType->description];
        });

        return $tmp;
    }

    public function getCommodityUnits(Request $request, $commodity) {
        $com = CommoditiesType::where('name', "$commodity")->firstOr(function () {
            $result = ["error" => true, "message" => "Commodity not found"];
            return $result;
        });

        $result = [];

        $com->prices()->groupBy('unit')->get()->each(function ($price) use (&$result) {
            $result[] = $price->unit()->get()->first()->name;
        });

        return $result;
    }

    public function getPrices(Request $request, $unit, $commodity) {
        $errorMessege = "";

        $commodityType = CommoditiesType::where('name', '=', $commodity)->firstOr(function () use (&$errorMessege) {
            $errorMessege .= "Commodity not found\n";
        });
        $commodityUnit = CommoditiesPricesUnit::where('symbol', '=', $unit)->firstOr(function () use (&$errorMessege) {
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
    }

      // Metoda wyświetlająca formularz dodawania surowca
    public function createPriceForm()
    {
        return view('components.create');
    }

    // Metoda do zapisywania surowca
    public function storePrice(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string',
            'description' => 'required|string',
        ]);

        $commodity = new CommoditiesType();
        $commodity->name = $validated['name'];
        $commodity->description = $validated['description'];
        $commodity->save();

        return redirect()->route('commodities.create')->with('success', 'Surowiec został dodany.');
    }
}
