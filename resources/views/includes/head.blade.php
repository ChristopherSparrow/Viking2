    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }} Pool League</title>
    @vite(['resources/sass/app.scss', 'resources/js/app.js'])

    <link href="{{ asset('css/viking.css') }}" rel="stylesheet" >
