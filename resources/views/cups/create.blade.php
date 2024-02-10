@extends('layouts.app')

@section('content')


<p><a href="{{ url('/') }}">Home</a> / <a href="{{ route('seasons.index') }}">All Seasons</a> / <a href="/seasons/{{ $season->id }}">{{ $season->season_name}}</a> / <a href="{{ route('fixtures.index', ['seasonId' => $season->id, 'competitionId' => $competitionId]) }}">{{ $competition->competitions_name }}</a></p>

<h1>Create Fixture</h1>
<h2>{{ $season->season_name}}</a> / {{ $competition->competitions_name }}</h2>
<form method="POST" action="{{ route('cups.store', ['seasonId' => $season->id, 'competitionId' => $competitionId]) }}">

    @csrf

    <!-- Add your form fields here -->

    <p><label for="date">Start Date:</label>

        <input type="date" name="date" id="date" required></p>

    <div class="form-group">
        <label for="home_player_1">Home</label>
        <select class="form-control" id="home_player_1" name="home_player_1">
            <option value="">Home</option>
            @foreach($players as $playerId => $playerName)
                <option value="{{ $playerId }}">{{ $playerName }}</option>
            @endforeach
        </select>
    </div>

    <div class="form-group">
        <label for="away_player_1">Away Team</label>
        <select class="form-control" id="away_player_1" name="away_player_1">
            <option value="">Away</option>
            @foreach($players as $playerId => $playerName)
                <option value="{{ $playerId }}">{{ $playerName }}</option>
            @endforeach
        </select>
    </div>
    <div class="form-group">
        <label for="location">Location</label>
    <input class="form-control" type="text" name="location" id="location" placeholder="Optional"></p>
    </div>

    <!-- Add other fields as needed -->

    <p><button type="submit" class="btn btn-primary">Create Fixture</button></p>
</form>

@endsection
