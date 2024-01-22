@extends('layouts.app')

@section('content')
<p><a class="nav-link" href="{{ route('seasons.create') }}">Create New Season</a></p>
@foreach ($seasons as $season)


                     
    <div class="col-lg-4">
        <div class="card">
            <div class="card-header">{{ $season->season_name }}</div>
            <div class="card-body"><a href="/seasons/{{ $season->id }}">{{ $season->season_name }}</a>
                <p>{{ \Carbon\Carbon::parse($season->season_start_date)->format('F j, Y') }} - {{ \Carbon\Carbon::parse($season->season_end_date)->format('F j, Y') }}</p>
                
                @foreach ($season->competitions as $competition)
                    <p><strong>{{ $competition->competitions_name }}</strong><br>Winner - {{ $competition->comp_winner }}<br>Runner Up - {{ $competition->comp_second }}<br></p>
                 @endforeach

            </div>
        </div>
    </div>
    @endforeach

@endsection