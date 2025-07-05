@extends('layouts.app')

@section('content')
  <div class="container py-5">
    <div class="row justify-content-center">
      <div class="col-md-8">

        <h1>Edit Page</h1>

        {{-- Status & errors --}}
        @if(session('status'))
          <div class="alert alert-success">{{ session('status') }}</div>
        @endif
        @if($errors->any())
          <div class="alert alert-danger">
            <ul class="mb-0">
              @foreach($errors->all() as $err)
                <li>{{ $err }}</li>
              @endforeach
            </ul>
          </div>
        @endif

        <form method="POST"
              action="{{ route('pages.update', $page) }}"
              enctype="multipart/form-data">
          @csrf
          @method('PUT')

          {{-- Your Directory --}}
          <div class="mb-4">
            <label class="form-label">beepi.cc/</label>
            <div class="input-group">
              <span class="input-group-text">beepi.cc/</span>
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
              class="form-control w-100 @error('profile_pic') is-invalid @enderror"
            >
            <small class="form-text text-muted">
              JPG or PNG only, ≤2 MB, 250×250 px recommended.
            </small>
            @error('profile_pic')
              <div class="invalid-feedback">{{ $message }}</div>
            @enderror

            @if($page->profile_pic)
              <div class="mt-3">
                <img src="{{ asset('storage/' . $page->profile_pic) }}"
                     class="img-thumbnail"
                     style="max-width:150px;">
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
              class="form-control w-100 @error('background') is-invalid @enderror"
            >
            <small class="form-text text-muted">
              JPG or PNG only, ≤4 MB, at least 1200×600 px recommended.
            </small>
            @error('background')
              <div class="invalid-feedback">{{ $message }}</div>
            @enderror

            @if($page->background)
              <div class="mt-3">
                <img src="{{ asset('storage/' . $page->background) }}"
                     class="img-fluid rounded"
                     style="max-height:200px;">
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

          <button type="submit"
                  class="btn btn-primary">
            Save Changes
          </button>
        </form>

      </div>
    </div>
  </div>
@endsection
