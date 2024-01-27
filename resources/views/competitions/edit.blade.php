@extends('layouts.app')

@section('content')
<p><a href="{{ route('home') }}">Home</a> / <a href="{{ route('seasons.index') }}">All Seasons</a> / <a href="/seasons/{{ $season->id }}">{{ $season->season_name }}</a> / Edit </p>

<h1>Edit {{ $competition->competitions_name }}</h1>
<div class="row">

    <form method="POST" action="{{ route('competitions.destroy', ['season' => $season->id, 'competition' => $competition->id]) }}" style="display:inline;">
        @csrf
        @method('DELETE')

        <p><button type="submit" onclick="return confirm('Are you sure you want to delete this competition?')">Delete {{ $competition->competitions_name }}</button></p>
    </form>
    <hr>
    <form method="POST" action="{{ route('competitions.update', ['season' => $season->id, 'competition' => $competition->id]) }}">
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

                        <p><button type="submit">Edit Competition</button></p>
                    </div>
                </div>
            </div>
        </form>

</div>
        
@endsection
