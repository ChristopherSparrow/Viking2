@extends('layouts.app')

@section('content')

<p><a href="{{ url('/') }}">Home</a> / <a href="{{ route('seasons.index') }}">All Seasons</a> / <a href="/seasons/{{ $season->id }}">{{ $season->season_name }}</a> / All Players</p>
<h1>Players for {{ $season->season_name }}</h1>
<p><a href="{{ route('players.create', ['seasonId' => $season->id]) }}">Add New Player</a></p>

<div class="row">
    @foreach($teams as $team)
        <div class="col-lg-4 mb-4">
            <div class="card">
                <div class="card-header">
                    {{ $team->team_name }}
                </div>
                <div class="card-body">
                    <p>
                        @foreach($players->where('team_id', $team->id)->sortby('player_name') as $player)
                        <a href="{{ route('players.edit', ['seasonId' => $season->id, 'playerId' => $player->id]) }}">{{ $player->player_name }}</a><br>
                        @endforeach
                    </p>
                </div>
                


                
            </div>
        </div>
    @endforeach
</div>    
      
@endsection
