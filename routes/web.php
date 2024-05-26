<?php

use App\Http\Controllers\ProductController;
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

Route::get('/', function () {
    return view('welcome');
});
Route::get('/',[ProductController::class,'index'])->name('products.index');
Route::get('/products/create',[ProductController::class,'create'])->name('products.create');
Route::post('/products',[ProductController::class,'store'])->name('products.store');
Route::get('/products/edit{id}',[ProductController::class,'edit'])->name('products.edit');
Route::post('/products/update', [ProductController::class, 'update'])->name('products.update');

Route::post('/products/view',[ProductController::class,'edit'])->name('products.view');
Route::post('/products/delete',[ProductController::class,'delet'])->name('products.delete');