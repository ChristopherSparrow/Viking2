@extends('layouts.app')

@section('content')

<p><a href="{{ route('home') }}">Home</a> / <a href="{{ route('seasons.index') }}">All Seasons</a> / <a href="/seasons/{{ $season->id }}">{{ $season->season_name }}</a> / <a href="{{ route('teams.index', ['seasonId' => $season->id]) }}">Teams</a> / Add</p>

<h1>Edit {{ $team->team_name }}</h1>
<div class="row">

    <form method="POST" action="{{ route('teams.destroy', ['seasonId' => $season->id, 'teamId' => $team->id]) }}" style="display:inline;">
        @csrf
        @method('DELETE')

        <p><button type="submit" onclick="return confirm('Are you sure you want to delete this team?')">Delete {{ $team->team_name }}</button></p>
    </form>
    <hr>


    <div class="col-lg-4">
        <form method="post" action="{{ route('teams.update', ['seasonId' => $season->id, 'teamId' => $team->id]) }}">
            @csrf
            @method('PUT')

            <div class="form-group">
                <label for="team_name">Team Name:</label>
                <input type="text" name="team_name" class="form-control" value="{{ $team->team_name }}" required>
            </div>

            <div class="form-group">
                <label for="team_captain">Captain:</label>
                <input type="text" name="team_captain" class="form-control" value="{{ $team->team_captain }}" required>
            </div>

            <div class="form-group">
                <label for="team_captain_no">Captain Phone:</label>
                <input type="text" name="team_captain_no" class="form-control" value="{{ $team->team_captain_no }}" required>
            </div>


            <div class="form-group">
                <label for="team_vice_captain">Vice Captain:</label>
                <input type="text" name="team_vice_captain" class="form-control" value="{{ $team->team_vice_captain }}">
            </div>


            <div class="form-group">
                <label for="team_vice_captain_no">Vice Captain Phone:</label>
                <input type="text" name="team_vice_captain_no" class="form-control" value="{{ $team->team_vice_captain_no }}">
            </div>
            <button type="submit" class="btn btn-primary">Update Team</button>
        </form>
    </div>
</div>

        
@endsection
