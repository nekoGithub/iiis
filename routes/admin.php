<?php

use App\Http\Controllers\AccessController;
use App\Http\Controllers\PeopleController;
use App\Http\Controllers\RfidCardController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function(){
    return view('admin.dashboard');
})->name('dashboard');


Route::get('/users', [UserController::class, 'index'])->name('users.index');
Route::get('/peoples', [PeopleController::class, 'index'])->name('peoples.index');
Route::get('/rfidCards', [RfidCardController::class, 'index'])->name('rfidCards.index');
Route::get('/access', [AccessController::class, 'index'])->name('access.index');
