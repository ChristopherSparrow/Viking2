<nav class="navbar navbar-dark bg-viking ">
    <div class="container-fluid ">
        <a class="navbar-brand"  href="{{ url('/') }}"><img src={{ asset('images/logo.png') }} width="40" height="40" class="d-inline-block align-center" alt="Viking Pool League Icon">&nbsp; Viking Pool League</a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarCollapse" aria-controls="navbarCollapse" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
          </button>


        <div class="collapse navbar-collapse" id="navbarCollapse">
        

            <!-- Right Side Of Navbar -->
            <ul class="navbar-nav ms-auto">
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('seasons.show', ['seasonId' => 1]) }}">Current Season (Winter 2023/2024)</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link"  href="{{ route('seasons.index') }}">All Seasons</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link"  href="#">League Rules</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link"  href="#">Download Scorecards</a>
                </li>


                
                
               

                <!-- Authentication Links -->
                @guest
                    @if (Route::has('login'))
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('login') }}">{{ __('Login') }}</a>
                        </li>
                    @endif

                    @if (Route::has('register'))
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('register') }}">{{ __('Register') }}</a>
                        </li>
                    @endif
                @else
                <li class="nav-item">
                    <a class="nav-link" href="users/">ADMIN</a>
                </li>

                    <li class="nav-item dropdown">
                        <a id="navbarloggedin" class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                            {{ Auth::user()->name }}
                        </a>

                        <div class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarloggedin">
                            <a class="dropdown-item" href="{{ route('home') }}">Dashboard
                            </a>
                            <a class="dropdown-item" href="{{ route('logout') }}"
                               onclick="event.preventDefault();
                                             document.getElementById('logout-form').submit();">
                                {{ __('Logout') }}
                            </a>

                            <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                @csrf
                            </form>
                        </div>
                    </li>
                @endguest
            </ul>
        </div>
    </div>
</nav>