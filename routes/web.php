<?php

use App\Http\Controllers\PlayerController;
use Illuminate\Support\Facades\Auth;
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

Auth::routes(['verify' => true]);

Route::get('/', function () {
    return view('welcome');
})->name('welcome');


Route::get('/check',[PlayerController::class, 'check'])->middleware(['auth','verified'])->name('check');

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->middleware(['auth','verified'])->name('home');

/*Panel Entrenador*/
Route::get('/createPlayerPanel' , [App\Http\Controllers\PlayerController::class, 'index'])->middleware(['auth','verified'])->name('panel.create.player');
Route::post('/createPlayerPanel/create' , [App\Http\Controllers\PlayerController::class, 'create'])->middleware(['auth','verified'])->name('panel.create.player.create');

