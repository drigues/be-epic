@extends('layouts.guest')

{{-- Show a success or info message --}}
@if (session('status'))
  <div class="alert alert-success">
    {{ session('status') }}
  </div>
@endif

{{-- Show validation errors --}}
@if ($errors->any())
  <div class="alert alert-danger">
    <ul class="mb-0">
      @foreach ($errors->all() as $error)
        <li>{{ $error }}</li>
      @endforeach
    </ul>
  </div>
@endif


@section('content')
<div class="min-vh-100 d-flex align-items-center justify-content-center bg-brand-pink">
<div class="card rounded-3 shadow p-4" style="max-width: 400px; width: 100%;">
  <h2 class="h4 text-center fw-bold mb-4">Welcome Back 👋</h2>

  <form method="POST" action="{{ route('login') }}">
    @csrf

    <input 
      type="email" 
      name="email" 
      class="form-control form-control-lg mb-3" 
      placeholder="Email" 
      required autofocus
    >

    <input 
      type="password" 
      name="password" 
      class="form-control form-control-lg mb-4" 
      placeholder="Password" 
      required
    >

    <button class="btn btn-dark btn-lg rounded-pill w-100 mb-3">
      Login
    </button>
  </form>

  <div class="text-center small">
    Don’t have an account? 
    <a href="{{ route('register') }}">Sign Up</a>
  </div>
</div>
</main>
@endsection
