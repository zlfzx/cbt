@extends('layouts.global')

@section('title', 'Home')

@section('content')
    <div class="card">
      <div class="card-header">
        <h4 class="card-title">Title</h4>
      </div>
      <div class="card-body">
        <h1>Body</h1>
        @if (session('status'))
          <div class="alert alert-success" role="alert">
            {{ session('status') }}
          </div>
        @endif
      </div>
    </div>
@endsection