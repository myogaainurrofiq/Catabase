<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\StoreController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\LoginController;
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

Route::get('/kucing', [AdminController::class, 'index'])->name('toko.index');
Route::get('/toko', [StoreController::class, 'index'])->name('store.index');
Route::get('/', [LoginController::class, 'showLoginForm'])->name('login');

Route::prefix('toko')->group(function(){
    Route::get('add', [AdminController::class, 'create'])->name('toko.create');
    Route::post('store', [AdminController::class, 'store'])->name('toko.store');
    Route::get('edit/{id}', [AdminController::class, 'edit'])->name('toko.edit');
    Route::post('update/{id}', [AdminController::class, 'update'])->name('toko.update');
    Route::post('delete/{id}', [AdminController::class, 'delete'])->name('toko.delete');
    Route::post('softDelete/{id}', [AdminController::class, 'softDelete'])->name('toko.softDelete');
});

Route::prefix('store')->group(function(){
Route::get('add', [StoreController::class, 'create'])->name('store.create');
Route::post('store', [StoreController::class, 'store'])->name('store.store');
Route::get('edit/{id}', [StoreController::class, 'edit'])->name('store.edit');
Route::post('update/{id}', [StoreController::class, 'update'])->name('store.update');
Route::post('delete/{id}', [StoreController::class, 'delete'])->name('store.delete');
Route::post('softDelete/{id}', [StoreController::class, 'softDelete'])->name('store.softDelete');
});

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
