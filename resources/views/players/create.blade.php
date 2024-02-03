@extends('layouts.app')

@section('content')

<p><a href="{{ route('home') }}">Home</a> / <a href="{{ route('seasons.index') }}">All Seasons</a> / <a href="/seasons/{{ $season->id }}">{{ $season->season_name }}</a> / <a href="{{ route('players.index', ['seasonId' => $season->id]) }}">Players</a> / Add</p>
<h1>Players for {{ $season->season_name }}</h1>

<div class="row">
    <div class="col-lg-4">
        <form method="post" action="{{ route('players.store', ['seasonId' => $season->id]) }}">
            @csrf

            <input type="hidden" name="season_id" value="{{ $season->id }}">

            <div class="form-group">
                <label for="player_name">Name:</label>
                <input type="text" name="player_name" class="form-control" required>
            </div>
            <pre>
                <?php var_dump($teams); ?>
            </pre>
            <select name="team_id" class="form-control">
                <option value="" selected>Select Team</option>
                @foreach($teams as $key => $value)
                    <option value="{{ $key }}">{{ $value }}</option>
                @endforeach
            </select>

            <br>

            <button type="submit" class="btn btn-primary">Add Team</button>
        </form>

</div>
</div>
@endsection
