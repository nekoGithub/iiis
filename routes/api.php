<?php

use App\Http\Controllers\AccessController;
use App\Http\Controllers\PeopleController;
use App\Http\Controllers\RfidCardController;
use App\Models\Access;
use App\Models\RfidCard;
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



// routes/api.php

// Api para registrar primero verifica /verificar-rfid/{id} y 
// y despues hacemos una peticion post para guardar /asociar-rfid.
Route::get('/verificar-rfid/{id}', [RfidCardController::class, 'verificar']);
Route::post('/asociar-rfid',[RfidCardController::class, 'store']);

// Hacemos una peticion y hacemos el registro de entradas y salidas
Route::post('/registrar-acceso', [AccessController::class, 'registrarAcceso']);

// Api para ver en pantalla 
Route::get('/ultimo-acceso', [AccessController::class ,'ultimoAccess']);

