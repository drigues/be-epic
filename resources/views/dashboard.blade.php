{{-- VIEWS/DASHBOARD.BLADE.PHP --}}

@extends('layouts.app')

@section('content')

  <div class="container">
    <h1 class="mb-4">Dashboard</h1>
    <h5 class="mb-4">Hi, {{ Auth::user()->name }}!</h5>

    @php
      $count = Auth::user()->pages()->count();
    @endphp

    @if($count === 0)
    <p class="text-muted">You have no Clinky pages yet, <a href="{{ route('pages.create') }}">create it now.</a></p>
    @else
      @foreach(Auth::user()->pages as $page)
        <div class="card shadow-sm mb-4 c">
          <div class="card-header">/ {{ $page->username }}</div>
          <div class="card-body d-flex flex-column flex-lg-row justify-content-lg-between align-items-lg-center">
            <div class="d-flex mb-3 mb-lg-0"><a href="{{ url($page->username) }}" target="_blank">{{ url($page->username) }}</a></div>
              <ul class="d-flex flex-row p-0 m-0">
                <li class="list-group-item"><a href="#" class="btn btn-sm btn-outline-secondary me-2">Copy</a></li>
                <li class="list-group-item"><a href="#" class="btn btn-sm btn-outline-secondary me-2">Share</a></li>
                <li class="list-group-item"><a href="{{ route('pages.edit', $page) }}" class="btn btn-sm btn-primary">Edit</a></li>
              </ul>
          </div>
        </div>
      @endforeach
    @endif
  </div>

@endsection