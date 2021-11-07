@extends('layouts.app2')
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
          <form action="{{ route('store') }}" method="post" enctype="multipart/form-data" class="post" id="send-btn">
            @csrf
            <div class="form-group">
              <label for="image1">
                <div class="bg-picture">
                  <img src="{{ asset("images/add_picture.png") }}" alt="add" class="post-sumple add-picture">
                </div>
                <input type="file" class="form-control-file" name='image' id="image1" type=“file” accept="image/png,image/jpeg,image/jpg" style="display: none;">
              </label>
            </div>
            <h1>
              <textarea type="text" placeholder="タイトル" name="title"></textarea>
            </h1>
            <p>
              <textarea name="body" placeholder="本文" cols="30"></textarea>
            </p>
          </form>
        </div>
      </div>
    </div>
  @endsection


