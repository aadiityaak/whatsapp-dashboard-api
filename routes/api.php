<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PostsController;
use App\Http\Controllers\TermsController;

Route::middleware(['auth:sanctum'])->get('/user', function (Request $request) {
    // return $request->user();
    $results = $request->user();

    // Dapatkan semua permissions
    $permissons = $request->user()->getPermissionsViaRoles();

    //collection permissions
    $results['user_permissions'] = collect($permissons)->pluck('name');

    unset($results->roles);

    return $results;
});

Route::middleware(['auth:sanctum'])->group(function () {
    Route::apiResources([
        'posts'         => PostsController::class,
        'terms'         => TermsController::class
    ]);
});

require __DIR__ . '/api-dash.php';

use App\Http\Controllers\Api\WhatsappSessionController;

Route::get('/sessions', [WhatsappSessionController::class, 'index']);
Route::post('/sessions', [WhatsappSessionController::class, 'store']);
Route::put('/sessions/{id}/status', [WhatsappSessionController::class, 'updateStatus']);
