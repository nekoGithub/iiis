<?php

use App\Http\Controllers\AccessController;
use App\Http\Controllers\RfidCardController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Route;

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
    return $request->user();
});

Route::get('/rfid-status/{id}', [RfidCardController::class, 'verificarEstadoRFID']);

Route::post('/rfid', [RfidCardController::class, 'store']);

Route::post('/rfid-assign-waiting',[RfidCardController::class, 'assignWaiting']);

// Para los access  
Route::get('access/rfid', [AccessController::class, 'procesarAccesoPorRfid']);

/* Route::post('/rfid-access', [AccessController::class, 'registrarAcceso']); */
