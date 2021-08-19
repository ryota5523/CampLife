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
</head>
<body>
    <div id="app">
        <header>
          <nav class="navbar navbar-expand-md navbar-light bg-white shadow-sm">
            <div class="container">
                <a class="navbar-brand" href="{{ url('/') }}">
                  <img src="{{ asset("images/logo.png") }}" alt="logo" class="w-75">
                </a>
                <div class="">
                    <!-- Right Side Of Navbar -->
                    <ul class="navbar-nav flex-row">
                      <li class="nav-item">
                        <form method="get" action="{{ route('index') }}" class="d-flex">
                          <input class="form-control me-2" type="search" placeholder="Search" aria-label="Search" name="search" style="width: 100px">
                          <button class="btn btn-outline-success p-1" type="submit" style="width: 50px;">検索</button>
                        </form>
                      </li>
                      <!-- Authentication Links -->
                      @guest
                        <li class="nav-item">
                          <a class="nav-link p-2" href="{{ route('login') }}">{{ __('Login') }}</a>
                        </li>
                      @if (Route::has('register'))
                        <li class="nav-item">
                          <a class="nav-link p-2" href="{{ route('register') }}">{{ __('Register') }}</a>
                        </li>
                      @endif
                        
                      @else
                        <li class="nav-item dropdown pl-2">
                          <a id="navbarDropdown" class="nav-link" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                            <svg xmlns="http://www.w3.org/2000/svg" width="32" height="32" fill="currentColor" class="bi bi-person-circle" viewBox="0 0 16 16">
                              <path d="M11 6a3 3 0 1 1-6 0 3 3 0 0 1 6 0z"/>
                              <path fill-rule="evenodd" d="M0 8a8 8 0 1 1 16 0A8 8 0 0 1 0 8zm8-7a7 7 0 0 0-5.468 11.37C3.242 11.226 4.805 10 8 10s4.757 1.225 5.468 2.37A7 7 0 0 0 8 1z"/>
                            </svg>
                          </a>

                          <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                            <a class="dropdown-item" href="{{ route('logout') }}"
                                onclick="event.preventDefault();
                                document.getElementById('logout-form').submit();">
                                {{ __('Logout') }}
                            </a>
                            <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                            @csrf
                            </form>
                          </div>
                        </li>
                        <li class="nav-item pl-2">
                          <a href="{{ route('create') }}" class="btn btn-success">投稿</a>
                        </li>
                        @endguest
                    </ul>
                </div>
            </div>
          </nav>
          <nav class="navbar navbar-expand-md navbar-light bg-white shadow-sm">
            <div class="container">
              <ul class="navbar-nav flex-row flex-wrap bd-navbar-nav py-md-0">
                <li class="nav-item pr-2">
                  <a href="{{url('/')}}" class="active nav-link border-bottom border-dark">ホーム</a>
                </li>
                <li class="nav-item pr-2">
                    <a href="{{route('index')}}" class="nav-link">人気記事</a>
                </li>
                <li class="nav-item">
                  <a href="{{url('/')}}" class="nav-link">人気タグ</a>
                </li>
              </ul>
            </div>
          </nav>
        </header>

        <main class="py-4">
          
            @yield('content')
        </main>
    </div>
</body>
</html>
