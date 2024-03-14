@extends('layouts.app')
@section('title', 'Home')

@section('content')

<p><a href="{{ url('/') }}">Home</a> / News</p>

<h1>Create News</h1>
<form method="POST" action="{{ route('news.store')}}">
    @csrf
    <div class="form-group">
        <p><input class="form-control" type="text" name="title" id="title" placeholder="News title"></p>
    </div>
    <div class="form-group">
        <p><input class="form-control" type="text" name="content" id="content" placeholder="News content"></p>
    </div>
    <div class="form-group">
        <select class="form-control" id="image" name="image">
            <option value="/images/logo.png">Choose Image</option>
            <option value="/images/logo.png">League logo</option>
            <option value="/images/league.png">League update</option>
            <option value="/images/teamko.png">Team KO update</option>
            <option value="/images/singles.png">Singles update</option>
            <option value="/images/45s.png">Over 45s update</option>
            <option value="/images/pairs.png">Pairs</option>
            <option value="/images/gold.png">Golden Frame</option>
            <option value="/images/stats2.png">Stats logo</option>
            <option value="/images/stats.png">End of season stats</option>
        </select>
    </div>
    <div class="form-group">
        <p><br><button type="submit" class="btn btn-primary">Create News</button></p>
    </div>
</form>

@endsection
