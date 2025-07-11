{{-- PAGES/EDIT.BLADE.PHP --}}

@extends('layouts.app')

@section('content')
  <div class="container">

    {{-- Page title --}}
    <h1 class="mb-4">Page</h1>

    {{-- Flash status --}}
    @if(session('status'))
      <div class="alert alert-success">{{ session('status') }}</div>
    @endif

    {{-- Validation errors --}}
    @if($errors->any())
      <div class="alert alert-danger">
        <ul class="mb-0">
          @foreach($errors->all() as $err)
            <li>{{ $err }}</li>
          @endforeach
        </ul>
      </div>
    @endif

    {{-- Edit Page Form --}}
    <form
      method="POST"
      action="{{ route('pages.update', $page) }}"
      enctype="multipart/form-data"
      class="mb-5"
    >
      @csrf
      @method('PUT')
      {{-- Directory slug --}}
      <div class="mb-4">
        <label class="form-label">Your Directory</label>
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
        <small class="form-text text-muted">
          JPG or PNG only, ≤2 MB, 250×250 px recommended.
        </small>
        @error('profile_pic')
          <div class="invalid-feedback">{{ $message }}</div>
        @enderror

        @if($page->profile_pic)
          <div class="mt-3">
            <img
              src="{{ asset('storage/' . $page->profile_pic) }}"
              class="img-thumbnail"
              style="max-width:150px;"
            >
          </div>
        @endif
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
        <small class="form-text text-muted">
          JPG or PNG only, ≤4 MB, at least 1200×600 px recommended.
        </small>
        @error('background')
          <div class="invalid-feedback">{{ $message }}</div>
        @enderror

        @if($page->background)
          <div class="mt-3">
            <img
              src="{{ asset('storage/' . $page->background) }}"
              class="img-fluid rounded"
              style="max-height:200px;"
            >
          </div>
        @endif
      </div>
      {{-- Bio --}}
      <div class="mb-4">
        <label class="form-label">Bio</label>
        <textarea
          name="bio"
          rows="4"
          class="form-control @error('bio') is-invalid @enderror"
        >{{ old('bio', $page->bio) }}</textarea>
        @error('bio')
          <div class="invalid-feedback">{{ $message }}</div>
        @enderror
      </div>
      <button type="submit" class="btn btn-primary">
        Save Changes
      </button>
    </form>

    {{-- Divider --}}
    <hr class="my-5">

    {{-- Manage Links --}}
    <div class="d-flex justify-content-between align-items-center mb-3">
      <h2 class="h4 mb-0">
        Manage Links for <strong>{{ $page->username }}</strong>
      </h2>
      <a
        href="{{ route('pages.links.create', $page) }}"
        class="btn btn-primary"
      >
        + Add New Link
      </a>
    </div>

    {{-- Vue draggable list --}}
    <div id="vue-link-manager">
      <link-manager
        :initial-links='@json($page->links->sortBy("sort_order")->values())'
        :page-id="{{ $page->id }}"
      ></link-manager>
    </div>

  </div>
@endsection

@push('scripts')
  {{-- This will load the Vite HMR client and your compiled app.js (with LinkManager.vue) --}}
  @vite('resources/js/app.js')
@endpush
