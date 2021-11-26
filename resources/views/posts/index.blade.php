@extends('layouts.app')
@section('content')
  <div class="container">
            <div class="posts">
              <div class="card-deck d-row card-columns justify-justify-content-between">
                @foreach ($posts as $post)
                  <div class="article">
                    <a href="{{ route('show', ['id' => $post->post_id ]) }}" class="text-decoration-none">
                      <div class="thumbnail">
                          @if(empty($post->filename))
                          <img src="{{ asset('images/no_image.png') }}">
                          @else
                          <img src="{{ Storage::disk('s3')->url($post->filename) }}"> 
                          @endif                        
                      </div>
                      <div class="text-dark article-body">
                        <h5 class="card-title">{{ $post->title }}</h5>
                        <h6 class="card-text text-muted">{{ $post->body }}</h6>
                      </div>
                    </a>
                        <div class="post-content">
                          <div class="post-header">
                            <a class="user-link" href="{{ route('users', ['id' => $post->user_id]) }}">
                              @if(empty($post->iconfile))
                              <img class="avatar" src="{{ asset('images/user.png') }}">
                              @else
                              <img class="avatar" src="{{ asset($post->iconfile) }}">
                              @endif
                              <div class="post-info">
                                <h6>
                                  @if(empty($post->nickName))
                                  {{ $post->name }}
                                  @else
                                  {{ $post->nickName}}
                                  @endif
                                </h6>
                                <span>{{ Carbon\Carbon::parse($post->created_at)->diffForHumans() }}</span>
                              </div>
                            </a>
                          </div>
                        </div>
                  </div>
                @endforeach
              </div>
            </div>
            {{ $posts->links('vendor/pagination/pagination_view') }}
  </div>
</body>
</html>
@endsection