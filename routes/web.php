<?php

use App\Http\Controllers\CheckController;
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

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->middleware(['auth','verified'])->name('home');

/*Panel Entrenador Crear Jugador*/
Route::get('/createPlayerPanel' , [App\Http\Controllers\PlayerController::class, 'index'])->middleware(['auth','verified'])->name('panel.create.player');
Route::post('/createPlayerPanel/create' , [App\Http\Controllers\PlayerController::class, 'create'])->middleware(['auth','verified'])->name('panel.create.player.create');
Route::post('/createPlayerPanel/delete' , [App\Http\Controllers\PlayerController::class, 'delete'])->middleware(['auth','verified'])->name('panel.create.player.delete');

/*Panel Entrenador Crear Team*/
Route::get('/createTeamPanel' , [App\Http\Controllers\TeamController::class, 'index'])->middleware(['auth','verified'])->name('panel.create.team');
Route::post('/createTeamPanel/create' , [App\Http\Controllers\TeamController::class, 'create'])->middleware(['auth','verified'])->name('panel.create.team.create');

/*Panel Entrenador Crear Quinteto*/
Route::get('/createQuintetPanel' , [App\Http\Controllers\QuintetController::class, 'index'])->middleware(['auth','verified'])->name('panel.create.quintet');
Route::post('/createQuintetPanel/create' , [App\Http\Controllers\QuintetController::class, 'create'])->middleware(['auth','verified'])->name('panel.create.quintet.create');

/*Panel Entrenador Crear Games*/
Route::get('/createGamePanel' , [App\Http\Controllers\GameController::class, 'index'])->middleware(['auth','verified'])->name('panel.create.game');
Route::post('/createGamePanel/create' , [App\Http\Controllers\GameController::class, 'create'])->middleware(['auth','verified'])->name('panel.create.game.create');

/*Panel Entrenador Ver Jugador*/
Route::get('/watchPlayer/{id_player}' , [App\Http\Controllers\PlayerController::class, 'watchPlayer'])->middleware(['auth','verified'])->name('panel.whatch.player');

/*Panel Entrenador Ver Equipo*/
Route::get('/watchTeam' , [App\Http\Controllers\PlayerController::class, 'watchTeam'])->middleware(['auth','verified'])->name('panel.whatch.team');

/*Panel Entrenador Ver Gugadores Sin Equipo*/
Route::get('/playerPool' , [App\Http\Controllers\PlayerController::class, 'watchPlayerNoTeam'])->middleware(['auth','verified'])->name('panel.player.pool');
Route::get('/playerPool/{id_player}' , [App\Http\Controllers\PlayerController::class, 'watchPlayerHire'])->middleware(['auth','verified'])->name('panel.hire.player');



/*Panel Entrenador*/
Route::get('/myData' , [App\Http\Controllers\PlayerController::class, 'myData'])->middleware(['auth','verified'])->name('panel.myData');
Route::post('/myData/modify' , [App\Http\Controllers\PlayerController::class, 'myDataModify'])->middleware(['auth','verified'])->name('panel.myData.modify');

/**
 * routes for users created by admins
 */
Route::get('/check',[CheckController::class, 'index'])->middleware(['auth','verified'])->name('check');
Route::post('/check/resetPassword',[CheckController::class, 'resetPassword'])->middleware(['auth','verified'])->name('check.resetPassword');
