@extends('layouts.app')

@section('content')
<p><a href="{{ route('home') }}">Home</a> / <a href="{{ route('seasons.index') }}">All Seasons</a> / <a href="/seasons/{{ $season->id }}">{{ $season->season_name }}</a> / Edit </p>

<h1>Edit {{ $competition->competitions_name }}</h1>
<div class="row">

    <form method="POST" action="{{ route('competitions.destroy', ['seasonId' => $season->id, 'competitionId' => $competition->id]) }}" style="display:inline;">
        @csrf
        @method('DELETE')

        <p><button type="submit" onclick="return confirm('Are you sure you want to delete this competition?')">Delete {{ $competition->competitions_name }}</button></p>
    </form>
    <hr>
    <form method="POST" action="{{ route('competitions.update', ['seasonId' => $season->id, 'competitionId' => $competition->id]) }}">
            @csrf
            @method('PUT')
            <div class="col-lg-4">
                <div class="card">
                    <div class="card-header">Edit</div>
                    <div class="card-body">
                        <p><label for="competitions_name">Competition Name:</label>
                        <input type="text" name="competitions_name" required value="{{ $competition->competitions_name }}"></p>

                        <p><label for="comp_winner">Winner:</label>
                        <input type="text" name="comp_winner" value="{{ $competition->comp_winner }}"></p>

                        <p><label for="comp_second">Runner Up:</label>
                        <input type="text" name="comp_second" value="{{ $competition->comp_second }}"></p>

                        <p><label for="comp_type">Type</label>
                            <select name="comp_type" value="{{ $competition->comp_type }}">
                                <option value="" {{($competition->comp_type == 0) ? 'selected' : ''}}>Choose</option>
                                <option value="1" {{($competition->comp_type == 1) ? 'selected' : ''}}>League</option>
                                <option value="2" {{($competition->comp_type == 2) ? 'selected' : ''}}>Team Knock Out</option>
                                <option value="3" {{($competition->comp_type == 3) ? 'selected' : ''}}>Singles / Plate</option>
                                <option value="4" {{($competition->comp_type == 4) ? 'selected' : ''}}>Over 45s</option>
                                <option value="5" {{($competition->comp_type == 5) ? 'selected' : ''}}>Pairs</option>
                              </select>
                        </p>


                        <p><button type="submit">Save Edits</button></p>
                    </div>
                </div>
            </div>
        </form>

</div>
        
@endsection
