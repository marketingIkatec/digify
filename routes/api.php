<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\AccountDigifyHubspotController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    //return $request->user();
});

Route::prefix('app-digify')->middleware('digify.token')->group(function () {
    Route::post('/create-account', [
        AccountDigifyHubspotController::class,
        'createAccountDigifyStore'
    ]);

    Route::post('/account-logged-in', [
        AccountDigifyHubspotController::class,
        'accountLoggedInStore'
    ]);

    Route::post('/account-actions', [
        AccountDigifyHubspotController::class,
        'accountActionsStore'
    ]);
});