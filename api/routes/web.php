<?php

use App\Http\Controllers\CommodityController;
use App\Http\Controllers\ConflictController;
use App\Http\Controllers\TestApiController;
use App\Http\Controllers\ProfileController;

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\ExportController;

Route::post('/export', [ExportController::class, 'export'])->name('export');
Route::get('/', function () {
    return view('components.home');
})->name('home');

Route::get('/surowce', function () {
    $tmp = new CommodityController();
    return view('components.commodities', ['commodities' => $tmp->getTypes(request())]);
})->name('commodities');

Route::get('/konflikty', function () {
    $tmp = new ConflictController();
    return view('components.conflicts', ['conflicts' => $tmp->getConflicts(request())]);
})->name('conflicts');

Route::get('/analiza', function () {
    $tmp = new CommodityController();
    return view('components.analysis', ['commodities' => $tmp->getTypes(request())]);
})->name('analysis');
Route::get('/dashboard', function () {
    return view('components.dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});



require __DIR__.'/auth.php';

