@extends('layouts.app')

@section('content')

<p><a href="{{ url('/') }}">Home</a> / <a href="{{ route('seasons.index') }}">All Seasons</a> / <a href="/seasons/{{ $season->id }}">{{ $season->season_name}}</a> / Add</p>

<h1>Add new Competition</h1>

<div class="row">
  <form method="post" action="{{ route('competitions.store', ['seasonId' => $season->id]) }}">
    @csrf
    <div class="col-lg-4 mb-4">
        <div class="card">
          <div class="card-header">Edit</div>
          <div class="card-body">
            <input type="hidden" name="season_id" value="{{ $season->id }}">

            <p><label for="competitions_name">Competition Name:</label>
            <input type="text" name="competitions_name" required></p>

            <p><label for="comp_winner">Winner:</label>
            <input type="text" name="comp_winner" value=""></p>

            <p><label for="comp_second">Runner Up:</label>
            <input type="text" name="comp_second" value="" ></p>

            <p><label for="comp_type">Type</label>
            <select name="comp_type">
                <option value="">Choose</option>
                <option value="1">Leagues</option>
                <option value="2">Team cups</option>
                <option value="3">Individual cups</option>
                <option value="4">Two player cups</option>
              </select></p>

            <p><button type="submit">Add Competition</button></p>
          </div>
        </div>
    </div>
  </form>

@endsection
