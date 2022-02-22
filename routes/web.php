<?php

use App\Http\Controllers\productsController;
use App\Http\Controllers\shoppingCartController;
use App\Http\Controllers\usersController;
use Illuminate\Support\Facades\Route;

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


Route::get('/', [usersController::class, 'index'])->name('index');
Route::post('/inicioSesion', [usersController::class, 'login'])->name('login');
Route::get('/vistaRegistro', [usersController::class, 'viewRegister'])->name('viewRegister');
Route::post('/registro', [usersController::class, 'register'])->name('register');

Route::get('productos', [productsController::class, 'listProducts'])->name('products');
Route::post('añadirProducto', [productsController::class, 'addProduct'])->name('addProduct');
Route::post('mostrarProcucto', [productsController::class, 'showProduct'])->name('showProduct');
Route::post('aditarProducto', [productsController::class, 'editProduct'])->name('editProduct');
Route::post('eliminarProducto', [productsController::class, 'deleteProduct'])->name('deleteProduct');

Route::post('mostrarCarrito', [shoppingCartController::class, 'showShopping'])->name('showShopping');
Route::post('añadirCarrito', [shoppingCartController::class, 'addShopping'])->name('addShopping');
Route::post('eliminarCompras', [shoppingCartController::class, 'deleteShopping'])->name('deleteShopping');

Route::post('importarProductos', [productsController::class, 'importProducts'])->name('importProducts');