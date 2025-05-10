<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ExportController extends Controller
{
    public function export(Request $request)
    {
        $format = $request->input('format');
        $type = $request->input('type');
        // Logika eksportu danych do JSON lub XML
        return response()->json(['message' => 'Eksport zakończony sukcesem']);
    }
}