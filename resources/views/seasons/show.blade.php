@extends('layouts.app')

@section('content')

<p><a href="{{ route('home') }}">Home</a> / <a href="{{ route('seasons.index') }}">All Seasons</a> / {{ $season->season_name }}</p>

<h1>{{ $season->season_name }}</h1>

<p>{{ \Carbon\Carbon::parse($season->season_start_date)->format('F j, Y') }} - {{ \Carbon\Carbon::parse($season->season_end_date)->format('F j, Y') }}</p>

<p><a href="{{ route('competitions.create', ['season_id' => $season->id]) }}">Add Competitions</a></p>
@if($season->competitions->count() > 0)
<div class="row">
    @foreach ($season->competitions as $competition)
    <div class="col-lg-4">
        <div class="card">
            <div class="card-header">{{ $competition->competitions_name }}</div>
            <div class="card-body">
                <p><a href="{{ route('competitions.edit', ['season' => $season->id, 'competition' => $competition->id]) }}">Edit/Delete</a></p>
                <p>Winner - {{ $competition->comp_winner }}<br>Runner Up - {{ $competition->comp_second }}<br></p>
            </div>
        </div>
    </div>
    @endforeach
    @else
    <p>No competitions for this season yet.</p>
    @endif
</div>    
    
@endsection
