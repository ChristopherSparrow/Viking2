<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\SeasonController;

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
Route::get('/seasons', [SeasonController::class, 'index'])->name('seasons');
Route::get('/seasons/{season}', [SeasonController::class, 'show'])->name('seasons.show');
Route::get('/seasons/create', [SeasonController::class, 'create'])->name('seasons.create');
Route::post('/seasons', [SeasonController::class, 'store'])->name('seasons.store');

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
