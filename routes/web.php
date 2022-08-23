<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\UserController;
use App\Http\Controllers\ClienteController;
use App\Http\Controllers\PrestamoController;
use App\Http\Controllers\PrestamoCuotaController;
use App\Http\Controllers\DashboardController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', [DashboardController::class, 'index'])->middleware(['auth'])->name('dashboard');

Route::get('/usuarios', [UserController::class, 'index'])->middleware(['auth'])->name('usuarios');
Route::get('/clientes', [ClienteController::class, 'index'])->middleware(['auth'])->name('clientes');
Route::get('/prestamos', [PrestamoController::class, 'index'])->middleware(['auth'])->name('prestamos');
Route::get('/prestamos/create', [PrestamoController::class, 'create'])->middleware(['auth'])->name('prestamosCreate');
Route::post('/prestamos/store', [PrestamoController::class, 'store'])->middleware(['auth'])->name('prestamosStore');
Route::get('/plan-pagos', [PrestamoCuotaController::class, 'index'])->middleware(['auth'])->name('planPagos');
Route::post('/plan-pagos/store', [PrestamoCuotaController::class, 'store'])->middleware(['auth'])->name('planPagosStore');
Route::get('/registrar-pago', [PrestamoCuotaController::class, 'create'])->middleware(['auth'])->name('planPagosCreate');
require __DIR__.'/auth.php';
