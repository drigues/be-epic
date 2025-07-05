@extends('layouts.app')

@section('content')
<div class="container py-5">
  <h2>Welcome back, {{ Auth::user()->name }}!</h2>

  <div class="row">
    <!-- Page Card -->
    <div class="col-md-6 mb-4">
      <div class="card shadow-sm">
        <div class="card-body">
          <h5 class="card-title">Your Page</h5>
          @if(Auth::user()->page)
            <p>URL: 
              <a href="{{ url(Auth::user()->page->username) }}" target="_blank">
                {{ url(Auth::user()->page->username) }}
              </a>
            </p>
            <a href="{{ route('pages.edit', Auth::user()->page) }}"
               class="btn btn-primary">Edit Page</a>
          @else
            <p>You haven’t created your page yet.</p>
            <a href="{{ route('pages.create') }}"
               class="btn btn-success">Create Page</a>
          @endif
        </div>
      </div>
    </div>

    <!-- Links Card -->
    <div class="col-md-6 mb-4">
      <div class="card shadow-sm">
        <div class="card-body">
          <h5 class="card-title">Your Links</h5>
          <p>Manage the links on your page.</p>

          {{-- ONLY show this if the user actually has a page --}}
          @if(Auth::user()->page)
            <a href="{{ route('pages.links.index', Auth::user()->page) }}"
               class="btn btn-primary">Manage Links</a>
          @else
            <p class="text-muted">Create your page first to add links.</p>
          @endif

        </div>
      </div>
    </div>
  </div>
</div>
@endsection
