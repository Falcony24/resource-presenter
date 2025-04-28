<?php

use App\Http\Controllers\TestApiController;
use Illuminate\Support\Facades\Route;

Route::get('/', [TestApiController::class, 'index']);
