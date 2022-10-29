<?php

use App\Http\Controllers\InterventionController;
use App\Http\Controllers\PatientController;
use App\Http\Controllers\PaymentController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/


Route::middleware(['auth:sanctum'])->get('/user', function (Request $request) {
    return $request->user();
});

Route::apiResource('/patients', PatientController::class);
Route::apiResource('/{patient}/interventions', InterventionController::class)->only('index', 'store', 'update');
Route::apiResource('/interventions', InterventionController::class);
Route::apiResource('/{intervention}/payments', PaymentController::class)->only('index', 'store', 'update');
Route::apiResource('/payments', PaymentController::class);

