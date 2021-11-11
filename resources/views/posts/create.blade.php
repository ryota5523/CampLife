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
              <a data-micromodal-trigger="modal-1" href='javascript:;'>
                <div class="bg-picture">
                  <img src="{{ asset("images/add_picture.png") }}" alt="add" class="post-sumple add-picture" >
                </div>
              </a>
            </div>
            <h1>
              <textarea type="text" placeholder="タイトル" name="title"></textarea>
            </h1>
            <p>
              <textarea name="body" placeholder="本文" cols="30"></textarea>
            </p>
            <div class="modal micromodal-slide" id="modal-1" aria-hidden="true">
              <div class="modal__overlay" tabindex="-1" data-micromodal-close>
                <div class="modal__container" role="dialog" aria-modal="true" aria-labelledby="modal-1-title">
                  <header class="modal__header">
                    <h2 class="modal__title" id="modal-1-title">
                      画像を選択してください
                    </h2>
                    <button type="button" class="modal__close" aria-label="Close modal" data-micromodal-close></button>
                  </header>
                  <main class="modal__content" id="modal-1-content">
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
    
