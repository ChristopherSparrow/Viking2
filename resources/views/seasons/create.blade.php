@extends('layouts.app')

@section('content')
    <div class="container">
        <h1>Create a New Season</h1>

        <form method="post" action="{{ route('seasons.store') }}">
            @csrf

            <label for="season_name">Season Name:</label>
            <input type="text" name="season_name" id="season_name" required>

            <label for="season_start_date">Start Date:</label>
            <input type="date" name="season_start_date" id="season_start_date" required>

            <label for="season_end_date">End Date:</label>
            <input type="date" name="season_end_date" id="season_end_date" required>

            <button type="submit">Create Season</button>
        </form>
    </div>
@endsection
