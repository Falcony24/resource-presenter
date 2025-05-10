<?php

namespace Database\Seeders;

use App\Models\CommoditiesPricesUnit;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class CommoditiesPricesUnitsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        CommoditiesPricesUnit::create(['name' => 'Index', 'symbol' => 'IX'])->save();
        CommoditiesPricesUnit::create(['name' => 'Percent Change, Corresponding Period, Previous Year, Percent', 'symbol' => 'PC_CP_A_PT'])->save();
        CommoditiesPricesUnit::create(['name' => 'Percent Change, Previous Period, Percent', 'symbol' => 'PC_PP_PT'])->save();
        CommoditiesPricesUnit::create(['name' => 'US Dollars', 'symbol' => 'USD'])->save();
        CommoditiesPricesUnit::create(['name' => 'All Units', 'symbol' => 'All_Units'])->save();
    }
}
