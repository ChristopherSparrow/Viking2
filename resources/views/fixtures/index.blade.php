@extends('layouts.app') 

@section('content')

<div class="breadcrumb"><p><a href="{{ url('/') }}">Home</a> / <a href="{{ route('seasons.index') }}">All Seasons</a> / <a href="/seasons/{{ $seasons->id }}">{{ $seasons->season_name }}</a> / {{ $competitions[$competitionId] }}</p></div>

<h1> {{ $competitions[$competitionId] }}</h1>

    <div class="row">
        @can('update fixture')
            <p><a href="{{ route('fixtures.create', ['seasonId' => $seasons->id, 'competitionId' => $competitionId]) }}" class="btn btn-primary">Create Fixture</a></p>
        @endcan

        @if($fixtures->count() > 0)



        @foreach ($comp_type[$competitionId] == 1 ? $fixtures->sortBy('date')->groupBy('date') : $fixtures->sortByDesc('date')->groupBy('date') as $date => $groupedFixtures)
        @php
        $firstFixture = $groupedFixtures->first();
        $comp_round = $firstFixture->comp_round; 
    @endphp
       <div class="col-lg-4">
                <div class="card shadow p-30 mb-4 bg-white rounded">
                    <div class="card-header d-flex justify-content-between align-items-center">
                        {{ \Carbon\Carbon::parse($date)->format('F j, Y') }}
                        @if(isset($rounds[$comp_round]))
                        |  {{ $rounds[$comp_round] }}
                     @else
                         
                     @endif
                        @can('update fixture')
                        <a href="{{ route('fixtures.edit', ['seasonId' => $seasons->id, 'competitionId' => $competitionId, 'date' => $date]) }}">Edit</a>
                        <form action="{{ route('fixtures.destroy', ['seasonId' => $seasons->id, 'competitionId' => $competitionId, 'date' => $date]) }}" method="POST" style="display: inline-block;">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger btn-sm" style="height:25px; width:75px;" onclick="return confirm('Are you sure you want to delete this date?')">Delete</button>
                        </form>

                        @endcan
                    
                    </div>
                    
                    <div class="card-body">
                        <table class="table">
                            @foreach ($groupedFixtures as $fixture)
                            @if($fixture->location )
                            <tr>
                                                                    <td style="text-align: center; vertical-align: middle;"><i class="bi bi-search"></i></td>
                                    <td style="border: none;">{{ $teams[$fixture->home_team] }}<br>
                                    {{ $teams[$fixture->away_team] }}</td>
                                    <td style="text-align: center; background: #ccc;">{{ $fixture->home_score }}<br>
                                    {{ $fixture->away_score }}</td>
                                </tr>
                                <tr>
                                <td style="text-align: center;" colspan="2">VENUE: {{ $fixture->location }}</td></tr>
                    
                            @else
                            <tr>
                                <td style="text-align: center; vertical-align: middle;"><i class="bi bi-search"></i></td>
                                <td>{{ $teams[$fixture->home_team] }}<br>
                                {{ $teams[$fixture->away_team] }}</td>
                                <td style="text-align: center; background: #ccc;">{{ $fixture->home_score }}<br>
                                {{ $fixture->away_score }}</td>
                            </tr>           
                            @endif
                            @endforeach
                        </table>

                    </div>
                </div>
            </div>
        @endforeach
    </div> 

        @else
            <p>No fixtures found for this competition.</p>
        @endif
@endsection
