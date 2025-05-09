<?php

use App\Http\Controllers\ConflictController;
use App\Http\Controllers\TestApiController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('components.home');
})->name('home');

Route::get('/surowce', function () {
    $tmp = new \App\Http\Controllers\CommodityController();
    return view('components.commodities', ['commodities' => $tmp->getTypes(request())]);
})->name('commodities');

Route::get('/konflikty', function () {
    $tmp = new ConflictController();
    return view('components.conflicts', ['conflicts' => $tmp->getConflicts(request())]);
})->name('conflicts');

Route::get('/analiza', function () {
    $tmp = new ConflictController();
    return view('components.analysis', ['conflicts' => $tmp->getConflicts(request())]);
})->name('analysis');

