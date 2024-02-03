@extends('layouts.app')

@section('content')

<p><a href="{{ url('/') }}">Home</a> / <a href="{{ route('seasons.index') }}">All Seasons</a> / <a href="/seasons/{{ $season->id }}">{{ $season->season_name }}</a> / All Teams</p>
<h1>Teams for {{ $season->season_name }}</h1>
<p><a href="{{ route('teams.create', ['seasonId' => $season->id]) }}">Add New Team</a></p>
<div class="row">
    @foreach($teams as $team)
    <div class="col-lg-4 mb-4">
        <div class="card">
                <div class="card-header">{{ $team->team_name }}</div>
                <div class="card-body">
                    <p>Captain: {{ $team->team_captain }} - {{ $team->team_captain_no }}<br>
                    Vice Captain: {{ $team->team_vice_captain }} - {{ $team->team_vice_captain_no }}</p>
                </div>
            <div class="card-header"><a href="{{ route('teams.edit', ['seasonId' => $season->id, 'teamId' => $team->id]) }}">Edit / Delete</a></div>
        </div>
    </div>
    @endforeach
</div>

        
      
@endsection
