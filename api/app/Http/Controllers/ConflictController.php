<?php

namespace App\Http\Controllers;

use App\Models\Conflict;
use Exception;
use Illuminate\Http\Request;

class ConflictController extends Controller
{
    public function getConflicts(Request $request) {
        $errorMessege = "";
        $regions = [];

        set_error_handler(function ($errno, $errstr, $errfile, $errline) use ($errorMessege) {
            return ["error" => true, "message" => $errorMessege];
        });

        if($request->has('start_date') && $request->has('start_date_2nd') && CompareDates::isGreater
            ($request->get('start_date'), $request->get('start_date_2nd'))) {
            $errorMessege .= "start_date_2nd must be greater or equal than the start_date\n";
        }

        if($request->has('start_date_2nd') && $request->has('end_date') && CompareDates::isGreater
            ($request->get('start_date_2nd'), $request->get('end_date'))) {
            $errorMessege .= "end_date must be greater or equal than the start_date_2nd\n";
        }

        if($request->has('end_date') && $request->has('start_date') && CompareDates::isGreater
            ($request->get('start_date'), $request->get('end_date'))) {
            $errorMessege .= "end_date must be greater or equal than the start_date\n";
        }

        if($request->has('region')){
            $regions = explode(',', $request->input('region'));
            $tmp = getConflictsRegions();
            foreach($regions as $region){
                if(!in_array($region, $tmp)){
                    $errorMessege .= "Given region(s) is invalid\n";
                    break;
                }
            }
        }

        if($request->has('location')){
            $location = $request->get('location');
            $tmp = getConflictsLocations();
            if(!in_array($location, $tmp)){
                $errorMessege .= "Given location is invalid\n";
            }
        }

        if($errorMessege !== ""){
            throw new Exception($errorMessege);
        }

        $query = Conflict::query();

        $query->when($request->has('end_date'), function ($q) use ($request) {
            return $q->where('end_date', '<=', date_create($request->get('end_date'))->format('Y-m-d'));
        });

        $query->when($request->has('start_date'), function ($q) use ($request) {
            return $q->where('start_date', '>=', date_create($request->get('start_date_1st'))->format('Y-m-d'));
        });

        $query->when($request->has('start_date_2nd'), function ($q) use ($request) {
            return $q->where('start_date_2nd', '>=', date_create($request->get('start_date_1st'))->format('Y-m-d'));
        });

        $query->when($request->has('region'), function ($q) use ($regions, $request) {
            return $q->whereIn('region', $regions);
        });

        $query->when($request->has('location'), function ($q) use ($request) {
            return $q->where('location', '=', $request->get('location'));
        });

        return $query->get();
    }

    public function getDescription(Request $request) {
        return \App\Utils\ConflictsDescription::$description;
    }
}
