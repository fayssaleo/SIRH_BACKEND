<?php
use App\Modules\Document\Http\Controllers\DocumentCategorieController;
use App\Modules\Document\Http\Controllers\DocumentController;

Route::group([
    'middleware' => 'api',
    'prefix' => 'api/documents_categories'

], function ($router) {
    Route::get('/', [DocumentCategorieController::class, 'index']);
    Route::post('/create', [DocumentCategorieController::class, 'create']);
    Route::post('/update', [DocumentCategorieController::class, 'update']);
    Route::get('/{id}', [DocumentCategorieController::class, 'get']);
    Route::post('/delete', [DocumentCategorieController::class, 'destroy']);
    Route::get('/{id}/documents', [DocumentCategorieController::class, 'getActualites']);
});


Route::group([
    'middleware' => 'api',
    'prefix' => 'api/documents'

], function ($router) {
    Route::post('/create', [DocumentController::class, 'create']);
    Route::get('/', [DocumentController::class, 'index']);
    Route::post('/delete', [DocumentController::class, 'destroy']);
    Route::post('/sendDocumentFilesStoragePath', [DocumentController::class, 'sendDocumentFilesStoragePath']);
    /*Route::post('/update', [ActualiteController::class, 'update']);
    Route::post('/disable', [ActualiteController::class, 'disable']);
    Route::post('/enable', [ActualiteController::class, 'enable']);
//    Route::get('/{id}', [EvenementController::class, 'get']);*/

});