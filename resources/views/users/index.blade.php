@extends('layouts.app')
@section('content')

<div class="container">
  <div class="row justify-content-center">

    <table class="table card-body">
      <thead>
        <tr>
          <th scope="col">Id</th>
          <th scope="col">Name</th>
          <th scope="col">E-mail</th>
          <th scope="col">Created_at</th>
        </tr>
      </thead>
      @foreach ($users as $user)
      <tbody>
        <tr>
          <th scope="row">{{ $user->id }}</th>
          <td>{{ $user->name }}</td>
          <td>{{ $user->email }}</td>
          <td>{{ $user->created_at }}</td>
        </tr>
      </tbody>
      @endforeach
    </table>
    <div class="text-center">
      {{ $users->links() }}
    </div>
  </div>
  </div>
  
  @endsection
  