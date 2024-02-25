@extends('layouts.app') 

@section('content')

<div class="breadcrumb"><p><a href="{{ url('/') }}">Home</a> / <a href="{{ route('seasons.index') }}">All Seasons</a> / <a href="/seasons/{{ $seasons->id }}">{{ $seasons->season_name }}</a> / {{ $competitions[$competitionId] }}</p></div>

<h1> {{ $competitions[$competitionId] }} Table</h1>

    @if($fixtures->count() > 0)
    <div class="row">

        <table class="table">
            <thead>
                <tr>
                    <th></th>
                    <th style="text-align: center;">Pl</th>
                    <th style="text-align: center;">W</th>
                    <th style="text-align: center;">D</th>
                    <th style="text-align: center;">L</th>
                    <th style="text-align: right;">Pts</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($standings as $standing)
                <tr>
                    <td>{{ $standing->team_name }}</td>
                    <td style="text-align: center;">{{ $standing->totalpl }}</td>
                    <td style="text-align: center;">{{ $standing->totalwin }}</td>
                    <td style="text-align: center;">{{ $standing->totaltie }}</td>
                    <td style="text-align: center;">{{ $standing->totalloss }}</td>
                    <td style="text-align: right;">{{ $standing->totalpts }}</td>
                </tr>
                @endforeach
            </tbody>
        </table>

    </div>

    @else
        <p>No fixtures found for this competition.</p>
    @endif
@endsection
