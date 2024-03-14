@extends('layouts.app')

@section('content')


<p><a href="{{ url('/') }}">Home</a> / <a href="{{ route('seasons.index') }}">All Seasons</a> / <a href="/seasons/{{ $season->id }}">{{ $season->season_name}}</a> / <a href="{{ route('fixtures.index', ['seasonId' => $season->id, 'competitionId' => $competitionId]) }}">{{ $competition->competitions_name }}</a></p>

<h1>Create Fixture</h1>
<h2>{{ $season->season_name}}</a> / {{ $competition->competitions_name }}</h2>
<form method="POST" action="{{ route('fixtures.store', ['seasonId' => $season->id, 'competitionId' => $competitionId]) }}">

    @csrf

    <!-- Add your form fields here -->

    <p><label for="date">Start Date:</label>

        <input type="date" name="date" id="date" required></p>

    <div class="form-group">
        <label for="home_team">Home Team</label>
        <select class="form-control" id="home_team" name="home_team">
            <option value="">Home</option>
            @foreach($teams as $teamId => $teamName)
                <option value="{{ $teamId }}">{{ $teamName }}</option>
            @endforeach
        </select>
    </div>

    <div class="form-group">
        <label for="away_team">Away Team</label>
        <select class="form-control" id="away_team" name="away_team">
            <option value="">Away</option>
            @foreach($teams as $teamId => $teamName)
                <option value="{{ $teamId }}">{{ $teamName }}</option>
            @endforeach
        </select>
    </div>
    <div class="form-group">
        <label for="location">Location</label>
    <input class="form-control" type="text" name="location" id="location" placeholder="Optional"></p>
    </div>
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
    <!-- Add other fields as needed -->

    <p><button type="submit" class="btn btn-primary">Create Fixture</button></p>
</form>

@endsection
