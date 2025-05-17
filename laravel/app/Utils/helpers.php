<?php

use App\Models\Conflict;
use App\Models\Country;

function getConflictsRegions(): array{
    $tmpArr = Conflict::all()->groupBy('region')->toArray();

    $return = [];

    foreach($tmpArr as $key => $value){
        $return[] = $key;
    }

    $tmpArr = $return;
    $return = [];

    foreach($tmpArr as $key => $value){
        if(gettype($value) === 'integer'){
            $return[] = $value;
        } else {
            $return = array_merge($return, array_map(function ($item) {
                return (integer)$item;
            }, explode(", ", $value)));
        }
    }

    $return = array_unique($return);
    sort($return);

    return $return;
}

function getConflictsLocations(): array{
    $tmpArr = Country::all()->toArray();
//    sort($tmpArr);
    usort($tmpArr, function ($a, $b) {
        return strcmp($a['name'], $b['name']);
    });

    return $tmpArr;
}

function getCountriesForConflict(Conflict $conflict): array {
    return $conflict->countries()->get()->pluck('name')->toArray();
}

function getConflictsWithLocations(): array
{
    return Conflict::with('countries')->get()->toArray();
}

function getConflictsIntensityLevels():array {
    $tmpArr = Conflict::all()->groupBy('intensity_level')->toArray();
    $return = [];

    foreach($tmpArr as $key => $value){
        $return[] = $key;
    }

    return $return;
}

function getConflictsCumulativeIntensities():array {
    $tmpArr = Conflict::all()->groupBy('cumulative_intensity')->toArray();
    $return = [];

    foreach($tmpArr as $key => $value){
        $return[] = $key;
    }

    return $return;
}

function getConflictsTypes():array {
    $tmpArr = Conflict::all()->groupBy('type_of_conflict')->toArray();
    $return = [];

    foreach($tmpArr as $key => $value){
        $return[] = $key;
    }

    sort($return);

    return $return;
}

function getConflictsIncompatibilities():array {
    $tmpArr = Conflict::all()->groupBy('incompatibility')->toArray();
    $return = [];

    foreach($tmpArr as $key => $value){
        $return[] = $key;
    }

    sort($return);

    return $return;
}

function array_to_xml($array, SimpleXMLElement $xml = null) {
    if ($xml === null) {
        $xml = new SimpleXMLElement('<result/>');
    }

    foreach ($array as $key => $value) {
        $key = is_numeric($key) ? "item$key" : $key;

        if (is_array($value)) {
            array_to_xml($value, $xml->addChild($key));
        } else {
            $xml->addChild($key, htmlspecialchars((string)$value));
        }
    }

    return $xml->asXML();
}

