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
    <!-- Cropper -->
    <link rel="stylesheet" href="{{ asset('css/cropper.css') }}" />
    <script src="cropper.js"></script>
    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <link href="{{ asset('css/style.css') }}" rel="stylesheet">
    <!-- favicon -->
    <link rel="shortcut icon" href="{{ asset('images/favicon.png') }}">
</head>
<body>
    <div id="app">
        <header>
          <nav class="navbar navbar-expand-md navbar-light bg-white shadow-sm">
            <div class="container">
                <a class="navbar-brand header-logo" href="{{ url('/') }}">
                  <img src="{{ asset('images/logo.png') }}" alt="logo">
                </a>
                <div class="header-right">
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
                        @if(empty(auth()->user()->iconfile))
                          <a id="navbarDropdown" class="" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                            <svg xmlns="http://www.w3.org/2000/svg" fill="currentColor" class="bi bi-person-circle icon" viewBox="0 0 16 16">
                              <path d="M11 6a3 3 0 1 1-6 0 3 3 0 0 1 6 0z"/>
                              <path fill-rule="evenodd" d="M0 8a8 8 0 1 1 16 0A8 8 0 0 1 0 8zm8-7a7 7 0 0 0-5.468 11.37C3.242 11.226 4.805 10 8 10s4.757 1.225 5.468 2.37A7 7 0 0 0 8 1z"/>
                            </svg>
                          </a>
                        @else
                          <a id="navbarDropdown" class="header-icon" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                          <img src="{{ Storage::disk('s3')->url('users/'. auth()->user()->iconfile) }}">
                          </a>
                        @endif

                          <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                            <a class="dropdown-item" href="{{ url(auth()->user()->id) }}"
                                document.getElementById('mypage').submit();">
                                {{ __('マイページ') }}
                            </a>
                            <a class="dropdown-item" href="{{ url('') }}"
                                document.getElementById('posts').submit();">
                                {{ __('記事') }}
                            </a>
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
                <div class="hamburger-menu">
                    <input type="checkbox" id="menu-btn-check">
                    <label for="menu-btn-check" class="menu-btn"><span></span></label>
                    <div class="menu-content">
                      <ul>
                        <!-- Authentication Links -->
                        @guest
                          <li>
                            <a class="dropdown-item" href="{{ route('login') }}">{{ __('Login') }}</a>
                          </li>
                        @if (Route::has('register'))
                          <li>
                            <a class="dropdown-item" href="{{ route('register') }}">{{ __('Register') }}</a>
                          </li>
                        @endif
                          
                        @else
                          <li>
                              <a class="dropdown-item" href="{{ url(auth()->user()->id) }} }}"
                                  document.getElementById('mypage').submit();">
                                  {{ __('マイページ') }}
                              </a>
                          </li>
                          <li>
                              <a class="dropdown-item" href="{{ url('') }}"
                                  document.getElementById('posts').submit();">
                                  {{ __('記事') }}
                              </a>
                          </li>
                          <li>
                            <a class="dropdown-item" href="{{ route('create') }}">投稿</a>
                          </li>
                          <li>
                              <a class="dropdown-item" href="{{ route('logout') }}"
                                  onclick="event.preventDefault();
                                  document.getElementById('logout-form').submit();">
                                  {{ __('Logout') }}
                              </a>
                          </li>
                              <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                              @csrf
                              </form>
                            </li>
                            @endguest
                          </ul>
                        </div>
                  </div>
                </div>
            </div>
          </nav>
          <!-- <nav class="navbar navbar-expand-md navbar-light bg-white shadow-sm">
            <div class="container">
              <ul class="navbar-nav flex-row flex-wrap bd-navbar-nav py-md-0">
                <li class="nav-item pr-2">
                  <a href="{{url('/')}}" class="active nav-link border-bottom border-dark">ホーム</a>
                </li>
                <li class="nav-item pr-2">
                    <a href="{{route('index')}}" class="nav-link">人気記事</a>
                </li>
              </ul>
            </div>
          </nav> -->
        </header>

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
