@extends('layouts.app')
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
  <form action="{{ url('/users/update', ['id' => $user->id])  }}" enctype="multipart/form-data" method="post">
    @csrf
    <div class="profile">
        <div class="new-icon"> 
          <div class="e-icon">
            <label for="icon">
              <div  class="add-icon">
                <img src="{{ asset('images/add_picture.png')}}" alt="">
              </div>
              @if(!empty($users->filename))
              <img src="{{ asset('images/user.png') }}" alt="">
              @else
              <img src="{{ asset('storage/users/' . $user->iconfile) }}" class="picture"> 
              @endif
            </label>
            <input type="file" name='image' id="icon" type=“file” accept="image/png,image/jpeg,image/jpg" style="display: none;">
            <input type="submit" class="btn btn-success" value="保存">
          </div>           
        </div>
      <div class="e-nickName">
        <input placeholder="名前" type="text" name="nickName" class="form-control" value="{{ $user->nickName }}">
      </div>
      <div class="e-bio">
        <textarea placeholder="自己紹介文" type="text" name="bio" class="form-control">{{ $user->bio }}</textarea>
      </div>
    </div>
  </form>
</div>
  
  
@endsection
  