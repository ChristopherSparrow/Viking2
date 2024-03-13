<?php

use App\Http\Controllers\NewsController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\SeasonController;
use App\Http\Controllers\CompetitionController;
use App\Http\Controllers\TeamController;
use App\Http\Controllers\PlayerController;
use App\Http\Controllers\FixtureController;
use App\Http\Controllers\CupController;
use App\Http\Controllers\VikingHomeController;

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

//Route::get('/', function () { return view('vikinghome');});
    Route::get('/', [VikingHomeController::class, 'index']);
  
//SEASONS
    Route::get('/seasons', [SeasonController::class, 'index'])->name('seasons.index');
    Route::get('/seasons/{seasonId}', [SeasonController::class, 'show'])->name('seasons.show');


//COMPS
    Route::get('/seasons/{seasonId}/competitions', [CompetitionController::class, 'index'])->name('competitions.index');
    Route::get('/seasons/{seasonId}/competitions/{competitionId}', [CompetitionController::class, 'show'])->name('competitions.show');

//LEAGUE & TKO
    Route::get('/fixtures/{seasonId}/{competitionId}/', [FixtureController::class, 'index'])->name('fixtures.index');
    Route::get('/fixtures/table/{seasonId}/{competitionId}/', [FixtureController::class, 'table'])->name('fixtures.table');

//CUPS
    Route::get('/cups/{seasonId}/{competitionId}/', [CupController::class, 'index'])->name('cups.index');
    
//CUPS
    Route::get('/news', [NewsController::class, 'index'])->name('news.index');



Auth::routes();
    Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
    
    Route::group(['middleware' => ['role:Global-Admin']], function() {

        //Permissiuns
        Route::resource('permissions', App\Http\Controllers\PermissionController::class);
        Route::get('permissions/{permissionId}/delete', [App\Http\Controllers\PermissionController::class, 'destroy']);

        //Roles
        Route::resource('roles', App\Http\Controllers\RoleController::class);
        Route::get('roles/{roleId}/delete', [App\Http\Controllers\RoleController::class, 'destroy']);
        Route::get('roles/{roleId}/give-permissions', [App\Http\Controllers\RoleController::class, 'addPermissionToRole']);
        Route::put('roles/{roleId}/give-permissions', [App\Http\Controllers\RoleController::class, 'givePermissionToRole']);

        //Users
        Route::resource('users', App\Http\Controllers\UserController::class);
        Route::get('users/{userId}/delete', [App\Http\Controllers\UserController::class, 'destroy']);

        //SEASONS
        Route::get('/season/create', [App\Http\Controllers\SeasonController::class, 'create'])->name('seasons.create');
        Route::post('/seasons/store', [SeasonController::class, 'store'])->name('seasons.store');
        Route::get('/seasons/{seasonId}/edit', [SeasonController::class, 'edit'])->name('seasons.edit');
        Route::patch('/seasons/{seasonId}', [SeasonController::class, 'update'])->name('seasons.update');
        Route::delete('/seasons/{seasonId}', [SeasonController::class, 'destroy'])->name('seasons.destroy');

   
        //COMPS
        Route::get('/competitions/{seasonId}/create', [CompetitionController::class, 'create'])->name('competitions.create');
        Route::post('/competitions/{seasonId}/store', [CompetitionController::class, 'store'])->name('competitions.store');
        Route::get('/competitions/{seasonId}/{competitionId}/edit', [CompetitionController::class, 'edit'])->name('competitions.edit');
        Route::put('/competitions/{seasonId}/{competitionId}/update', [CompetitionController::class, 'update'])->name('competitions.update');
        Route::delete('/competitions/{seasonId}/{competitionId}/destroy', [CompetitionController::class, 'destroy'])->name('competitions.destroy');

        //PLAYERS
        Route::get('/players/{seasonId}', [PlayerController::class, 'index'])->name('players.index');
        Route::get('/players/{seasonId}/{playerId}', [PlayerController::class, 'show'])->name('players.show');
        Route::get('/players/{seasonId}/create', [PlayerController::class, 'create'])->name('players.create');
        Route::post('/players/{seasonId}/store', [PlayerController::class, 'store'])->name('players.store');
        Route::get('/players/{seasonId}/{playerId}/edit', [PlayerController::class, 'edit'])->name('players.edit');
        Route::put('/players/{seasonId}/{playerId}/update', [PlayerController::class, 'update'])->name('players.update');
        Route::delete('/players/{seasonId}/{playerId}/destroy', [PlayerController::class, 'destroy'])->name('players.destroy');

        //TEAMS
        Route::resource('teams', App\Http\Controllers\TeamController::class);
        Route::get('/seasons/{seasonId}/teams', [TeamController::class, 'index'])->name('teams.index');
        Route::get('/seasons/{seasonId}/teams/create', [TeamController::class, 'create'])->name('teams.create');
        Route::post('/seasons/{seasonId}/teams/store', [TeamController::class, 'store'])->name('teams.store');
        Route::get('/seasons/{seasonId}/teams/{teamId}', [TeamController::class, 'show'])->name('teams.show');
        Route::get('/seasons/{seasonId}/teams/{teamId}/edit', [TeamController::class, 'edit'])->name('teams.edit');
        Route::put('/seasons/{seasonId}/teams/{teamId}/update', [TeamController::class, 'update'])->name('teams.update');
        Route::delete('/seasons/{seasonId}/teams/{teamId}/destroy', [TeamController::class, 'destroy'])->name('teams.destroy');

        //CUPS
        Route::get('/cups/{seasonId}/{competitionId}/{date}/edit', [CupController::class, 'edit'])->name('cups.edit');
        Route::put('/cups/{seasonId}/{competitionId}/{date}', [CupController::class, 'update'])->name('cups.update');
        Route::delete('/cups/{seasonId}/{competitionId}/{date}', [CupController::class, 'destroy'])->name('cups.destroy');
        Route::get('/cups/create/{seasonId}/{competitionId}', [CupController::class, 'create'])->name('cups.create');
        Route::post('/cups/store/{seasonId}/{competitionId}', [CupController::class, 'store'])->name('cups.store');

        //FIXTURES
        Route::get('/fixtures/{seasonId}/{competitionId}/{date}/edit', [FixtureController::class, 'edit'])->name('fixtures.edit');
        Route::put('/fixtures/{seasonId}/{competitionId}/{date}', [FixtureController::class, 'update'])->name('fixtures.update');
        Route::delete('/fixtures/{seasonId}/{competitionId}/{date}', [FixtureController::class, 'destroy'])->name('fixtures.destroy');
        Route::get('/fixtures/create/{seasonId}/{competitionId}', [FixtureController::class, 'create'])->name('fixtures.create');
        Route::post('/fixtures/store/{seasonId}/{competitionId}', [FixtureController::class, 'store'])->name('fixtures.store');

        //NEWS
        Route::get('/news/{newsId}/edit', [NewsController::class, 'edit'])->name('news.edit');
        Route::put('/news/{newsId}/update', [NewsController::class, 'update'])->name('news.update');
        Route::delete('/news/{newsId}/destroy', [NewsController::class, 'destroy'])->name('news.destroy');
        Route::get('/news/create', [NewsController::class, 'create'])->name('news.create');
        Route::post('/news/store', [NewsController::class, 'store'])->name('news.store');

});


