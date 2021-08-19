@extends('layouts.app')
@section('content')

        <main class="py-4">
          <div class="container">
            <div class="row justify-content-center">
              <div class="card-deck d-row card-columns">
                @foreach ($posts as $post)
                <div class="">
                  <div class="col-3">
                    <a href="{{ route('show', ['id' => $post->post_id ]) }}" class="text-decoration-none">
                      <div class="card" style="width: 18rem; margin-bottom: 2rem;">                        
                          @if(empty($post->filename))
                          <img src="{{ asset('images/no_image.png') }}" class="card-img-top" style="height: 150px;">
                          @else
                          <img src="{{ asset('storage/posts/' . $post->filename) }}" class="card-img-top" style="height: 150px;"> 
                          @endif
                        <div class="card-body text-dark" style="height: 150px;">
                          <h5 class="card-title font-weight-bold">{{ Str::limit($post->title, 49) }}</h5>
                          <h6 class="card-text text-muted">{{ Str::limit($post->body, 64, '...') }}</h6>
                          <p class="card-text align-items-end"><small class="text-muted">{{ $post->name }}</small></p>
                        </div>
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