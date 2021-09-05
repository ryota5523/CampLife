@extends('layouts.app')
@section('content')

<div class="container">
  <span>名前</span>
  <p>{{ $user->name }}</p>
  <button class=""></button>
  <span>メールアドレス</span>
  <p>{{ $user->email }}</p>
</div>
  
@endsection
  