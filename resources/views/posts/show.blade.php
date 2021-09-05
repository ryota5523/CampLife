@extends('layouts.app')
@section('content')
<div class="container">
  <div class="post">
    <div class="row">
      @if(empty($post->filename))
        <img src="{{ asset('images/no_image.png') }}">
      @else
        <img src="{{ asset('storage/posts/' . $post->filename) }}"> 
      @endif
    </div>
    <div class="row">
      <h2 class="font-weight-bold">{{ $post->title }}</h2>
    </div>
    <div class="row post-content">
      <div>
        <h6>{{ $post->name }}</h6>
        <span>{{ $post->created_at }}</span>
      </div>
      @if($post->id === Auth::id())
      <div class="ml-auto">
        <a href="{{ route('edit', ['id' => $post->post_id ]) }}" class="btn btn-outline-success">編集</a>
      </div>
      @endif
    </div>
    <div class="row article-body">
      <p>{!! nl2br(e($post->body)) !!}</p>
    </div>
  </div>
</div>
@endsection