@extends('layouts.app')
@section('title', 'Logged in')

@section('content')

<h1 style="padding-top:10px"><strong>the Viking Pool League</strong></h1>
<p>A blackball pool league for Pocklington, Market Weighton and surrounding villages.</p>

<div class="row" data-masonry='{"percentPosition": true }'>

    <div class="col-lg-4 mb-2">
        <div class="card shadow p-30 mb-4 bg-white rounded">
            <div class="card-header d-flex justify-content-between align-items-center">Status</div>
            <div class="card-body"><p>Welcome {{ Auth::user()->name }}.</p><p>Log in status will go here, including role details</p>
                @if (session('status'))
                <div class="alert alert-success" role="alert">
                    {{ session('status') }}
                </div>
                @endif
                </div>
        </div>
    </div>

    <div class="col-lg-4 mb-2">
        <div class="card shadow p-30 mb-4 bg-white rounded">
            <div class="card-header d-flex justify-content-between align-items-center">Navigation</div>
            <div class="card-body">
                <p>Quick links to the site:</p>
                <p><a href="{{ url('/') }}">Home</a></p>
                <p><a href="/seasons/1">This Season</a></p>
                <p><a href="{{ route('seasons.index') }}">All Seasons</a></p>

            </div>
        </div>
    </div>

    <div class="col-lg-4 mb-2">
        <div class="card shadow p-30 mb-4 bg-white rounded">
            <div class="card-header card-header-admin d-flex justify-content-between align-items-center">Admin</div>
            <div class="card-body card-body-admin">
                <p>Admin roles (if any assigned)</p>
                @can('view team')
                
                <p><a href="">View Teams</a><br>
                <a href="">View Players</a></p>

                @endcan

                @can('view role')
                <p> <a href="/users">Manage Users</a></p>
                @endcan
            </div>
        </div>
    </div>
</div>


@endsection
