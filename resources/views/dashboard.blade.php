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
          <div class="card-body flex flex-column align-items-center">
            <div><a href="{{ url($page->username) }}" target="_blank">{{ url($page->username) }}</a></div>
            <div>
              <a href="{{ route('pages.edit', $page) }}" class="btn btn-sm btn-outline-secondary">Copy</a>
              <a href="{{ route('pages.edit', $page) }}" class="btn btn-sm btn-outline-secondary">Share</a>
              <a href="{{ route('pages.edit', $page) }}" class="btn btn-sm btn-primary me-2">Edit</a></div>
          </div>
        </div>
      @endforeach
    @endif
  </div>

@endsection