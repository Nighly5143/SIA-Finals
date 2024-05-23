<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\FoodController;
use App\Https\Controllers\OrderController;
use App\Http\Controllers\QRScannerController;

Route::get('/', function () {
    return view('base');
});

Route::get('/food', [FoodController::class, 'view'])->name('food');
Route::get('/food/create', [FoodController::class, 'create']);
Route::post('/food/create', [FoodController::class, 'store']);
Route::get('/food/{food}', [FoodController::class, 'edit']);
Route::get('/food/{food}/edit', [FoodController::class, 'edit']);
Route::post('/food/{food}', [FoodController::class, 'update']);
Route::put('/food/{food}', [FoodController::class, 'update']);
Route::get('delete/food/{id}', [FoodController::class, 'destroy']);
Route::delete('food/delete/{food}', [FoodController::class, 'delete']);

Route::get('/foods/csv-all', [FoodController::class, 'generateCSV']);
Route::get('foods/pdf', [FoodController::class, 'pdf']);
Route::post('/foods/import-csv', [FoodController::class, 'importCSV'])->name('foods.import-csv');

Route::get('/scanner', [QRScannerController::class, 'index']);
Route::post('/qr-scan-result', [QRScannerController::class, 'scanResult']);

