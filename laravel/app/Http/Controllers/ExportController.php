<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ExportController extends Controller
{
    public function export(Request $request)
    {
//        dump($request->input('option'));
        $format = $request->input('format');
        $option = $request->input('option');
        $fileName = '';
        $result = [];

        // Logika eksportu danych do JSON lub XML
        switch($option){
            case 'conflicts':
                $result = (new ConflictController())->getConflicts($request);
                $fileName = 'conflicts';
                break;
            case 'commodities':
                $commodityController = new CommodityController();
                $types = $commodityController->getTypes($request);
                foreach($types as $option){
                    $units = $commodityController->getCommodityUnits($request, $option['name']);
                    foreach ($units as $unit) {
                        $result[] = $commodityController->getPrices($request, $unit, $option['name']);
                    }
                }
                $fileName = 'commodity_prices';
                break;
            default:
//                $result = ['There is no such category'];
                $result = print_r($option) . ' ' . $format;
        }

        switch($format){
            case 'json':
                return response()->streamDownload(function () use ($result) {
                    echo json_encode($result, JSON_PRETTY_PRINT);
                }, $fileName . '.json', [
                    'Content-Type' => 'application/json',
                ]);
            case 'xml':
                return response()->streamDownload(function () use ($result) {
                    echo array_to_xml($result);
                }, $fileName . '.xml', [
                    'Content-Type' => 'application/xml',
                ]);
        }
    }
}
