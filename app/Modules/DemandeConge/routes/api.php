<?php
use \App\Modules\DemandeConge\Http\Controllers\TypeCongeController;
use \App\Modules\DemandeConge\Http\Controllers\DemandeCongeController;
//Collaborateurs

Route::group([
    'middleware' => 'api',
    'prefix' => 'api'

], function () {
    Route::post('/typeConges/create', [TypeCongeController::class, 'create']);
    Route::get('/typeConges/', [TypeCongeController::class, 'index']);
    Route::post('/typeConges/congeCategories/create', [TypeCongeController::class, 'addCongeCategorie']);
    Route::get('/typeConges/congeCategories/', [TypeCongeController::class, 'listCongeCategorie']);
    Route::get('/typeConges/congeCategories/{id}', [TypeCongeController::class, 'getCongeType']);
    Route::post('/typeConges/congeCategories/congesTypes', [TypeCongeController::class, 'getCongeTypesByCategorie']);
    Route::post('/typeConges/congeCategories/update', [TypeCongeController::class, 'updateCongeTypeCategorie']);
    Route::post('/typeConges/listCongeCategorie/disable', [TypeCongeController::class, 'disableCongeCategorie']);
    Route::post('/typeConges/listCongeCategorie/enable', [TypeCongeController::class, 'enableCongeCategorie']);
    Route::get('/typeConges/{id}', [TypeCongeController::class, 'get']);
    Route::post('/typeConges/disable', [TypeCongeController::class, 'disable']);
    Route::post('/typeConges/enable', [TypeCongeController::class, 'enable']);
    Route::post('/typeConges/update', [TypeCongeController::class, 'update']);

});


Route::group([
    'middleware' => 'api',
    'prefix' => 'api'
], function () {
    Route::get('/demandeConges/', [DemandeCongeController::class, 'index']);
    Route::post('/demandeConges/create', [DemandeCongeController::class, 'create']);
    Route::get('/demandeConges/{id}', [DemandeCongeController::class, 'get']);
    Route::post('/demandeConges/delete', [DemandeCongeController::class, 'destroy']);
    Route::post('/demandeConges/accepter', [DemandeCongeController::class, 'accepter']);
    Route::post('/demandeConges/refuser', [DemandeCongeController::class, 'refuser']);
    Route::post('/demandeConges/feedMSgEdit', [DemandeCongeController::class, 'feedMSgEdit']);

});