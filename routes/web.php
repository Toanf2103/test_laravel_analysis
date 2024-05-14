<?php

use App\Http\Controllers\AnalysisPriceController as ControllersAnalysisPriceController;
use App\Http\Controllers\DataTable\AnalysisPriceController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Route::group(['prefix' => 'analysis-prices', 'as' => 'analysisPrices.'], function () {
    Route::get('/', [ControllersAnalysisPriceController::class, 'index'])->name('index');
});;


Route::group(['prefix' => 'datatable', 'as' => 'datatable.'], function () {
    Route::get('/', [AnalysisPriceController::class, 'index'])->name('index');
    Route::post('/', [AnalysisPriceController::class, 'store'])->name('store');
    Route::post('/{analysisPrice}', [AnalysisPriceController::class, 'update'])->name('update');
    Route::get('/{analysisPrice}', [AnalysisPriceController::class, 'show'])->name('show');
});;
