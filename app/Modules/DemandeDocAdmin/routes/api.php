<?php
use \App\Modules\DemandeDocAdmin\Http\Controllers\DemandeDocAdminController;
Route::group([
    'middleware' => 'api',
    'prefix' => 'api'
], function () {
    Route::get('/demandeDocAdmin/index', [DemandeDocAdminController::class, 'index']);
    Route::post('/demandeDocAdmin/create', [DemandeDocAdminController::class, 'create']);
    Route::post('/demandeDocAdmin/accepter', [DemandeDocAdminController::class, 'accepter']);
    Route::post('/demandeDocAdmin/refuser', [DemandeDocAdminController::class, 'refuser']);
    Route::post('/demandeDocAdmin/feedMSgEdit', [DemandeDocAdminController::class, 'feedMSgEdit']);
    Route::get('/demandeDocAdmin/categories', [DemandeDocAdminController::class, 'demandeDocAdminsCategories']);
    Route::post('/demandeDocAdmin/downloadDocumentFile', [DemandeDocAdminController::class, 'downloadDocumentFile']);

});