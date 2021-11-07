<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}" defer></script>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">

    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <link href="{{ asset('css/style.css') }}" rel="stylesheet">
</head>
<body>
  <div id="app">
    <header>
      <nav class="navbar navbar-expand-md navbar-light bg-white shadow-sm justify-content-around">
        <div class="container">
                <a class="navbar-brand header-logo" href="{{ url('/') }}">
                  <img src="{{ asset("images/logo.png") }}" alt="logo">
                </a>
                <div class="header-btn">
                  <button form="release-btn" class="btn btn-success">公開する</button>
                </div>
        </div>
      </nav>
    </header>
  </div>
  <main>
        @if (session('flash_message'))
            <div class="flash_message bg-success text-center py-3 my-0 text-white">
                {{ session('flash_message') }}
            </div>
        @endif
            @yield('content')
        </main>
    </div>
</body>
</html>