<?php

use App\Modules\Utilisateur\Http\Controllers\UtilisateurController;
use \App\Modules\Utilisateur\Http\Controllers\PrivilegeController;
use \App\Modules\Utilisateur\Http\Controllers\RoleController;


Route::group([
    'middleware' => 'api',
    'prefix' => 'api/utilisateur'

], function ($router) {
    Route::post('/register/', [UtilisateurController::class, 'register']);
    Route::post('/login', [UtilisateurController::class, 'login']);
    Route::post('/loginForMobile/', [UtilisateurController::class, 'loginMobileAPI']);
});


Route::group([
    'middleware' => 'auth:sanctum',
    'prefix' => 'api/utilisateur'

], function ($router) {
    Route::post('/logout/', [UtilisateurController::class, 'logout']);
    Route::post('/test/', [UtilisateurController::class, 'test']);
});

Route::group([
    'middleware' => 'api',
    'prefix' => 'api/privileges'

], function ($router) {
    Route::post('/', [PrivilegeController::class, 'create']);
    Route::get('/{id}', [PrivilegeController::class, 'getPrivilege']);
});

Route::group([
    'middleware' => 'api',
    'prefix' => 'api/roles'

], function ($router) {
    Route::get('/', [RoleController::class, 'index']);
    Route::post('/create', [RoleController::class, 'create']);
    Route::post('/update', [RoleController::class, 'update']);
    Route::post('/delete', [RoleController::class, 'delete']);
    Route::get('/{id}', [RoleController::class, 'getRole']);
    Route::post('/setPrivileges', [RoleController::class, 'setPrivileges']);
    Route::get('/{id}/privileges/', [RoleController::class, 'getRolePrivileges']);
});
