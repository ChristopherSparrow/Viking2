@extends('layouts.app')

@section('content')

<p><a href="{{ route('home') }}">Home</a> / All Seasons</p>
<h1>All Seasons</h1>

<p><a href="{{ route('seasons.create') }}">Create New Season</a></p>

<div class="row">
    @foreach ($seasons as $season)


                     
    <div class="col-lg-4 mb-4">
        <div class="card">
            <div class="card-header">{{ $season->season_name }}</div>
            <div class="card-body">
                <p>{{ \Carbon\Carbon::parse($season->season_start_date)->format('F j, Y') }} - {{ \Carbon\Carbon::parse($season->season_end_date)->format('F j, Y') }}</p>
                
                @foreach ($season->competitions as $competition)
                    <p><strong>{{ $competition->competitions_name }}</strong><br>Winner - {{ $competition->comp_winner }}<br>Runner Up - {{ $competition->comp_second }}<br></p>
                 @endforeach

            </div>
            <div class="card-footer"><a href="/seasons/{{ $season->id }}">More</a></div>
        </div>
    </div>
    @endforeach
</div>

@endsection