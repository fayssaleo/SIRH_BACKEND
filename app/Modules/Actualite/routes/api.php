<?php
use App\Modules\Actualite\Http\Controllers\ActualiteCategorieController;
use App\Modules\Actualite\Http\Controllers\ActualiteController;

Route::group([
    'middleware' => 'api',
    'prefix' => 'api/actualites_categories'

], function ($router) {
    Route::get('/', [ActualiteCategorieController::class, 'index']);
    Route::post('/create', [ActualiteCategorieController::class, 'create']);
    Route::post('/update', [ActualiteCategorieController::class, 'update']);
    Route::get('/{id}', [ActualiteCategorieController::class, 'get']);
    Route::post('/delete', [ActualiteCategorieController::class, 'destroy']);
    Route::get('/{id}/actualites', [ActualiteCategorieController::class, 'getActualites']);

});


Route::group([
    'middleware' => 'api',
    'prefix' => 'api/actualites'

], function ($router) {
    Route::post('/create', [ActualiteController::class, 'create']);
    Route::get('/categories/{id}', [ActualiteController::class, 'index']);
    Route::get('/', [ActualiteController::class, 'index']);
    Route::post('/update', [ActualiteController::class, 'update']);
    Route::post('/delete', [ActualiteController::class, 'destroy']);
    Route::post('/disable', [ActualiteController::class, 'disable']);
    Route::post('/enable', [ActualiteController::class, 'enable']);
    Route::post('/sendActualiteImagesStoragePath', [ActualiteController::class, 'sendActualiteImagesStoragePath']);
//    Route::get('/{id}', [EvenementController::class, 'get']);

});