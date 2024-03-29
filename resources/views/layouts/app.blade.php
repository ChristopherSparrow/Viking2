<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

    <head>
    @include('includes.head')
    </head>

    <body>
        <div class="container"> 
        <header class="row">
            @include('includes.header')
        </header>
        <div id="main" >
            @yield('content')
        </div>
        <footer class="row">
            @include('includes.footer')
        </footer>
     </div>

</body>

</html>