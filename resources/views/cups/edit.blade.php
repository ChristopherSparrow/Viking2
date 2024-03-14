@extends('layouts.app')

@section('content')

<p><a href="{{ url('/') }}">Home</a> / <a href="{{ route('seasons.index') }}">All Seasons</a> / {{ $seasons->season_name }} / {{ $competitions[$competitionId] }}</p>

<h1>Edit Fixture - {{ \Carbon\Carbon::parse($date)->format('F j, Y') }}</h1>

@foreach ($fixtures->sortBy('date')->groupBy('date') as $date => $groupedFixtures)
    <div class="row">
        <form method="POST" action="{{ route('cups.update', ['seasonId' => $seasons->id, 'competitionId' => $competitionId, 'date' => $date]) }}">
            @csrf
            @method('PUT')

            @foreach($groupedFixtures as $fixture)
                <input type="hidden" name="fixtures[{{ $fixture->id }}][id]" value="{{ $fixture->id }}">
                <input type="hidden" name="fixtures[{{ $fixture->id }}][location]" value="{{ $fixture->location }}">
                <div class="form-group">
                    <table><tr>
                        <td>
                            <select class="form-control" id="home_player_1" name="fixtures[{{ $fixture->id }}][home_player_1]">
                                @foreach($players as $playerId => $playerName)
                                    <option value="{{ $playerId }}" {{ $fixture->home_player_1 == $playerId ? 'selected' : '' }}>
                                        {{ $playerName }}
                                    </option>
                                @endforeach
                            </select>
                        </td>
                        <td><input type="text" class="form-control" name="fixtures[{{ $fixture->id }}][home_score]" value="{{ $fixture->home_score }}"></td>
                        <td><input type="text" class="form-control" name="fixtures[{{ $fixture->id }}][away_score]" value="{{ $fixture->away_score }}"></td>
                        <td>

                            <select class="form-control" id="awway_player_1" name="fixtures[{{ $fixture->id }}][away_player_1]">
                                @foreach($players as $playerId => $playerName)
                                    <option value="{{ $playerId }}" {{ $fixture->away_player_1 == $playerId ? 'selected' : '' }}>
                                        {{ $playerName }}
                                    </option>
                                @endforeach
                            </select>
                        </td>
                        <td></td>
                    </tr></table>
                </div>
            @endforeach

            <button type="submit" class="btn btn-primary">Update Fixture</button>
        </form>
    </div>
@endforeach

@endsection
