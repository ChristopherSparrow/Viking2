@extends('layouts.app')

@section('content')

<p><a href="{{ route('home') }}">Home</a> / <a href="{{ route('seasons.index') }}">All Seasons</a> / {{ $seasonId->season_name }}</p>

<h1>{{ $seasonId->season_name }}</h1>

<p>{{ \Carbon\Carbon::parse($seasonId->season_start_date)->format('F j, Y') }} - {{ \Carbon\Carbon::parse($seasonId->season_end_date)->format('F j, Y') }}</p>

<p><a href="{{ route('competitions.create', ['seasonId' => $seasonId->id]) }}">Add Competitions</a></p>
@if($seasonId->competitions->count() > 0)
<div class="row">
    @foreach ($seasonId->competitions as $competition)
    <div class="col-lg-4 mb-4">
        <div class="card">
            <div class="card-header">{{ $competition->competitions_name }}</div>
            <div class="card-body">
                <p></p>
                <p>Winner - {{ $competition->comp_winner }}<br>Runner Up - {{ $competition->comp_second }}<br><br>
                    @if (in_array($competition->comp_type, [1, 2]))
                    <a href="{{ route('teams.index',['seasonId' => $seasonId->id])}}">Teams</a><br>Fixtures / Results<br>Table<br>
                    @endif
                    @if (in_array($competition->comp_type, [3,4,5]))
                    <a href="{{ route('teams.index',['seasonId' => $seasonId->id])}}">Fixtures / Results</a><br>Players<br>
                    @endif
                season type - {{ $competition->comp_type}}
                </p>
            </div>
            <div class="card-footer"><a href="{{ route('competitions.edit', ['seasonId' => $seasonId->id, 'competitionId' => $competition->id]) }}">Edit/Delete</a></div>
            </div>

    </div>
    @endforeach
    @else
    <p>No competitions for this season yet.</p>
    @endif
</div>    
    
@endsection
