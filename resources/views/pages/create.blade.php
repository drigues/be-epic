{{-- resources/views/pages/create.blade.php --}}
@extends('layouts.app')

@section('content')
  <div class="container py-5">
    <h1>Create Page</h1>

    {{-- 1) Flashed success message --}}
    @if(session('status'))
      <div class="alert alert-success">
        {{ session('status') }}
      </div>
    @endif

    {{-- 2) Validation Errors --}}
    @if($errors->any())
      <div class="alert alert-danger">
        <ul class="mb-0">
          @foreach($errors->all() as $message)
            <li>{{ $message }}</li>
          @endforeach
        </ul>
      </div>
    @endif

    <form 
      method="POST" 
      action="{{ route('pages.store') }}" 
      enctype="multipart/form-data"
    >
      @csrf

      {{-- Username / directory slug --}}
      <div class="mb-3">
        <label for="username" class="form-label">Your Directory</label>
        <div class="input-group">
          <span class="input-group-text">beepi.cc/</span>
          <input
            type="text"
            id="username"
            name="username"
            class="form-control @error('username') is-invalid @enderror"
            value="{{ old('username') }}"
            required
          >
          @error('username')
            <div class="invalid-feedback">{{ $message }}</div>
          @enderror
        </div>
      </div>

      {{-- Profile Picture --}}
      <div class="mb-3">
        <label class="form-label">Profile Picture</label>
        <input 
          type="file" 
          name="profile_pic" 
          class="form-control @error('profile_pic') is-invalid @enderror"
        >
        @error('profile_pic')
          <div class="invalid-feedback">{{ $message }}</div>
        @enderror
      </div>

      {{-- Background Image --}}
      <div class="mb-3">
        <label class="form-label">Background Image</label>
        <input 
          type="file" 
          name="background" 
          class="form-control @error('background') is-invalid @enderror"
        >
        @error('background')
          <div class="invalid-feedback">{{ $message }}</div>
        @enderror
      </div>

      {{-- Bio --}}
      <div class="mb-3">
        <label class="form-label">Bio</label>
        <textarea 
          name="bio" 
          rows="4" 
          class="form-control @error('bio') is-invalid @enderror"
          placeholder="Tell visitors about yourself…"
        >{{ old('bio') }}</textarea>
        @error('bio')
          <div class="invalid-feedback">{{ $message }}</div>
        @enderror
      </div>

      {{-- Submit Button --}}
      <button type="submit" class="btn btn-success">
        Save Page
      </button>
    </form>
  </div>
@endsection
