@extends('layouts.app')

@section('content')
    <div class="container">
        <h1>Add new Competition</h1>
        <h2>Words in here</h2>
        <form method="post" action="{{ route('competitions.store') }}">
            @csrf
            <input type="hidden" name="season_id" value="{{ $season_id }}">



            <label for="competitions_name">Competition Name:</label>
            <input type="text" name="competitions_name" required>

            <label for="comp_winner">Winner:</label>
            <input type="text" name="comp_winner" >

            <label for="comp_second">Runner Up:</label>
            <input type="text" name="comp_second" >

            <button type="submit">Add Competition</button>
        </form>


    </div>
@endsection
