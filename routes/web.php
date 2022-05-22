<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\OverviewController;
use App\Http\Controllers\TableController;
use App\Http\Controllers\GraphicsController;



Route::get('/', [OverviewController::class, 'index']);
Route::get('/', [OverviewController::class, 'allData']);

Route::get('/table', [TableController::class, 'index']);
Route::get('/table', [TableController::class, 'getDataByMonthAndDay']);

Route::get('/graphics', [GraphicsController::class, 'index']);
Route::get('/graphics', [GraphicsController::class, 'getDataByPeriod']);

