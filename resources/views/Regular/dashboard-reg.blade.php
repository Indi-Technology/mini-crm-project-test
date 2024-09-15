@extends('regular.layouts.main')

@section('content-regular')
  <div class="container-xxl flex-grow-1 container-p-y">
  <div class="row">
    
    <div class="container">
      <h1>Hello, {{ Auth::user()->name }}!</h1>
  </div>

  </div>
  </div>
@endsection