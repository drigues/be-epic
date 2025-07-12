{{-- PAGES/EDIT.BLADE.PHP --}}

@extends('layouts.app')

@section('content')
<div class="container">

  {{-- 1) Live Preview Header --}}
  <div class="card mb-5 overflow-hidden">
    {{-- background banner --}}
    <div
      class="w-100"
      style="
        height: 300px;
        background: url({{ $page->background
          ? asset('storage/' . $page->background)
          : asset('images/default-banner.jpg')
        }}) center/cover no-repeat;
      ">
    </div>

    <div class="card-body text-center position-relative">
      {{-- avatar overlapping --}}
      <img
        src="{{ $page->profile_pic
          ? asset('storage/' . $page->profile_pic)
          : asset('images/default-avatar.png')
        }}"
        class="rounded-circle border border-3 border-white position-absolute top-0 start-50 translate-middle"
        style="width:120px; height:120px; object-fit:cover;"
        alt="Avatar"
      />

      {{-- push title downward to clear avatar--}}
      <div class="mt-5 pt-4">
        <h2 class="fw-bold">{{ $page->username }}</h2>
        @if($page->bio)
          <p class="text-muted">{{ $page->bio }}</p>
        @endif
      </div>

      {{-- preview of links --}}
      <div class="d-grid gap-2 col-md-6 mx-auto mt-4">
        @foreach($page->links->sortBy('sort_order') as $link)
          <a
            href="{{ $link->url }}"
            target="_blank"
            class="btn btn-outline-success"
          >
            @if($link->icon)
              <i class="{{ $link->icon }} me-1"></i>
            @endif
            {{ $link->title }}
          </a>
        @endforeach
      </div>
    </div>
  </div>

  {{-- 2) Edit Page Form --}}
  <div class="card mb-5 shadow-sm">
    <div class="card-header">Edit Page Settings</div>
    <div class="card-body">
      <form
        method="POST"
        action="{{ route('pages.update', $page) }}"
        enctype="multipart/form-data"
      >
        @csrf @method('PUT')

        {{-- Username slug --}}
        <div class="mb-4">
          <label class="form-label">Directory Slug</label>
          <div class="input-group">
            <span class="input-group-text">clinky.cc/</span>
            <input
              type="text"
              name="username"
              class="form-control @error('username') is-invalid @enderror"
              value="{{ old('username', $page->username) }}"
              required
            >
            @error('username')
              <div class="invalid-feedback">{{ $message }}</div>
            @enderror
          </div>
        </div>

        {{-- Profile Picture --}}
        <div class="mb-4">
          <label class="form-label">Profile Picture</label>
          <input
            type="file"
            name="profile_pic"
            accept="image/png,image/jpeg"
            class="form-control @error('profile_pic') is-invalid @enderror"
          >
          <div class="form-text">JPG/PNG ≤2 MB, 250×250px recommended.</div>
          @error('profile_pic')
            <div class="invalid-feedback">{{ $message }}</div>
          @enderror
        </div>

        {{-- Background Image --}}
        <div class="mb-4">
          <label class="form-label">Background Image</label>
          <input
            type="file"
            name="background"
            accept="image/png,image/jpeg"
            class="form-control @error('background') is-invalid @enderror"
          >
          <div class="form-text">JPG/PNG ≤4 MB, ≥1200×600px recommended.</div>
          @error('background')
            <div class="invalid-feedback">{{ $message }}</div>
          @enderror
        </div>

        {{-- Bio --}}
        <div class="mb-4">
          <label class="form-label">Bio</label>
          <textarea
            name="bio"
            rows="3"
            class="form-control @error('bio') is-invalid @enderror"
          >{{ old('bio', $page->bio) }}</textarea>
          @error('bio')
            <div class="invalid-feedback">{{ $message }}</div>
          @enderror
        </div>

        <button type="submit" class="btn btn-primary">Save Changes</button>
      </form>
    </div>
  </div>

  {{-- 3) Manage Links --}}
  <div class="d-flex justify-content-between align-items-center mb-3">
    <h2 class="h4 mb-0">Manage Links</h2>
    <a
      href="{{ route('pages.links.create', $page) }}"
      class="btn btn-success"
    >
      + Add New Link
    </a>
  </div>

  <div id="vue-link-manager" class="mb-5">
    <link-manager
      :initial-links='@json($page->links->sortBy("sort_order")->values())'
      :page-id="{{ $page->id }}"
    ></link-manager>
  </div>
</div>
@endsection

@push('scripts')
  @vite('resources/js/app.js')
@endpush
