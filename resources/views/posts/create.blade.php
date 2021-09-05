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
      <nav class="navbar navbar-expand-md navbar-light bg-white shadow-sm">
        <div class="container">
                <a class="navbar-brand" href="{{ url('/') }}">
                  <img src="{{ asset("images/logo.png") }}" alt="logo" class="w-75">
                </a>
        </div>
      </nav>
    </header>
  </div>

  @section('content')
  <main class="py-4">
    <div class="container">
    @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif
      <div class="row justify-content-center">
        <div class="col-md-8">
          <form action="{{ route('store') }}" method="post" enctype="multipart/form-data" class="create">
            @csrf
            <textarea type="text" placeholder="タイトル" name="title" class="post-title"></textarea>
            <textarea class="post-body" name="body" placeholder="本文" cols="30"></textarea>
            <div class="form-group">
              <input type="file" class="form-control-file" name='image' id="image" <input type=“file” accept="image/png,image/jpeg,image/jpg">
            </div>
            <input type="submit" class="btn btn-success" value="投稿する">
          </form>
        </div>
      </div>
    </div>
  @endsection
  @yield('content')
  </main>
</body>
</html>

