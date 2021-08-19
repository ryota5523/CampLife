@extends('layouts.app')
@section('content')
<form action="{{ route('update', ['id' => $post->id])  }}" method="post" >
<div class="container">
@csrf
  <input type="text" placeholder="タイトル" name="title" class="form-control" value="{{ $post->title }}">
  <textarea class="form-control form-body" name="body" placeholder="本文" cols="30" style="height: 1000px;">{{ $post->body }}</textarea>
  <input type="submit" class="btn btn-success" value="更新する">
</div>
@endsection
