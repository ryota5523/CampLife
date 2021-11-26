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
              <a data-micromodal-trigger="modal-3" href='javascript:;'>
                <div  class="add-icon">
                  <img src="{{ asset('images/add_picture.png')}}" alt="">
                </div>
                @if(empty($user->iconfile))
                <img src="{{ asset('images/user.png') }}" alt="">
                @else
                <img src="{{ Storage::disk('s3')->url('users/'. $post->iconfile) }}" class="picture"> 
                @endif
              </label>
              </a>          
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
    <div class="modal micromodal-slide" id="modal-3" aria-hidden="true">
      <div class="modal__overlay" tabindex="-1" data-micromodal-close>
        <div class="modal__container" role="dialog" aria-modal="true" aria-labelledby="modal-3-title">
          <header class="modal__header">
            <h2 class="modal__title" id="modal-3-title">
              画像を選択してください
            </h2>
            <button type="button" class="modal__close" aria-label="Close modal" data-micromodal-close></button>
          </header>
          <main class="modal__content" id="modal-3-content">
            <input type="file" name='image' id="icon" type=“file” accept="image/png,image/jpeg,image/jpg">
          </main>
          <footer class="modal__footer">
            <button type="button" class="modal__btn" data-micromodal-close aria-label="閉じる">閉じる</button>
          </footer>
        </div>
      </div>
    </div>
  </form>
</div>
  
  
@endsection
  