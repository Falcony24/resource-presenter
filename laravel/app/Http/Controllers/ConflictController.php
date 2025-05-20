<?php

namespace App\Http\Controllers;

use App\Models\Conflict;
use App\Models\Country;
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
            return $q->where('start_date', '>=', date_create($request->get('start_date'))->format('Y-m-d'));
        });

        $query->when($request->has('casualties_min'), function ($q) use ($request) {
            return $q->where('casualties', '>=', $request->integer('casualties_min'));
        });

        $query->when($request->has('casualties_max'), function ($q) use ($request) {
            return $q->where('casualties', '<=', $request->integer('casualties_max'));
        });

        return $query->get();
    }

    public function getDescription(Request $request): array
    {
        return ConflictsDescriptionAlias::$description;
    }



    //dodałam dodawanie !!!!!
      public function create(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'link' => 'nullable|url',
            'start_date' => 'nullable|date',
            'end_date' => 'nullable|date|after_or_equal:start_date',
            'casualties' => 'nullable|string|max:255',
            'countries' => 'required|string'
        ]);

        $countries = explode(';', $validated['countries']);

        $newConflict = Conflict::create([
            'name' => $validated['name'],
            'link' => $validated['link'],
            'start_date' => $validated['start_date'],
            'end_date' => $validated['end_date'],
            'casualties' => $validated['casualties']
        ]);

        foreach($countries as $country){
            $involvedCountry = Country::where('name', '=', $country)->firstOrCreate(['name' => $country]);
            $newConflict->countries()->syncWithoutDetaching([$involvedCountry->id]);
        }

        $newConflict->save();

        return view('components.add-conflict-success');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'link' => 'nullable|url',
            'start_date' => 'nullable|date',
            'end_date' => 'nullable|date|after_or_equal:start_date',
            'casualties' => 'nullable|string|max:255',
        ]);

        Conflict::create($validated);

        return redirect()->route('conflicts.create')->with('success', 'Konflikt został dodany.');
    }
}
