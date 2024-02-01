<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\SeasonController;
use App\Http\Controllers\CompetitionController;
use App\Http\Controllers\TeamController;

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
Route::get('/seasons/{seasonId}', [SeasonController::class, 'show'])->name('seasons.show');
Route::get('/seasons/{seasonId}/edit', [SeasonController::class, 'edit'])->name('seasons.edit');
Route::patch('/seasons/{seasonId}', [SeasonController::class, 'update'])->name('seasons.update');
Route::delete('/seasons/{seasonId}', [SeasonController::class, 'destroy'])->name('seasons.destroy');




Route::get('/seasons/{seasonId}/competitions', [CompetitionController::class, 'index'])->name('competitions.index');
Route::get('/seasons/{seasonId}/competitions/create', [CompetitionController::class, 'create'])->name('competitions.create');
Route::post('/seasons/{seasonId}/competitions/store', [CompetitionController::class, 'store'])->name('competitions.store');
Route::get('/seasons/{seasonId}/competitions/{competitionId}', [CompetitionController::class, 'show'])->name('competitions.show');
Route::get('/seasons/{seasonId}/competitions/{competitionId}/edit', [CompetitionController::class, 'edit'])->name('competitions.edit');
Route::put('/seasons/{seasonId}/competitions/{competitionId}/update', [CompetitionController::class, 'update'])->name('competitions.update');
Route::delete('/seasons/{seasonId}/competitions/{competitionId}/destroy', [CompetitionController::class, 'destroy'])->name('competitions.destroy');
// ...

Route::get('/seasons/{seasonId}/teams', [TeamController::class, 'index'])->name('teams.index');
Route::get('/seasons/{seasonId}/teams/create', [TeamController::class, 'create'])->name('teams.create');
Route::post('/seasons/{seasonId}/teams/store', [TeamController::class, 'store'])->name('teams.store');
Route::get('/seasons/{seasonId}/teams/{teamId}', [TeamController::class, 'show'])->name('teams.show');
Route::get('/seasons/{seasonId}/teams/{teamId}/edit', [TeamController::class, 'edit'])->name('teams.edit');
Route::put('/seasons/{seasonId}/teams/{teamId}/update', [TeamController::class, 'update'])->name('teams.update');
Route::delete('/seasons/{seasonId}/teams/{teamId}/destroy', [TeamController::class, 'destroy'])->name('teams.destroy');

// ...




Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
