{{-- VIEW/LANDING.BLADE.PHP --}}

@extends('layouts.guest')

@section('content')
  {{-- HERO --}}

  <section class="py-5 text-center" style="background: linear-gradient(45deg, #ffe6f0 0%, #e6eaff 100%);">
    <div class="container py-5">
      <h1 class="display-3 fw-bold">A Link in Bio made for you!</h1>
      <p class="lead text-dark">
        Be one of the early-birds and claim your 
        <code>clinky.cc/{yourURL}</code> before anyone else.
      </p>

      <form action="{{ route('register') }}" method="get" 
            class="row g-2 justify-content-center mt-4">
        <div class="col-auto input-group" style="max-width: 400px;">
          <span class="input-group-text">clinky.cc/</span>
          <input name="username" type="text" class="form-control" 
                 placeholder="yourname" required>
          <button class="btn text-light clinky-bg fs-5">Claim Now</button>
        </div>
      </form>
    </div>
  </section>

  {{-- FEATURE #1 --}}
  <section class="py-5" style="background-color: #f9cde1;">
    <div class="container">
      <div class="row align-items-center">
        
        <div class="col-md-6 text-center">
          <img src="{{ asset('images/bg.jpg') }}" 
               alt="Tasks organized" class="img-fluid rounded shadow-sm">
        </div>
        <div class="col-md-6 p-5">
          <h2 class="display-5 fw-bold">All your tasks organized</h2>
          <p class="lead text-dark">
            Effortlessly manage tasks, collaborate with teams, 
            and meet deadlines with precision and clarity.
          </p>
          <a href="{{ route('register') }}" class="btn btn-dark rounded-pill">Get Start Free</a>
        </div>
      </div>
    </div>
  </section>

  {{-- FEATURE #2 --}}
  <section class="py-5" style="background-color: #e3daff;">
    <div class="container">
      <div class="row align-items-center">
        <div class="col-md-6 text-center order-md-2">
          <img src="{{ asset('images/couple-clinky.png') }}" 
               alt="Sharing" class="img-fluid rounded shadow-sm">
        </div>
        <div class="col-md-6 order-md-1 p-5">
          <h2 class="display-5 fw-bold">Everything you are. In one, simple link in bio.</h2>
          <p class="lead text-dark">
            Organize your identity, promote your business, 
            and stay connected with your community—all in one place.
          </p>
          <a href="{{ route('register') }}" class="btn btn-dark rounded-pill">Get Start Free</a>
        </div>
      </div>
    </div>
  </section>

  {{-- CTA --}}
  <section class="py-5 my-5 text-center">
    <div class="container">
      <h2 class="fw-bold">
        Claim your Link in Bio <span class="">NOW!</span>
      </h2>
      <p class="text-dark mb-4">
        Start your free trial now to experience seamless project 
        management without any commitment!
      </p>

      <form action="{{ route('register') }}" method="get" 
            class="row g-2 justify-content-center">
        <div class="col-auto input-group" style="max-width: 400px;">
          <span class="input-group-text">clinky.cc/</span>
          <input name="username" type="text" class="form-control" 
                 placeholder="yourname" required>
          <button class="btn text-light clinky-bg fs-5">Claim</button>
        </div>
      </form>
    </div>
  </section>
@endsection
