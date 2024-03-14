@extends('layouts.app')
@section('title', 'Home')

@section('content')

<p><a href="{{ url('/') }}">Home</a> / News</p>

<h1>Edit News</h1>


    <div class="row">
        @can('delete news')
        <form method="POST" action="{{ route('news.destroy', ['newsId' => $news->id]) }}" style="display:inline;">
            @csrf
            @method('DELETE')
    
            <p><button type="submit" onclick="return confirm('Are you sure you want to delete this article?')">Delete Article</button></p>
        </form>
        <hr>
        @endcan

        <form method="POST" action="{{ route('news.update', ['newsId' => $news->id]) }}">
            @csrf
            @method('PUT')

            <div class="form-group">
                <p><input class="form-control" type="text" name="title" id="title" value="{{$news->title}}"></p>
            </div>
            <div class="form-group">
                <p><input class="form-control" type="text" name="content" id="content" value="{{$news->content}}"></p>
            </div>
        
            <div class="form-group">
                
            
                <select class="form-control" id="image" name="image">
                    <option value="/images/logo.png">Image</option>
                    <option value="/images/logo.png" @if ($news->image == "/images/logo.png") selected @endif>League logo</option>
                    <option value="/images/league.png" @if ($news->image == "/images/league.png") selected @endif>League Update</option>
                    <option value="/images/teamko.png" @if ($news->image == "/images/teamko.png") selected @endif>Team KO Update</option>
                    <option value="/images/singles.png" @if ($news->image == "/images/singles.png") selected @endif>Singles Update</option>
                    <option value="/images/45s.png" @if ($news->image == "/images/45s.png") selected @endif>Over 45s Update</option>
                    <option value="/images/pairs.png" @if ($news->image == "/images/pairs.png") selected @endif>Pairs Update</option>
                    <option value="/images/gold.png" @if ($news->image == "/images/gold.png") selected @endif>Golden Frame</option>
                    <option value="/images/stats2.png" @if ($news->image == "/images/stats2.png") selected @endif>Stats Logo</option>
                    <option value="/images/stats.png" @if ($news->image == "/images/stats.png") selected @endif>End of Season Stats</option>
                </select>
            </div>
        



            <p><br><button type="submit" class="btn btn-primary">Update News</button></p>
        </form>
    </div>


@endsection
