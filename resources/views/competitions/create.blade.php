@extends('layouts.app')

@section('content')
    <div class="container">
        <h1>Add new comp {{ $season_id }}</h1>

        <h2>Add New Competition</h2>
        <form method="post" action="{{ route('competitions.store') }}">
            @csrf
            <label for="season_id">Competition Name:</label>
            <input type="hidden" name="season_id" value="{{ $season_id }}">
            <input type="hidden" name="comp_winner" value="x">
            <input type="hidden" name="season_id" value="{{ $season_id }}">



            <label for="competitions_name">Competition Name:</label>
            <input type="text" name="competitions_name" required>

            <label for="new_comp_winner">Winner:</label>
            <input type="text" name="new_comp_winner" >

            <label for="new_comp_second">Runner Up:</label>
            <input type="text" name="new_comp_second" >

            <button type="submit">Add Competition</button>
        </form>


    </div>
@endsection
