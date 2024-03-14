@extends('layouts.app')
@section('title', 'Home')

@section('content')


<h1 style="padding-top:10px"><strong>the Viking Pool League</strong></h1>
<p>A blackball pool league for Pocklington, Market Weighton and surrounding villages.</p>

<div class="row" data-masonry='{"percentPosition": true }'>

    <div class="col-lg-4 mb-2">
        <div class="card shadow p-30 mb-4 bg-white rounded">
            <div class="card-header d-flex justify-content-between align-items-center">Latest News

                <div class="float-right"><a href="{{ route('news.index')}}"><i class="bi bi-newspaper"></i> More News</a></div>
            </div>
            <div class="card-body">
                <table class="table">

                    @foreach ($news as $article)

                    <tr>
                        <td><img src="{{ $article->image }}" style="height:100px; width:100px"></td>
                        <td>
                            <p><strong>{{ $article->title }}</strong></p>
                            <p>{{ $article->content }}</p>
                            <div class="row">
                                <div class="col"></div>
                                <div class="col-auto">
                                    <p><i class="bi bi-calendar"></i> {{ \Carbon\Carbon::parse($article->created_at )->format('jS F Y') }}</p>

                                </div>
                            </div>

                        </td>
                    </tr>
                    @endforeach

                </table>
                
            </div>
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
                    <div class="card-header">Fixtures & Results</div> 
                       <div class="card-body">
                @foreach ($allFixtures->groupBy('date') as $date => $allfixturesByDate)


                        <p><strong>{{ \Carbon\Carbon::parse($date)->format('l, jS F Y')}}</strong></p>
                        
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

</div>

<div class="container">
    <div class="row">
        <nav class="nav nav-pills nav-fill">
            <a class="flex-sm-fill text-sm-center nav-link " href="{{ route('fixtures.index', ['competitionId' => 1, 'seasonId' => 1]) }}">Divison One</a>
            <a class="flex-sm-fill text-sm-center nav-link " href="{{ route('fixtures.index', ['competitionId' => 2, 'seasonId' => 1]) }}">Team Knock Out</a>
            <a class="flex-sm-fill text-sm-center nav-link " href="{{ route('cups.index', ['competitionId' => 3, 'seasonId' => 1]) }}">Singles Cup</a>
            <a class="flex-sm-fill text-sm-center nav-link " href="{{ route('cups.index', ['competitionId' => 7, 'seasonId' => 1]) }}">Singles Plate</a>
            <a class="flex-sm-fill text-sm-center nav-link " href="{{ route('cups.index', ['competitionId' => 4, 'seasonId' => 1]) }}">Over 45s Cup</a>
            <a class="flex-sm-fill text-sm-center nav-link " href="{{ route('cups.index', ['competitionId' => 5, 'seasonId' => 1]) }}">Doubles Cup</a>
        </nav>
    </div>
</div>

@endsection