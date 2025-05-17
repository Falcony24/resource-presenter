<?php

namespace App\Http\Controllers;

use App\Models\Conflict;
use App\Utils\CompareDates;
use App\Utils\ConflictsDescription as ConflictsDescriptionAlias;
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

        if($request->has('start_date') && $request->has('end_date') && CompareDates::isGreater
            ($request->get('start_date'), $request->get('end_date'))) {
            $errorMessege .= "end_date must be greater or equal than the start_date\n";
        }

        if($request->has('countries')){
            $location = $request->get('countries');
            $location = explode(',', $location);
//            $tmp = getConflictsLocations();
//            if(!in_array($location, $tmp)){
//                $errorMessege .= "Given location is invalid\n";
//            }
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

        return $query->get();
    }

    public function getDescription(Request $request): array
    {
        return ConflictsDescriptionAlias::$description;
    }
}
