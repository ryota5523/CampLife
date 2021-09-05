@extends('layouts.app')
@section('content')

        <main class="py-4">
          <div class="container">
            <div class="posts row">
              <div class="card-deck d-row card-columns">
                @foreach ($posts as $post)
                <div class="">
                  <div class="article">
                    <a href="{{ route('show', ['id' => $post->post_id ]) }}" class="text-decoration-none">
                      <div class="thumbnail">
                          @if(empty($post->filename))
                          <img src="{{ asset('images/no_image.png') }}">
                          @else
                          <img src="{{ asset('storage/posts/' . $post->filename) }}"> 
                          @endif                        
                      </div>
                      <div class="text-dark article-body">
                        <h5 class="card-title font-weight-bold article-title">{{ Str::limit($post->title, 49) }}</h5>
                        <h6 class="card-text text-muted">{{ Str::limit($post->body, 83, '...') }}</h6>
                        <p class="card-text align-items-end"><small class="text-muted">{{ $post->name }}</small></p>
                      </div>
                    </a>
                  </div>
                </div>
                @endforeach
              </div>
              {{ $posts->links() }}
              </div>
            </div>
          </div>
        </main>
      </div>
</body>
</html>
@endsection