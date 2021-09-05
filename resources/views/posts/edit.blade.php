@extends('layouts.app')
@section('content')
<div class="container">
  <div class="row justify-content-center">
    <div class="col-md-8">
    <form action="{{ route('update', ['id' => $post->id])  }}" method="post" enctype="multipart/form-data">
      @csrf
      <textarea type="text" placeholder="タイトル" name="title" class="post-title">{{ $post->title }}</textarea>
      <textarea class="post-body" name="body" placeholder="本文" cols="30">{{ $post->body }}</textarea>
      <div class="form-group">
        <input type="file" class="form-control-file" name='image' id="image" <input type=“file” accept="image/png,image/jpeg,image/jpg">
      </div>
      <input type="submit" class="btn btn-success" value="更新する">
    </div>
  </div>
</div>
    
@endsection
