@extends('layouts.app')

@section('content')

<p><a href="{{ url('/') }}">Home</a> / <a href="{{ route('seasons.index') }}">All Seasons</a> / {{ $seasons->season_name }} / {{ $competitions[$competitionId] }}</p>

<h1>Edit Fixture - {{ \Carbon\Carbon::parse($date)->format('F j, Y') }}</h1>

@foreach ($fixtures->sortBy('date')->groupBy('date') as $date => $groupedFixtures)
    <div class="row">
        <form method="POST" action="{{ route('fixtures.update', ['seasonId' => $seasons->id, 'competitionId' => $competitionId, 'date' => $date]) }}">
            @csrf
            @method('PUT')

            @foreach($groupedFixtures as $fixture)
                <input type="hidden" class="form-control" name="fixtures[{{ $fixture->id }}][id]" value="{{ $fixture->id }}">
                <input type="hidden" name="fixtures[{{ $fixture->id }}][location]" value="{{ $fixture->location }}">
                <div class="form-group">
                    <table><tr>
                        <td>
                            <select class="form-control" id="home_team" name="fixtures[{{ $fixture->id }}][home_team]">
                                @foreach($teams as $teamId => $teamName)
                                    <option value="{{ $teamId }}" {{ $fixture->home_team == $teamId ? 'selected' : '' }}>
                                        {{ $teamName }}
                                    </option>
                                @endforeach
                            </select>
                        </td>
                        <td><input type="text" style="width:40px;" class="form-control" name="fixtures[{{ $fixture->id }}][home_score]" value="{{ $fixture->home_score }}"></td>
                        <td><input type="text" style="width:40px;" class="form-control" name="fixtures[{{ $fixture->id }}][away_score]" value="{{ $fixture->away_score }}"></td>
                        <td>

                            <select class="form-control" id="away_team" name="fixtures[{{ $fixture->id }}][away_team]">
                                @foreach($teams as $teamId => $teamName)
                                    <option value="{{ $teamId }}" {{ $fixture->away_team == $teamId ? 'selected' : '' }}>
                                        {{ $teamName }}
                                    </option>
                                @endforeach
                            </select>
                        </td>
                        <td>
                            <input type="hidden" style="width:440px;" class="form-control" name="fixtures[{{ $fixture->id }}][comp_round]" value="{{ $fixture->comp_round }}">
                        </td>
                    </tr></table>
                </div>
            @endforeach

            <button type="submit" class="btn btn-primary">Update Fixture</button>
        </form>
    </div>
@endforeach

@endsection
