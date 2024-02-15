<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\SeasonController;
use App\Http\Controllers\CompetitionController;
use App\Http\Controllers\TeamController;
use App\Http\Controllers\PlayerController;
use App\Http\Controllers\FixtureController;
use App\Http\Controllers\CupController;

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

Route::get('/seasons/{seasonId}/players', [PlayerController::class, 'index'])->name('players.index');
Route::get('/seasons/{seasonId}/players/create', [PlayerController::class, 'create'])->name('players.create');
Route::post('/seasons/{seasonId}/players/store', [PlayerController::class, 'store'])->name('players.store');
Route::get('/seasons/{seasonId}/players/{playerId}', [PlayerController::class, 'show'])->name('players.show');
Route::get('/seasons/{seasonId}/players/{playerId}/edit', [PlayerController::class, 'edit'])->name('players.edit');
Route::put('/seasons/{seasonId}/players/{playerId}/update', [PlayerController::class, 'update'])->name('players.update');
Route::delete('/seasons/{seasonId}/players/{playerId}/destroy', [PlayerController::class, 'destroy'])->name('players.destroy');

Route::get('/fixtures/{seasonId}/{competitionId}/', [FixtureController::class, 'index'])->name('fixtures.index');
Route::get('/fixtures/table/{seasonId}/{competitionId}/', [FixtureController::class, 'table'])->name('fixtures.table');
Route::get('/fixtures/{seasonId}/{competitionId}/{date}/edit', [FixtureController::class, 'edit'])->name('fixtures.edit');
Route::put('/fixtures/{seasonId}/{competitionId}/{date}', [FixtureController::class, 'update'])->name('fixtures.update');
Route::delete('/fixtures/{seasonId}/{competitionId}/{date}', [FixtureController::class, 'destroy'])->name('fixtures.destroy');
Route::get('/fixtures/create/{seasonId}/{competitionId}', [FixtureController::class, 'create'])->name('fixtures.create');
Route::post('/fixtures/store/{seasonId}/{competitionId}', [FixtureController::class, 'store'])->name('fixtures.store');

Route::get('/cups/{seasonId}/{competitionId}/', [CupController::class, 'index'])->name('cups.index');
Route::get('/cups/{seasonId}/{competitionId}/{date}/edit', [CupController::class, 'edit'])->name('cups.edit');
Route::put('/cups/{seasonId}/{competitionId}/{date}', [CupController::class, 'update'])->name('cups.update');
Route::delete('/cups/{seasonId}/{competitionId}/{date}', [CupController::class, 'destroy'])->name('cups.destroy');
Route::get('/cups/create/{seasonId}/{competitionId}', [CupController::class, 'create'])->name('cups.create');
Route::post('/cups/store/{seasonId}/{competitionId}', [CupController::class, 'store'])->name('cups.store');
Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::group(['middleware' => ['role:super-admin|admin']], function() {

    Route::resource('permissions', App\Http\Controllers\PermissionController::class);
    Route::get('permissions/{permissionId}/delete', [App\Http\Controllers\PermissionController::class, 'destroy']);

    Route::resource('roles', App\Http\Controllers\RoleController::class);
    Route::get('roles/{roleId}/delete', [App\Http\Controllers\RoleController::class, 'destroy']);
    Route::get('roles/{roleId}/give-permissions', [App\Http\Controllers\RoleController::class, 'addPermissionToRole']);
    Route::put('roles/{roleId}/give-permissions', [App\Http\Controllers\RoleController::class, 'givePermissionToRole']);

    Route::resource('users', App\Http\Controllers\UserController::class);
    Route::get('users/{userId}/delete', [App\Http\Controllers\UserController::class, 'destroy']);

});
