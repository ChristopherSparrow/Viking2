@extends('layouts.app')

@section('content')

<p><a href="{{ route('home') }}">Home</a> / <a href="{{ route('seasons.index') }}">All Seasons</a> / Add</p>
<h1>Add new Season</h1>
<div class="row">
    <div class="col-lg-4 mb-4">
        <div class="card">
            <div class="card-body">
                <form method="post" action="{{ route('seasons.store') }}">
                    @csrf
                    <p><label for="season_name">Season Name:</label>
                    <input type="text" name="season_name" id="season_name" required></p>

                    <p><label for="season_start_date">Start Date:</label>
                    <input type="date" name="season_start_date" id="season_start_date" required></p>

                    <p><label for="season_end_date">End Date:</label>
                    <input type="date" name="season_end_date" id="season_end_date" required></p>

                    <p><button type="submit">Create Season</button></p>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
