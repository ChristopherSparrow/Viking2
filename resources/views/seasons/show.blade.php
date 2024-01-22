@extends('layouts.app')

@section('content')
    <div class="container">
        <h1>{{ $season->season_name }}</h1>
        
        <p><strong>Start Date:</strong> {{ \Carbon\Carbon::parse($season->season_start_date)->format('F j, Y') }}</p>
        <p><strong>End Date:</strong> {{ \Carbon\Carbon::parse($season->season_end_date)->format('F j, Y') }}</p>

        <h2>Competitions</h2>
       
        <p><a href="{{ route('competitions.create', ['season_id' => $season->id]) }}">Add Competitions</a></p>
        
        @if($season->competitions->count() > 0)
            <ul>
                @foreach ($season->competitions as $competition)
                    <li>
                        <strong>{{ $competition->competitions_name }}</strong><br>
                        Winner - {{ $competition->comp_winner }}<br>
                        Runner Up - {{ $competition->comp_second }}<br>
                    </li>
                @endforeach
            </ul>
        @else
            <p>No competitions for this season yet.</p>
        @endif
        
    </div>
@endsection
