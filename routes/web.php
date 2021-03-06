<?php

use App\Http\Controllers\PricePlanComparatorController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\MeterReadingController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Route::get('readings/read/{smartMeterId}',[MeterReadingController::class, 'getReading']);
Route::post('readings/store/',[MeterReadingController::class, 'storeReadings']);
Route::get('price-plans/recommend/{smartMeterId}/{limit?}',[PricePlanComparatorController::class, 'recommendCheapestPricePlans']);
Route::get('price-plans/compare-all/{smartMeterId}',[PricePlanComparatorController::class, 'calculatedCostForEachPricePlan']);

