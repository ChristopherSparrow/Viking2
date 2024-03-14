@extends('layouts.app') 

@section('title', 'News' )

@section('content')

<div class="breadcrumb"><p><a href="{{ url('/') }}">Home</a> / News</p></div>

<h1> News </h1>
@can('create news')
<p><a href="{{route ('news.create')}}">Create news item</a><p>
@endcan
<div class="row">
    
    @foreach ($news as $article)  
        <div class="col-lg-4">
            <div class="card shadow p-30 mb-4 bg-white rounded">
                <div class="card-body">
                    <p><strong>{{$article->title}}</strong><br>
                    {{$article->content}}</p>
                    <i class="bi bi-calendar"></i> {{ \Carbon\Carbon::parse($article->created_at )->format('jS F Y') }}
                    @can('update news')<a href="{{ route('news.edit', ['newsId' => $article->id]) }}">Edit</a>@endcan
                </div>
            </div>
        </div>
    @endforeach
</div>    
@endsection
