<?php
use App\Modules\Evenement\Http\Controllers\EvenementController;
use App\Modules\Evenement\Http\Controllers\Evenements_CategorieController;

Route::group([
    'middleware' => 'api',
    'prefix' => 'api/evenements'

], function ($router) {
    Route::post('/create', [EvenementController::class, 'create']);
    Route::get('/', [EvenementController::class, 'index']);
    Route::get('/{id}', [EvenementController::class, 'get']);
    Route::post('/update', [EvenementController::class, 'update']);
    Route::post('/delete', [EvenementController::class, 'destroy']);
    Route::post('/disable', [EvenementController::class, 'disable']);
    Route::post('/enable', [EvenementController::class, 'enable']);
    Route::post('/sendEvenementImagesStoragePath', [EvenementController::class, 'sendEvenementImagesStoragePath']);

});



Route::group([
    'middleware' => 'api',
    'prefix' => 'api/evenements_categories'

], function ($router) {
    Route::post('/create', [Evenements_CategorieController::class, 'create']);
    Route::get('/', [Evenements_CategorieController::class, 'index']);
    Route::get('/{id}', [Evenements_CategorieController::class, 'get']);
    Route::get('/evenements/{id}', [Evenements_CategorieController::class, 'getEvenements']);
    Route::post('/update', [Evenements_CategorieController::class, 'update']);
    Route::post('/delete', [Evenements_CategorieController::class, 'destroy']);

});
