@extends('layouts.app3')
@section('content')
<div class="container py-4">
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
      <form action="{{ route('update', ['id' => $post->id])  }}" method="post" enctype="multipart/form-data" class="post" id ="release-btn">
        @csrf
        <div class="form-group">
          <label for="image1">
            <div class="">
              <div>
                @if(empty($post->filename))
                <img src="{{ asset('images/no_image.png') }}" alt="add" class="post-sumple"">
                @else
                <img src="{{ asset('storage/posts/' . $post->filename) }}" class="picture"> 
                @endif
                <input type="file" class="form-control-file" name='image' id="image1" type=“file” accept="image/png,image/jpeg,image/jpg" style="display: none;">
              </div>
            </div>
          </label>
            <h1>
              <textarea type="text" placeholder="タイトル" name="title">{{ $post->title }}</textarea>
            </h1>
            <p>
              <textarea type="text" name="body" placeholder="本文">{{ $post->body }}</textarea>
            </p>
        </div>
      </form>
    </div>
  </div>
</div>
    
@endsection
