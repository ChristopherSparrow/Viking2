@extends('layouts.app')

@section('content')

<p><i><a href="{{ url('/') }}">Home</a> / All Seasons</i></p>
<h1>All Seasons</h1>

@can('delete user')<p><a href="{{ route('seasons.create') }}">Create New Season</a></p>@endcan

<div class="row">
    @foreach ($seasons as $season)


                     
    <div class="col-lg-4 mb-2">
        <div class="card shadow p-30 mb-4 bg-white rounded">
            <div class="card-header d-flex justify-content-between align-items-center">{{ $season->season_name }} <a href="/seasons/{{ $season->id }}"><i class="bi bi-box-arrow-in-right"></i> View Season</a></div>
            <div class="card-body">
                <p>{{ \Carbon\Carbon::parse($season->season_start_date)->format('F j, Y') }} - {{ \Carbon\Carbon::parse($season->season_end_date)->format('F j, Y') }}</p>
                
                @foreach ($season->competitions as $competition)
                    <p><strong>{{ $competition->competitions_name }}</strong><br>Winner - {{ $competition->comp_winner }}<br>Runner Up - {{ $competition->comp_second }}<br></p>
                 @endforeach

            </div>

        </div>
    </div>
    @endforeach
</div>

@endsection