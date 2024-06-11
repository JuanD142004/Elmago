<?php

use App\Http\Controllers\DepartamentController;
use App\Http\Controllers\DetailsSaleController;
use App\Http\Controllers\DetailsLoadController;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\auth;
use App\Http\Controllers\LoadController;
use App\Http\Controllers\EmployeeController;
use App\Http\Controllers\RouteController;
use App\Http\Controllers\SaleController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\DetailsPurchaseController;
use App\Http\Controllers\MunicipalityController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\PurchaseController;
use App\Http\Controllers\SupplierController;
use App\Http\Controllers\TruckTypeController;

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

Route::get('/', function () {
    return view('auth.login');
});

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

// Rutas de autenticación
Auth::routes();

// Rutas de recursos para los usuarios
Route::resource('user', UserController::class);
Route::patch('/user/{id}/update_status', [UserController::class, 'updateStatus'])->name('user.update_status');
Route::get('/users', [UserController::class, 'index']);

// Rutas para los productos
Route::resource('product', ProductController::class);
Route::patch('/product/disable/{id}', [ProductController::class, 'disable'])->name('product.disable');
Route::patch('/product/enable/{id}', [ProductController::class, 'enable'])->name('product.enable');
Route::patch('/product/{id}/update_status', [ProductController::class, 'updateStatus'])->name('product.update_status');

// Rutas para los proveedores
Route::resource('supplier', SupplierController::class);
Route::patch('/supplier/disable/{id}', [SupplierController::class, 'disable'])->name('supplier.disable');
Route::patch('/supplier/enable/{id}', [SupplierController::class, 'enable'])->name('supplier.enable');
Route::patch('/supplier/{id}/update_status', [SupplierController::class, 'updateStatus'])->name('supplier.update_status');

// Rutas para los tipos de camión
Route::resource('truck_type', TruckTypeController::class);
Route::patch('/truck_type/disable/{id}', [TruckTypeController::class, 'disable'])->name('truck_type.disable');
Route::patch('/truck_type/enable/{id}', [TruckTypeController::class, 'enable'])->name('truck_type.enable');
Route::patch('/truck_type/{id}/update_status', [TruckTypeController::class, 'updateStatus'])->name('truck_type.update_status');
Route::delete('/truck_type/{id}', [TruckTypeController::class, 'destroy'])->name('truck_type.destroy');
Route::get('/truck_type/{id}/edit', [TruckTypeController::class, 'edit'])->name('truck_type.edit');

// Rutas para los departamentos
Route::resource('departament', DepartamentController::class);
Route::patch('/departament/disable/{id}', [DepartamentController::class, 'disable'])->name('departament.disable');
Route::patch('/departament/enable/{id}', [DepartamentController::class, 'enable'])->name('departament.enable');
Route::patch('/departament/{id}/update_status', [DepartamentController::class, 'updateStatus'])->name('departament.update_status');

// Rutas para los municipios
Route::resource('municipality', MunicipalityController::class);

// // Rutas para rutas
// Route::get('/route/create/departament/{departament}/municipalities', [DepartamentController::class, 'municipalities']);
// Route::resource('route', RouteController::class);
// Route::patch('/route/disable/{id}', [RouteController::class, 'disable'])->name('route.disable');
// Route::patch('/route/enable/{id}', [RouteController::class, 'enable'])->name('route.enable');
// Route::patch('/route/{id}/update_status', [RouteController::class, 'updateStatus'])->name('route.update_status');
// Route::post('/route/update-status/{id}', [RouteController::class, 'updateStatus'])->name('update_status');


Route::get('/route/create/departament/{departament}/municipalities', [App\Http\Controllers\DepartamentController::class, 'municipalities']);
// Ruta para inhabilitar la ruta
Route::patch('/route/disable/{id}', [App\Http\Controllers\RouteController::class, 'disable'])->name('route.disable');

// Ruta para habilitar un tipo ruta
Route::patch('/route/enable/{id}', [App\Http\Controllers\RouteController::class, 'enable'])->name('route.enable');
// Ruta para actualizar el estado de la ruta
Route::patch('/route/{id}/update_status', [App\Http\Controllers\RouteController::class, 'updateStatus'])->name('update_status');
// web.php
Route::patch('route/update_status/{id}', [RouteController::class, 'updateStatus'])->name('update_status');
Route::resource('route', RouteController::class);


// Rutas para empleados
Route::resource('employee', EmployeeController::class);
Route::patch('/employee/disable/{id}', [EmployeeController::class, 'disable'])->name('employee.disable');
Route::patch('/employee/enable/{id}', [EmployeeController::class, 'enable'])->name('employee.enable');
Route::patch('/employee/{id}/update_status', [EmployeeController::class, 'updateStatus' ])->name('employee.update_status');
Route::get('/employee/{id}', [EmployeeController::class, 'show'])->name('employee.show');

// Rutas para cargas
Route::resource('load', LoadController::class);
Route::post('/enviar-formulario', [LoadController::class, 'enviarFormulario'])->name('tu.ruta.de.envio');
Route::get('/loads/create/{loadId}', [LoadController::class, 'create'])->name('loads.create');
Route::get('/loads/create', [LoadController::class, 'create'])->name('loads.create');
Route::delete('/loads/{id}', [LoadController::class, 'destroy'])->name('loads.destroy');
Route::get('/loads/{id}', [LoadController::class, 'show'])->name('loads.show');
Route::get('/loads/{id}/edit', [LoadController::class, 'edit'])->name('loads.edit');
Route::post('/loads', [LoadController::class, 'store'])->name('loads.store');
Route::get('/loads', [LoadController::class, 'index'])->name('loads.index');
Route::patch('/loads/{load}', [LoadController::class, 'update'])->name('loads.update');
Route::patch('/loads/{load}/update_status', [LoadController::class, 'updateStatus'])->name('load.update_status');
Route::patch('/loads/{id}/update_status',  [LoadController::class, 'updateStatus'])->name('load.update_status');



// Rutas para ventas y detalles de ventas
Route::put('/sales/{sale}/toggle', [SaleController::class, 'toggle'])->name('sales.toggle');
Route::resource('sale', SaleController::class);
Route::resource('details_sale', DetailsSaleController::class);
Route::resource('sales', SaleController::class);




Auth::routes();

// Rutas para las compras 
Route::resource('purchase',App\Http\Controllers\PurchaseController::class);
Route::resource('details_purchase', App\Http\Controllers\DetailsPurchaseController::class);
Route::patch('purchase/{id}/update_status', [PurchaseController::class, 'updateStatus'])->name('purchase.update_status');
Route::post('/details-purchase', [DetailsPurchaseController::class, 'store'])->name('details-purchase.store');
Route::post('/purchases', [PurchaseController::class, 'store'])->name('purchases.store');
Route::get('/purchases', [PurchaseController::class, 'index'])->name('purchases.index');
Route::patch('/purchase/{purchase}/annul', [PurchaseController::class, 'annul'])->name('purchase.annul');
Route::post('/toggle-purchase-status/{id}', 'PurchaseController@toggleStatus')->name('toggle.purchase.status');
Route::post('/toggle-purchase-status/{id}', [PurchaseController::class, 'toggleStatus'])->name('purchase.toggleStatus');
Route::post('/toggle-purchase-status/{id}', [PurchaseController::class, 'toggleStatus']);

Route::post('/purchase/store', [PurchaseController::class, 'store'])->name('purchase.store');




// ruta para la barra de busqueda
Route::get('/purchase/search', [PurchaseController::class, 'search'])->name('purchase.search');

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

//Rutas de clientes
Route::resource('customer', App\Http\Controllers\CustomerController::class);
Route::patch('/customer/{id}/update_status', [App\Http\Controllers\CustomerController::class, 'updateStatus'])->name('customer.update_status');
Route::resource('user', App\Http\Controllers\UserController::class);