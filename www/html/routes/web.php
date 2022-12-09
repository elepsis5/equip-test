<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\IndexController;
use App\Http\Controllers\GroupController;
use App\Http\Controllers\ProductController;


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

Route::get('/',[IndexController::class, 'index'])->name('index');;
Route::get('/group/{id}',[GroupController::class, 'toGroup'])->name('toGroup');
Route::get('/group/{id}/{sort}/{q?}',[GroupController::class, 'toGroup'])->name('toSort');
Route::get('/product/{groupId}/{id}',[ProductController::class, 'show'])->name('product');
