@extends('layouts.public')

@section('public-content')
  <div class="position-relative">
    {{-- Background image (if set) --}}
    @if($page->background)
      <div 
        class="w-100" 
        style="height:300px;
               background:url({{ asset('storage/'.$page->background) }}) center/cover no-repeat">
      </div>
    @else
      <div class="bg-light" style="height:300px;"></div>
    @endif

    {{-- Profile avatar --}}
    <div class="container text-center">
      <img 
        src="{{ $page->profile_pic 
                ? asset('storage/'.$page->profile_pic) 
                : asset('images/default-avatar.png') }}"
        class="rounded-circle border border-white"
        style="width:120px; margin-top:-60px;"
      >
    </div>
  </div>

  {{-- Username & Bio --}}
  <div class="container text-center mt-3">
    <h2 class="fw-bold">{{ $page->username }}</h2>
    @if($page->bio)
      <p class="text-muted">{{ $page->bio }}</p>
    @endif
  </div>

  {{-- Links list --}}
  <div class="container my-4">
    @foreach($page->links as $link)
      <a 
        href="{{ $link->url }}" 
        target="_blank"
        class="d-block btn btn-outline-success mb-2"
      >
        @if($link->icon)
          <i class="{{ $link->icon }} me-1"></i>
        @endif
        {{ $link->title }}
      </a>
    @endforeach
  </div>
@endsection
