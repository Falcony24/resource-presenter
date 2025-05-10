<?php

namespace Database\Seeders;

use App\Models\Conflict;
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
        $handle = fopen(base_path("UcdpPrioConflict_v24_1.csv"), "r");

        if(!$handle) {
            throw new Exception("Unable to open file!");
        }

        $result = [];
        $createData = [];

        while($part = fgetcsv($handle)) {
            if($part[0] === "conflict_id") {
                continue;
            }

            Conflict::create([
                'conflict_id' => $part[0],
                'location' => $part[1],
                'side_a' => $part[2],
                'side_a_2nd' => $part[4],
                'side_b' => $part[5],
                'side_b_2nd' => $part[7],
                'incompatibility' => $part[8],
                'territory_name' => $part[9],
                'year' => $part[10],
                'intensity_level' => $part[11],
                'cumulative_intensity' => $part[12],
                'type_of_conflict' => $part[13],
                'start_date' => date_create($part[14])->format('Y-m-d'),
                'start_date_2nd' => date_create($part[16])->format('Y-m-d'),
                'end_date' => date_create($part[19])->format('Y-m-d') ?? null,
                'region' => $part[26],
            ])->save();
        }

        fclose($handle);
    }
}
