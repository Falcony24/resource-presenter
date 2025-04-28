<?php

namespace Database\Seeders;

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
        $url = "https://ucdp.uu.se/downloads/ucdpprio/ucdp-prio-acd-241-csv.zip";

        file_put_contents(basename($url), file_get_contents($url));

        $zip = new ZipArchive();

        $zip->open(basename($url));

        $zip->extractTo(base_path());

        $zip->close();

        $conflicts_csv = file_get_contents(base_path("UcdpPrioConflict_v24_1.csv"));
    }
}
