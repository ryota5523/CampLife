@extends('layouts.app')
@section('content')
  <div class="show-post">
    <div class="p-thum">
      @if(!empty($post->filename))
      <img class="avatar" src="{{ Storage::disk('s3')->url('posts/' . $post->filename) }}">

      @endif
    </div>
    <div class="p-title">
      <h2>{{ $post->title }}</h2>
    </div>
    <div class="p-content">
      <div class="p-header">
        @if(empty($post->iconfile))
        <img src="{{ asset('images/user.png') }}">
        @else
        <img src="{{ Storage::disk('s3')->url('users/'. $post->iconfile) }}">
        @endif
        <div class="p-info">
          <h6>
            @if(empty($post->nickName))
            {{ $post->name }}
            @else
            {{ $post->nickName}}
            @endif
          </h6>
          <span>{{ $time }}</span>
        </div>
        @if($post->id === Auth::id())
        <div class="p-edit">
          <form action="{{ route('destroy', ['id' => $post->post_id])  }}" method="post" class="delete-btn" id="delete_{‌{ $post->id }}">
            @csrf
            <a href="#" class="btn btn-danger btn-dell" data-id="{‌{ $post->id }}" onclick="deletePost(this);">削除</a>
          </form>
          <a href="{{ route('edit', ['id' => $post->post_id ]) }}" class="btn btn-outline-success">編集</a>
        </div>
        @endif
      </div>
    </div>
    <div class="p-body">
      <p>{!! nl2br(e($post->body)) !!}</p>
    </div>
  </div>

  <script>
  function deletePost(e){
      'use strict';
      if (confirm('本当に削除していいですか？')){
          document.getElementById('delete_' + e.dataset.id).submit();
      }
  }
  </script>
@endsection