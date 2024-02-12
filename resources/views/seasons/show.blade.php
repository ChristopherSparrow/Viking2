@extends('layouts.app')

@section('content')

<p><a href="{{ url('/') }}">Home</a> / <a href="{{ route('seasons.index') }}">All Seasons</a> / {{ $seasonId->season_name }}</p>

<h1>{{ $seasonId->season_name }}</h1>

<p>{{ \Carbon\Carbon::parse($seasonId->season_start_date)->format('F j, Y') }} - {{ \Carbon\Carbon::parse($seasonId->season_end_date)->format('F j, Y') }}</p>
<div class="row">
    <div class="col-lg-12 mb-4">
        <div class="card">
            <div class="card-header">ADMIN</div>
            <div class="card-body">
                <p><a href="{{ route('competitions.create', ['seasonId' => $seasonId->id]) }}">Add Competitions</a> | <a href="{{ route('teams.index',['seasonId' => $seasonId->id])}}">Edit Teams</a> | <a href="{{ route('players.index',['seasonId' => $seasonId->id])}}">Edit Players</a></p>
            </div>
        </div>
    </div>

</div>
@if($seasonId->competitions->count() > 0)
<div class="row">
    @foreach ($seasonId->competitions->sortBy('comp_type') as $competition)
    <div class="col-lg-4 mb-4">
        <div class="card">
            <div class="card-header">{{ $competition->competitions_name }} | <a href="{{ route('competitions.edit', ['seasonId' => $seasonId->id, 'competitionId' => $competition->id]) }}">Edit / Delete</a></div>
            <div class="card-body">
                <p></p>
                <p>Winner - {{ $competition->comp_winner }}<br>Runner Up - {{ $competition->comp_second }}<br><br>
                    @if (in_array($competition->comp_type, [1]))
                    <a href="{{ route('fixtures.index', ['competitionId' => $competition->id, 'seasonId' => $seasonId->id]) }}">Fixtures / Results</a><br>
                    <a href="{{ route('fixtures.table', ['competitionId' => $competition->id, 'seasonId' => $seasonId->id]) }}">Table</a><br>
                    <a href="{{ route('teams.index',['seasonId' => $seasonId->id])}}">View Teams</a><br>
                    @endif
                    @if (in_array($competition->comp_type, [2]))
                    <a href="{{ route('fixtures.index', ['competitionId' => $competition->id, 'seasonId' => $seasonId->id]) }}">Fixtures / Results</a><br>
                    <a href="{{ route('teams.index',['seasonId' => $seasonId->id])}}">View Teams</a><br>
                    @endif
                    @if (in_array($competition->comp_type, [3,4,5]))
                    <a href="{{ route('cups.index', ['competitionId' => $competition->id, 'seasonId' => $seasonId->id]) }}">Fixtures / Results</a><br>
                    <a href="{{ route('players.index',['seasonId' => $seasonId->id])}}">View Players</a><br>
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
