@extends('layouts.app')
@section('content')
<div class="container py-4">
  <div class="user-header">
    <div class="user-icon">
      @if(empty($user->iconfile))
      <img src="{{ asset('images/user.png') }}" alt="">
      @else
      <img src="{{ Storage::disk('s3')->url('users/'. $post->iconfile) }}" class="picture"> 
      @endif
      @if($user->id === Auth::id())
      <div class="profile-edit">
        <a href="{{ url('/users/edit',$user->id) }}" class="btn-outline-success btn">変更</a>
      </div>
      @endif
    </div>
  </div>
  <div class="profile">
    <div class="nickname">
      @if(empty($user->nickName))
      <p>{{ $user->name }}</p>
      @else
      <p>{{ $user->nickName }}</p>
      @endif
    </div>
    <div class="bio">
      <p>{{ $user->bio }}</p>
    </div>
  </div>
  <div class="posts">
    <div class="card-deck d-row card-columns justify-content-between ">
      @foreach ($posts as $post)
        <div class="article">
          <a href="{{ url('/show', $post->id)}}" class="text-decoration-none">
            <div class="thumbnail">
                @if(empty($post->filename))
                <img src="{{ asset('images/no_image.png') }}">
                @else
                <img src="{{ Storage::disk('s3')->url('users/'. $post->iconfile) }}"> 
                @endif                        
            </div>
            <div class="text-dark article-body">
              <h5 class="card-title">{{ $post->title }}</h5>
              <h6 class="card-text text-muted">{{ $post->body }}</h6>
              <div class="user-info">
                @if(empty($user->iconfile))
                <img class="avatar" src="{{ asset('images/user.png') }}">
                @else
                <img class="avatar" src="{{ asset('storage/users/' . $user->iconfile) }}">
                @endif
                <div class="user-header_content">
                  <p><small>
                    @if(empty($user->nickName))
                    {{ $user->name }}
                    @else
                    {{ $user->nickName}}
                    @endif
                  </small></p>
                  <p><small>{{ Carbon\Carbon::parse($post->created_at)->diffForHumans() }}</small></p>
                </div>
              </div>
            </div>
          </a>
        </div>
      @endforeach
    </div>
  </div>
  </div>
  
  
@endsection
  