<?php

use App\Http\Controllers\AccessController;
use App\Http\Controllers\AuditoriaController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\PeopleController;
use App\Http\Controllers\ReconocimientoController;
use App\Http\Controllers\ReportController;
use App\Http\Controllers\RfidCardController;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\ScreenController;
use App\Http\Controllers\UserController;
use App\Models\Access;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Admin Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/
Route::get('/', [DashboardController::class, 'index'])->name('dashboard');
Route::get('/vistas', [DashboardController::class, 'show'])->name('vistas.index');



Route::get('/users', [UserController::class, 'index'])->name('users.index');
Route::get('/roles', [RoleController::class, 'index'])->name('roles.index');
Route::get('/peoples', [PeopleController::class, 'index'])->name('peoples.index');
Route::get('/rfidCards', [RfidCardController::class, 'index'])->name('rfidCards.index');
Route::get('/access', [AccessController::class, 'index'])->name('access.index');
Route::get('/screens', [ScreenController::class, 'index'])->name('screns.index');
Route::get('/reports', [ReportController::class, 'index'])->name('reports.index');

Route::get('/auditorias', [AuditoriaController::class, 'index'])->name('auditorias.index');

Route::get('/reconocimientos', [ReconocimientoController::class, 'index']);

