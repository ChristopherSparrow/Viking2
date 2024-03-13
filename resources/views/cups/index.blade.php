@extends('layouts.app') 
@section('title', $seasons->season_name . ' - ' .  $competitions[$competitionId] )

@section('content')

<div class="breadcrumb"><p><a href="{{ url('/') }}">Home</a> / <a href="{{ route('seasons.index') }}">All Seasons</a> / <a href="/seasons/{{ $seasons->id }}">{{ $seasons->season_name }}</a> / {{ $competitions[$competitionId] }}</p></div>

<h1> {{ $competitions[$competitionId] }}</h1>

@can('create cup')
<a href="{{ route('cups.create', ['seasonId' => $seasons->id, 'competitionId' => $competitionId]) }}" class="btn btn-primary">Create Fixture</a>
@endcan
    @if($fixtures->count() > 0)
    <div class="row">
        @foreach ($comp_type[$competitionId] == 1 ? $fixtures->sortBy('date')->groupBy('date') : $fixtures->sortByDesc('date')->groupBy('date') as $date => $groupedFixtures)
         @php
            $firstFixture = $groupedFixtures->first();
            $comp_round = $firstFixture->comp_round; 
        @endphp
    
    <div class="col-lg-4 mb-2">
        <div class="card shadow p-30 mb-4 bg-white rounded">
            <div class="card-header d-flex justify-content-between align-items-center">{{ \Carbon\Carbon::parse($date)->format('F j, Y') }} 
                            
                            
                @if(isset($rounds[$comp_round]))
                   |  {{ $rounds[$comp_round] }}
                @else
                    
                @endif
                       

                @can('update cup')
                            <div class="float-right">
                                <a href="{{ route('cups.edit', ['seasonId' => $seasons->id, 'competitionId' => $competitionId, 'date' => $date]) }}" class="btn btn-primary btn-sm">Edit</a>

                                <form action="{{ route('cups.destroy', ['seasonId' => $seasons->id, 'competitionId' => $competitionId, 'date' => $date]) }}" method="POST" style="display: inline-block;">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Are you sure you want to delete this date?')">Delete</button>
                            </form>
                            </div>

                            @endcan
                        </div>
                        
                        <div class="card-body">
                            <table class="table">
                                @foreach ($groupedFixtures as $fixture)
                               
                                @if($fixture->location )
                                    <tr>
                                        @if($fixture->home_score > $fixture->away_score)
                                        <td style="border: none;"><strong>{{ $players[$fixture->home_player_1] }} @if($comp_type[$competitionId] == 5) / {{ $players[$fixture->home_player_2] }}@endif</strong><br>
                                        {{ $players[$fixture->away_player_1] }} @if($comp_type[$competitionId] == 5) / {{ $players[$fixture->away_player_2] }}@endif</td>
                                        <td style="text-align: center; background: #ccc;"><strong>{{ $fixture->home_score }}</strong><br>
                                        {{ $fixture->away_score }}</td>
                                        @elseif($fixture->home_score < $fixture->away_score)
                                        <td style="border: none;">{{ $players[$fixture->home_player_1] }} @if($comp_type[$competitionId] == 5) / {{ $players[$fixture->home_player_2] }}@endif<br>
                                            <strong>{{ $players[$fixture->away_player_1] }}@if($comp_type[$competitionId] == 5) / {{ $players[$fixture->away_player_2] }}@endif</strong></td>
                                            <td style="text-align: center; background: #ccc;">{{ $fixture->home_score }}<br>
                                                <strong>{{ $fixture->away_score }}</strong></td>
                                        @else
                                        <td style="border: none;">{{ $players[$fixture->home_player_1] }} @if($comp_type[$competitionId] == 5) / {{ $players[$fixture->home_player_2] }}@endif<br>
                                            {{ $players[$fixture->away_player_1] }} @if($comp_type[$competitionId] == 5) / {{ $players[$fixture->away_player_2] }}@endif</td>
                                            <td style="text-align: center; background: #ccc;">{{ $fixture->home_score }}<br>
                                            {{ $fixture->away_score }}</td>

                                        @endif
                                    </tr>
                                    <tr>
                                        <td style="text-align: left;" colspan="2">VENUE: {{ $fixture->location }}</td>
                                    </tr>
                     
                                @else
                                <tr>
                                    @if($fixture->home_score > $fixture->away_score)
                                    <td style="border: none;"><strong>{{ $players[$fixture->home_player_1] }}</strong><br>
                                    {{ $players[$fixture->away_player_1] }}</td>
                                    <td style="text-align: center; background: #ccc;"><strong>{{ $fixture->home_score }}</strong><br>
                                    {{ $fixture->away_score }}</td>
                                    @elseif($fixture->home_score < $fixture->away_score)
                                    <td style="border: none;">{{ $players[$fixture->home_player_1] }}<br>
                                        <strong>{{ $players[$fixture->away_player_1] }}</strong></td>
                                        <td style="text-align: center; background: #ccc;">{{ $fixture->home_score }}<br>
                                            <strong>{{ $fixture->away_score }}</strong></td>
                                    @else
                                    <td style="border: none;">{{ $players[$fixture->home_player_1] }}<br>
                                        {{ $players[$fixture->away_player_1] }}</td>
                                        <td style="text-align: center; background: #ccc;">{{ $fixture->home_score }}<br>
                                        {{ $fixture->away_score }}</td>

                                    @endif
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
