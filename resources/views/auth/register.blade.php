{{-- VIEWS/AUTH/REGISTER.BLADE.PHP --}}

@extends('layouts.auth')

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
  <div class="min-vh-100 d-flex align-items-center justify-content-center cbg-2">
    <div class="card rounded-3 shadow p-4" style="max-width: 400px; width: 100%;">
    <h2 class="h4 text-center fw-bold mb-4">Create Your Account</h2>

    <form method="POST" action="{{ route('register') }}">
      @csrf

      <div class="input-group mb-3">
      <span class="input-group-text">clinky.cc/</span>
      <input type="text" name="username" class="form-control form-control-lg" placeholder="yourname"
        value="{{ old('username', request('username')) }}" required>
      </div>

      <input type="email" name="email" class="form-control form-control-lg mb-3" placeholder="Email" required>

      <!-- Password -->
      <input id="password" type="password" name="password"
      class="form-control form-control-lg mb-3 @error('password') is-invalid @enderror" placeholder="Password"
      required />

      <!-- Password Confirmation -->
      <input id="password_confirmation" type="password" name="password_confirmation"
      class="form-control form-control-lg mb-3 @error('password_confirmation') is-invalid @enderror"
      placeholder="Confirm Password" required />

      <button class="btn btn-dark btn-lg rounded-pill w-100 mb-3 clinky-bg">
      Sign Up
      </button>
    </form>

    <div class="mb-4 text-center">
      <a href="{{ url('/auth/google') }}" class="btn btn-outline-dark w-100 mb-2 rounded-pill">
      <img src="{{ asset('images/search.png') }}" style="width:20px; margin-right:10px;"> Continue with Google
      </a>
      <a href="{{ url('/auth/facebook') }}" class="btn btn-outline-dark w-100 rounded-pill">
      <img src="{{ asset('images/facebook.png') }}" style="width:20px; margin-right:10px;"> Continue with Facebook
      </a>
    </div>


    <div class="text-center small">
      Already have an account?
      <a href="{{ route('login') }}">Login</a>
    </div>
    </div>
  </div>
@endsection