@extends('layouts.app')

@section('content')


<p><a href="{{ url('/') }}">Home</a> / <a href="{{ route('seasons.index') }}">All Seasons</a> / <a href="/seasons/{{ $season->id }}">{{ $season->season_name}}</a> / <a href="{{ route('fixtures.index', ['seasonId' => $season->id, 'competitionId' => $competitionId]) }}">{{ $competition->competitions_name }}</a></p>

<h1>Create Fixture</h1>
<h2>{{ $season->season_name}}</a> / {{ $competition->competitions_name }}</h2>
<form method="POST" action="{{ route('cups.store', ['seasonId' => $season->id, 'competitionId' => $competitionId]) }}">

    @csrf

    <p>
        <label for="date">Start Date:</label>
        <input class="form-control" type="date" name="date" id="date" required>
    </p>
    <p>
        <div class="form-group">
            <label for="comp_round">Competition Round</label>
            <select class="form-control" id="comp_round" name="comp_round">
                <option value="">Choose</option>
                @foreach($rounds as $roundiD => $round_name)
                    <option value="{{ $roundiD }}">{{ $round_name }}</option>
                @endforeach
            </select>
        </div>
    </p>
    
    <div class="form-group">
        <select class="form-control" id="home_player_1" name="home_player_1">
            <option value="">Home</option>
            @foreach($players as $playerId => $playerName)
                <option value="{{ $playerId }}">{{ $playerName }}</option>
            @endforeach
        </select>
    </div>

    <div class="form-group">
        <select class="form-control" id="away_player_1" name="away_player_1">
            <option value="">Away</option>
            @foreach($players as $playerId => $playerName)
                <option value="{{ $playerId }}">{{ $playerName }}</option>
            @endforeach
        </select>
    </div>
    <p><div class="form-group">
        <label for="location">Location</label>

    <select class="form-control" name="location" id="location" placeholder="Optional">
    <option value="">Optional</option>
    <option value="Black Swan (Fog)">Black Swan (Fog)</option>
    <option value="Black Swan (Pock)">Black Swan (Pock)</option>
    <option value="Blacksmith Arms">Blacksmith Arms</option>
    <option value="Cross Keys">Cross Keys</option>
    <option value="Griffin">Griffin</option>
    <option value="HOSM Club">HOSM Club</option>
    <option value="Londesborough Arms">Londesborough Arms</option>
    <option value="North Cave">North Cave</option>
    <option value="Stumble inn">Stumble Inn</option>
    <option value="United Services Club">United Services Club</option>
    </select>
    </p>
    </div>

    <!-- Add other fields as needed -->

    <p><button type="submit" class="btn btn-primary">Create Fixture</button></p>
</form>

@endsection
