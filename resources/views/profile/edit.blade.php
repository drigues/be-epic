{{-- PROFILE/EDIT.BLADE.PHP --}}

@extends('layouts.app')

@section('content')
<div class="container">
  {{-- Page title --}}
  <h1 class="mb-4">Account Details</h1>

  {{-- Flash status message --}}
  @if(session('status'))
    <div class="alert alert-success alert-dismissible fade show" role="alert">
      {{ session('status') }}
      <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
    </div>
  @endif

  {{-- Global validation errors --}}
  @if($errors->any())
    <div class="alert alert-danger">
      <ul class="mb-0">
        @foreach($errors->all() as $error)
          <li>{{ $error }}</li>
        @endforeach
      </ul>
    </div>
  @endif

  <div class="row gy-4 a">
    
    <div class="col-md-6 b">

      {{-- UPDATE PROFILE --}}
      <div class="card shadow-sm mb-4 c">
        <div class="card-header">Update Profile Information</div>
        <div class="card-body">
          <form method="POST" action="{{ route('profile.update') }}">
            @csrf @method('PATCH')

            <div class="mb-3">
              <label for="name" class="form-label">Name</label>
              <input
                id="name"
                name="name"
                type="text"
                class="form-control @error('name') is-invalid @enderror"
                value="{{ old('name', auth()->user()->name) }}"
                required
                autofocus
              >
              @error('name')
                <div class="invalid-feedback">{{ $message }}</div>
              @enderror
            </div>

            <div class="mb-3">
              <label for="email" class="form-label">Email address</label>
              <input
                id="email"
                name="email"
                type="email"
                class="form-control @error('email') is-invalid @enderror"
                value="{{ old('email', auth()->user()->email) }}"
                required
              >
              @error('email')
                <div class="invalid-feedback">{{ $message }}</div>
              @enderror
            </div>

            <button type="submit" class="btn btn-primary">Save</button>
          </form>
        </div>
      </div> {{-- end update profile --}}

      {{-- CLINKY PAGES --}}
      <div class="card shadow-sm c">
        <div class="card-header">Your Clinky Pages</div>
        <div class="card-body">
      
          {{-- safely count via the query builder --}}
          @php
            $count = Auth::user()->pages()->count();
          @endphp

          @if($count === 0)
          <p class="text-muted">You haven’t created any directories yet.</p>
          @else
            <table class="table align-middle">
              <colgroup>
                <col style="width: 25%;">
                <col style="width: 30%;">
                <col style="width: 45%;">
              </colgroup>
              <tbody>
                @foreach(Auth::user()->pages as $page)
                  <tr>
                  <td><code>/{{ $page->username }}</code></td>
                  <td>
                  <a href="{{ url($page->username) }}" target="_blank">
                  {{-- url($page->username) --}} View page
                  </a>
                  </td>
                  <td class="text-end">
                  <a href="{{ route('pages.edit', $page) }}" class="btn btn-sm btn-primary me-2">
                  Edit
                  </a>
                    <form action="{{ route('pages.destroy', $page) }}" method="POST" class="d-inline"
                    onsubmit="return confirm('Are you sure? Deleting this directory will remove all its links and cannot be undone.')">
                    @csrf
                    @method('DELETE')
                      <button class="btn btn-sm btn-outline-danger">
                      DEL
                      </button>
                    </form>
                  </td>
                  </tr>
                @endforeach 
              </tbody>
            </table>
          @endif

          {{-- Create‐new‐directory CTA (disabled at 3) --}}
          <div>
            @if($count < 3)
              <a href="{{ route('pages.create') }}" class="btn btn-success">+ Create New Clinky Page</a>
            @else
              <button class="btn btn-secondary" disabled>You’ve reached the 3-Clinky pages limit</button>
            @endif
          </div>

        </div>
      </div>{{-- end clinky pages --}}

    </div>

    {{-- Update Password & Delete --}}
    <div class="col-md-6 b">

      {{-- Password --}}
      <div class="card shadow-sm mb-4 c">
        <div class="card-header">Update Password</div>
        <div class="card-body">
          <form method="POST" action="{{ route('password.update') }}">
            @csrf @method('PUT')

            <div class="mb-3">
              <label for="current_password" class="form-label">Current Password</label>
              <input
                id="current_password"
                name="current_password"
                type="password"
                class="form-control @error('current_password') is-invalid @enderror"
                required
              >
              @error('current_password')
                <div class="invalid-feedback">{{ $message }}</div>
              @enderror
            </div>

            <div class="mb-3">
              <label for="password" class="form-label">New Password</label>
              <input
                id="password"
                name="password"
                type="password"
                class="form-control @error('password') is-invalid @enderror"
                required
              >
              @error('password')
                <div class="invalid-feedback">{{ $message }}</div>
              @enderror
            </div>

            <div class="mb-3">
              <label for="password_confirmation" class="form-label">Confirm Password</label>
              <input
                id="password_confirmation"
                name="password_confirmation"
                type="password"
                class="form-control"
                required
              >
            </div>

            <button type="submit" class="btn btn-primary">Save</button>
          </form>
        </div>
      </div>


      {{-- Delete Account --}}
      <div class="card shadow-sm c">
        <div class="card-header text-danger">Delete Account</div>
        <div class="card-body">
          <p class="text-danger">
            Once your account is deleted, all of its resources and data
            will be permanently removed. This action cannot be undone.
          </p>

          <form
            method="POST"
            action="{{ route('profile.destroy') }}"
            onsubmit="return confirm('Are you absolutely sure? This cannot be undone.');"
          >
            @csrf
            @method('DELETE')

            {{-- 1. Password Confirmation --}}
            <div class="mb-3">
              <label for="password" class="form-label">Confirm Password</label>
              <input
                id="password"
                name="password"
                type="password"
                class="form-control @error('password') is-invalid @enderror"
                required
                autocomplete="current-password"
              >
              @error('password')
                <div class="invalid-feedback">{{ $message }}</div>
              @enderror
            </div>

            {{-- 2. Delete button --}}
            <button type="submit" class="btn btn-outline-danger">
              Delete Account
            </button>
          </form>
        </div>
      </div>


    </div>


</div>
@endsection
