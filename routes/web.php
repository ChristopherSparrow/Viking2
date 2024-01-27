<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\SeasonController;
use App\Http\Controllers\CompetitionController;

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


Route::get('/seasons', [SeasonController::class, 'index'])->name('seasons.index');
Route::get('/seasons/create', [SeasonController::class, 'create'])->name('seasons.create');
Route::post('/seasons', [SeasonController::class, 'store'])->name('seasons.store');
Route::get('/seasons/{season}', [SeasonController::class, 'show'])->name('seasons.show');
Route::get('/seasons/{season}/edit', [SeasonController::class, 'edit'])->name('seasons.edit');
Route::patch('/seasons/{season}', [SeasonController::class, 'update'])->name('seasons.update');
Route::delete('/seasons/{season}', [SeasonController::class, 'destroy'])->name('seasons.destroy');

Route::get('/competitions', [CompetitionController::class, 'index'])->name('competitions.index');
Route::get('/competitions/create/', [CompetitionController::class, 'create'])->name('competitions.create');
Route::post('/competitions', [CompetitionController::class, 'store'])->name('competitions.store');
Route::get('/competitions/{competition}', [CompetitionController::class, 'show'])->name('competitions.show');
Route::get('/seasons/{season}/competitions/{competition}/edit', [CompetitionController::class, 'edit'])->name('competitions.edit');

Route::delete('/seasons/{season}/competitions/{competition}', [CompetitionController::class,'destroy'])->name('competitions.destroy');
Route::put('/seasons/{season}/competitions/{competition}', [CompetitionController::class, 'update'])->name('competitions.update');

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
