@extends('layouts.app')
@section('content')
<div class="container w-50">
  <div class="sumnail row">
    @if(empty($post->filename))
      <img src="{{ asset('images/no_image.png') }}" class="w-100">
    @else
      <img src="{{ asset('storage/posts/' . $post->filename) }}" class="w-100"> 
    @endif
  </div>
  <div class="row">
    <h2 class="font-weight-bold">{{ $post->title }}</h2>
  </div>
  <div class="row">
    <h6>{{ $post->name }}</h6>
  </div>
  <div class="row">
    <p>{!! nl2br(e($post->body)) !!}</p>
  </div>
</div>
@endsection