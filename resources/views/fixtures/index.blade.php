@extends('layouts.app') 

@section('content')

<p><a href="{{ url('/') }}">Home</a> / <a href="{{ route('seasons.index') }}">All Seasons</a> / {{ $competitionId }}</p>

<h1>Competition {{ $competitionId }}</h1>

    @if($fixtures->count() > 0)
    <div>

                @foreach ($fixtures->sortBy('date')->groupBy('date') as $date => $groupedFixtures)
                <div class="col-lg-4 mb-4">
                    <div class="card">
                        <div class="card-header">{{ \Carbon\Carbon::parse($date)->format('F j, Y') }}</div>
                        <div class="card-body">
                            <table width="100%">
                                @foreach ($groupedFixtures as $fixture)
                                
                                    <tr>
                                    <td>{{ $teams[$fixture->home_team] }}</td>
                                    <td style="text-align: center; background: #ccc;">{{ $fixture->home_score }}</td>
                                    <td style="text-align: center; background: #ccc;">{{ $fixture->away_score }}</td>
                                    <td style="text-align: right;">{{ $teams[$fixture->away_team] }}</td>
                                </tr>
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
