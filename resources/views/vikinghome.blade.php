@extends('layouts.app')

@section('content')


<h1 style="padding-top:10px">the Viking Pool League</h1>
<p>The pool league for Pocklington, Market Weighton and surrounding villages</p>

<div class="row" data-masonry='{"percentPosition": true }'>

    <div class="col-lg-4 mb-2">
        <div class="card shadow p-30 mb-4 bg-white rounded">
            <div class="card-header d-flex justify-content-between align-items-center">Latest News</div>
            <div class="card-body"><p>News to go in here</p></div>
        </div>
    </div>

    <div class="col-lg-4 mb-2">
            @if ($allFixtures->isEmpty())
                <div class="card shadow p-30 mb-4 bg-white rounded">
                    <div class="card-header">Fixtures</div>
                    <div class="card-body">No fixtures</div>
                </div>

            @else
                <div class="card shadow p-30 mb-4 bg-white rounded">
                    <div class="card-header">Fixtures </div> 
                       <div class="card-body">
                @foreach ($allFixtures->groupBy('date') as $date => $allfixturesByDate)


                        <p>{{ \Carbon\Carbon::parse($date)->format('D, d M Y') }}</p>
                        
<table class="table">
                                @foreach ($allfixturesByDate as $fixture)

                                
                                    <tr>
                                        <td><a href="{{ $fixture->home_team_name ? route('fixtures.index', ['competitionId' => $fixture->competition_id, 'seasonId' => $fixture->season_id]) : route('cups.index', ['competitionId' => $fixture->competition_id, 'seasonId' => $fixture->season_id]) }} ">{{$fixture->competition_name}} {{$fixture->round}}</a> 
                                       
                                       <br>{{ $fixture->home_team_name ? $fixture->home_team_name : $fixture->home_player_name_1 }} {{ $fixture->home_player_name_2 ? : $fixture->home_player_name_2}}
                                        <br>{{ $fixture->away_team_name ? $fixture->away_team_name : $fixture->away_player_name_1 }} {{ $fixture->away_player_name_2 ? : $fixture->away_player_name_2}}
                                        </td>
                                        <td style="text-align: right"><br>{{ $fixture->home_score }}<br>{{ $fixture->away_score }}</td>
                             </td></tr>
                            
                                @endforeach                                
</table>
                @endforeach
                    </div>
                </div>       
            @endif


    </div>





    <div class="col-lg-4 mb-2">
        <div class="card shadow p-30 mb-4 bg-white rounded">
            <div class="card-header d-flex justify-content-between align-items-center">Table</div>
            <div class="card-body">


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
            


            </div>
        </div>
    </div>

    <p><a href="{{ route('seasons.index') }}">All Seasons</a> | <a href="seasons/1">This Season</a></p>


</div>

@endsection