@extends('layouts.app')
@section('title', $seasonId->season_name)

@section('content')
<div class="breadcrumb"><p><a href="{{ url('/') }}">Home</a> / <a href="{{ route('seasons.index') }}">All Seasons</a> / {{ $seasonId->season_name }}</p>
</div>
<h1>{{ $seasonId->season_name }}</h1>

<p>{{ \Carbon\Carbon::parse($seasonId->season_start_date)->format('F j, Y') }} - {{ \Carbon\Carbon::parse($seasonId->season_end_date)->format('F j, Y') }}</p>

<div class="row" data-masonry='{"percentPosition": true }'>

    @can('view player')
    <div class="col-xl-3 col-lg-4 col-md-6 mb-2">
        <div class="card shadow p-30 mb-4 bg-white rounded">
            <div class="card-header card-header-admin">Admin Controls</div>
            <div class="card-body card-body-admin">
                <p><a href="{{ route('competitions.create', ['seasonId' => $seasonId->id]) }}">Add Competitions</a></p>
                <p><a href="{{ route('teams.index',['seasonId' => $seasonId->id])}}">Edit Teams</a></p>
                <p><a href="{{ route('players.index',['seasonId' => $seasonId->id])}}">Edit Players</a></p>
            </div>
        </div>
    </div>
    @endcan

    @can('view team')
    <div class="col-xl-3 col-lg-4 col-md-6 mb-2">
        <div class="card shadow p-30 mb-4 bg-white rounded">
            <div class="card-header card-header-admin">Captains Information</div>
            <div class="card-body card-body-admin">
                <p><a href="{{ route('players.index',['seasonId' => $seasonId->id])}}">View Players</a></p>
                <p><a href="{{ route('teams.index',['seasonId' => $seasonId->id])}}">View Teams</a><br></p>
             </div>
        </div>
    </div>
    @endcan

    @if($seasonId->competitions->count() > 0)
    @foreach ($seasonId->competitions->sortBy('comp_type') as $competition)
    <div class="col-xl-3 col-lg-4 col-md-6 mb-2">
        <div class="card shadow p-30 mb-4 bg-white rounded">
            <div class="card-header d-flex justify-content-between align-items-center">{{ $competition->competitions_name }}
                @can('update competition')
                <a href="{{ route('competitions.edit', ['seasonId' => $seasonId->id, 'competitionId' => $competition->id]) }}"><i class="bi bi-pencil-square"></i> Edit / Delete</a>
                @endcan
            </div>
            <div class="card-body">

                <p>Winner - {{ $competition->comp_winner }}<br>Runner Up - {{ $competition->comp_second }}<br><br>
                    @if (in_array($competition->comp_type, [1]))
                    <a href="{{ route('fixtures.index', ['competitionId' => $competition->id, 'seasonId' => $seasonId->id]) }}"><i class="bi bi-list"></i> Fixtures / Results</a></p>
                    <p><a href="{{ route('fixtures.table', ['competitionId' => $competition->id, 'seasonId' => $seasonId->id]) }}"><i class="bi bi-table"></i> Table</a><br>
                    <p><a href="#"><i class="bi bi-trophy-fill"></i></i> Most Wins</a><br>
                    <p><a href="#"><i class="bi bi-8-circle-fill"></i> 8 Ball Clearances</a><br>

                    @endif
                    @if (in_array($competition->comp_type, [2]))
                    <a href="{{ route('fixtures.index', ['competitionId' => $competition->id, 'seasonId' => $seasonId->id]) }}"><i class="bi bi-list"></i> Fixtures / Results</a><br>

                    @endif
                    @if (in_array($competition->comp_type, [3,4,5]))
                    <a href="{{ route('cups.index', ['competitionId' => $competition->id, 'seasonId' => $seasonId->id]) }}"><i class="bi bi-list"></i> Fixtures / Results</a><br>

                    @endif

                </p>
            </div>
        </div>

    </div>
    @endforeach
    @else
    <p>No competitions for this season yet.</p>
    @endif
</div>    
    
@endsection
