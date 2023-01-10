<?php

use App\Http\Controllers\AppointmentController;
use App\Http\Controllers\Auth\NewPasswordController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\InterventionHistoryController;
use App\Http\Controllers\InterventionController;
use App\Http\Controllers\PatientController;
use App\Http\Controllers\PaymentController;
use App\Http\Controllers\ShortcutController;
use App\Http\Controllers\ThirdPartyApiController;
use App\Http\Controllers\FileController;
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


Route::middleware(['auth:sanctum', 'check.license'])->get('/user', function (Request $request) {
    return $request->user();
});

Route::middleware(['auth:sanctum', 'check.license'])->group(function () {
    //Dashboard
    Route::get('/dashboard', [DashboardController::class, 'index']);
    Route::get('/dashboard/chart/{param}', [DashboardController::class, 'show']);

    //Patient
    Route::get('/patients/all', [PatientController::class, 'all']);
    Route::get('/patients/search/{name}', [PatientController::class, 'search']);
    Route::apiResource('/patients', PatientController::class);

    //Interventions
    Route::apiResource('/{patient}/interventions', InterventionController::class)->only('index', 'store');
    Route::apiResource('/interventions', InterventionController::class)->except('index', 'store');

    //Intervention history
    Route::apiResource('/{intervention}/history', InterventionHistoryController::class)->only('index');
    Route::apiResource('/history', InterventionHistoryController::class)->except('index');

    //Payments
    Route::apiResource('/{intervention}/payments', PaymentController::class)->only('index');
    Route::apiResource('/payments', PaymentController::class)->except('index');

    //Appointments
    Route::apiResource('/appointments', AppointmentController::class);

    //Files
    Route::post('/patients/{patient}/file-upload', [FileController::class,'upload']);

    //Settings
    Route::get('/shortcuts/{type}', [ShortcutController::class, 'index']);
    Route::post('/shortcuts', [ShortcutController::class, 'store']);
    Route::post('/change-password', [NewPasswordController::class, 'changePassword']);
    Route::get('/dwa', [ThirdPartyApiController::class, 'dwa']);
});

