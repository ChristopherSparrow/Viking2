@extends('layouts.app')

@section('content')

<p><a href="{{ url('/') }}">Home</a> / <a href="{{ route('seasons.index') }}">All Seasons</a> / <a href="/seasons/{{ $season->id }}">{{ $season->season_name }}</a> / <a href="{{ route('teams.index', ['seasonId' => $season->id]) }}">Teams</a> / Add</p>
<h1>Teams for {{ $season->season_name }}</h1>

<div class="row">
    <div class="col-lg-4">
        <form method="post" action="{{ route('teams.store', ['seasonId' => $season->id]) }}">
            @csrf

            <input type="hidden" name="season_id" value="{{ $season->id }}">

            <div class="form-group">
                <label for="team_name">Team Name:</label>
                <input type="text" name="team_name" class="form-control" required>
            </div>

            <div class="form-group">
                <label for="team_captain">Captain:</label>
                <input type="text" name="team_captain" class="form-control" required>
            </div>


            <div class="form-group">
                <label for="team_captain_no">Captain Phone:</label>
                <input type="text" name="team_captain_no" class="form-control" required>
            </div>


            <div class="form-group">
                <label for="team_vice_captain">Vice Captain:</label>
                <input type="text" name="team_vice_captain" class="form-control">
            </div>


            <div class="form-group">
                <label for="team_vice_captain_no">Vice Captain Phone:</label>
                <input type="text" name="team_vice_captain_no" class="form-control">
            </div>

            <button type="submit" class="btn btn-primary">Add Team</button>
        </form>

        <p><a href="{{ route('teams.index', ['seasonId' => $season->id]) }}">Back to Teams List</a></p>
</div>
</div>
@endsection
