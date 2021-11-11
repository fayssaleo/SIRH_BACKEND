<?php
use App\Modules\Collaborateur\Http\Controllers\CollaborateurController;
use \App\Modules\Collaborateur\Http\Controllers\DepartementController;
use App\Modules\Collaborateur\Http\Controllers\FonctionController;




//Collaborateurs

Route::group([
    'middleware' => 'api',
    'prefix' => 'api'

], function ($router) {
    Route::post('/collaborateurs/create', [CollaborateurController::class, 'create']);
    Route::get('/collaborateurs/', [CollaborateurController::class, 'index']);
    Route::get('/collaborateurs/{id}', [CollaborateurController::class, 'get']);
    Route::post('/collaborateurs/delete', [CollaborateurController::class, 'destroy']);
    Route::post('/collaborateurs/disable', [CollaborateurController::class, 'disable']);
    Route::post('/collaborateurs/enable', [CollaborateurController::class, 'enable']);
    Route::post('/collaborateurs/update', [CollaborateurController::class, 'update']);
    Route::post('/collaborateurs/collCreateUser', [CollaborateurController::class, 'collCreateUser']);
    Route::post('/collaborateurs/photoFolderUrl', [CollaborateurController::class, 'sendPhotosStoragePath']);

});







//Fonctions

Route::group([
    'middleware' => 'api',
    'prefix' => 'api'

], function ($router) {
    Route::post('/fonctions/create', [FonctionController::class, 'create']);
    Route::get('/fonctions/', [FonctionController::class, 'index']);
    Route::get('/fonctions/{id}', [FonctionController::class, 'get']);
    Route::post('/fonctions/update', [FonctionController::class, 'update']);
    Route::post('/fonctions/delete', [FonctionController::class, 'destroy']);
    Route::get('/fonctions/{id}/departement', [FonctionController::class, 'showDepartement']);

});


//Departements

Route::group([
    'middleware' => 'api',
    'prefix' => 'api'

], function ($router) {
    Route::get('/departements/', [DepartementController::class, 'index']);
    Route::post('/departements/create', [DepartementController::class, 'create']);
    Route::post('/departements/update', [DepartementController::class, 'update']);
    Route::post('/departements/delete', [DepartementController::class, 'destroy']);
    Route::get('/departements/{id}', [DepartementController::class, 'get']);
    Route::get('/departements/{id}/fonctions', [DepartementController::class, 'getFonctions']);
});
