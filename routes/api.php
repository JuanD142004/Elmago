<?php

use App\Http\Controllers\DepartamentController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CustomerController;
use App\Http\Controllers\SaleController;
use App\Http\Controllers\DetailsSaleController;
use App\Models\Departament;
use App\Models\Municipality;

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

Route::put('/customers/{id}/enable', [CustomerController::class, 'enable'])->name('customer.enable');
Route::put('/customers/{id}/disable', [CustomerController::class, 'disable'])->name('customer.disable');

Route::resource('customer', CustomerController::class);

// Ruta para habilitar/inhabilitar una venta
Route::put('/sales/{sale}/toggle', [SaleController::class, 'toggle'])->name('sales.toggle');

// Rutas para el controlador de detalles de venta y el controlador de ventas
Route::resource('details_sale', DetailsSaleController::class);
Route::resource('sales', SaleController::class);