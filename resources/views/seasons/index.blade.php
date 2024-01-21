@extends('layouts.app')

@section('content')

@foreach ($seasons as $season)
    <div class="col-lg-4">
        <div class="card">
            <div class="card-header">{{ $season->season_name }}</div>
            <div class="card-body"><a href="/seasons/{{ $season->id }}">{{ $season->season_name }}</a>
                <p><strong>Start:</strong> {{ \Carbon\Carbon::parse($season->season_start_date)->format('F j, Y') }}<br><strong>End:</strong>{{ \Carbon\Carbon::parse($season->season_end_date)->format('F j, Y') }}<br><br></p>
                
            </div>
        </div>
    </div>
    @endforeach

@endsection