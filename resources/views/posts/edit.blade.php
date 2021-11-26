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
                <a data-micromodal-trigger="modal-2" href='javascript:;'>
                  @if(empty($post->filename))
                  <img src="{{ asset('images/no_image.png') }}" alt="add" class="post-sumple"">
                  @else
                  <img class="avatar" src="{{ Storage::disk('s3')->url('posts/'. $post->filename) }}" class="picture">
                  @endif
                </a>
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
        <div class="modal micromodal-slide" id="modal-2" aria-hidden="true">
          <div class="modal__overlay" tabindex="-1" data-micromodal-close>
            <div class="modal__container" role="dialog" aria-modal="true" aria-labelledby="modal-2-title">
              <header class="modal__header">
                <h2 class="modal__title" id="modal-2-title">
                  画像を選択してください
                </h2>
                <button type="button" class="modal__close" aria-label="Close modal" data-micromodal-close></button>
              </header>
              <main class="modal__content" id="modal-2-content">
                <input type="file" class="form-control-file" name='image' type=“file” accept="image/png,image/jpeg,image/jpg">
              </main>
              <footer class="modal__footer">
                <button type="button" class="modal__btn" data-micromodal-close aria-label="閉じる">閉じる</button>
              </footer>
            </div>
          </div>
        </div>
      </form>
    </div>
  </div>
</div>
    
@endsection
