@extends('layouts.app')

@section('content')

<p><a href="{{ route('home') }}">Home</a> / <a href="{{ route('seasons.index') }}">All Seasons</a> / <a href="/seasons/{{ $season->id }}">{{ $season->season_name }}</a> / Edit Player</p>

<h1>Edit {{ $player->player_name }}</h1>
<div class="row">

    <form method="POST" action="{{ route('players.destroy', ['seasonId' => $season->id, 'playerId' => $player->id]) }}" style="display:inline;">
        @csrf
        @method('DELETE')

        <p><button type="submit" onclick="return confirm('Are you sure you want to delete this player?')">Delete {{ $player->player_name }}</button></p>
    </form>
    <hr>


    <div class="col-lg-4">
        <form method="post" action="{{ route('players.update', ['seasonId' => $season->id, 'playerId' => $player->id]) }}">
            @csrf
            @method('PUT')

            <div class="form-group">
                <label for="player_name">Name:</label>
                <input type="text" name="player_name" class="form-control" value="{{ $player->player_name }}" required>
            </div>

            <select name="team_id" class="form-control">
                @foreach($teams as $key => $value)
                    <option value="{{ $key }}" @if($key == $player->team_id) selected @endif>
                        {{ $value }}
                    </option>
                @endforeach
            </select>
        
            <button type="submit" class="btn btn-primary">Update Player</button>
        </form>
    </div>
</div>

        
@endsection
