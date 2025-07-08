@extends('layouts.app')

@section('content')
  <div class="container py-5">

    {{-- Page title --}}
    <h1 class="mb-4">Edit Page</h1>

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

    @if($page->links->isEmpty())
      <p class="text-muted">You haven’t added any links yet.</p>
    @else
      <table class="table table-striped align-middle">
        <thead>
          <tr>
            <th>Title &amp; Icon</th>
            <th>Type</th>
            <th>URL</th>
            <th class="text-end">Actions</th>
          </tr>
        </thead>
        <tbody>
          @foreach($page->links as $link)
            <tr>
              <td>
                @if($link->icon)
                  <i class="{{ $link->icon }} me-1"></i>
                @endif
                {{ $link->title }}
              </td>
              <td>{{ ucfirst($link->type) }}</td>
              <td>
                <a
                  href="{{ $link->url }}"
                  target="_blank"
                  class="text-decoration-none"
                >
                  {{ \Illuminate\Support\Str::limit($link->url, 40) }}
                </a>
              </td>
              <td class="text-end">
                <a
                  href="{{ route('links.edit', $link) }}"
                  class="btn btn-sm btn-outline-secondary me-1"
                >
                  Edit
                </a>
                <form
                  action="{{ route('links.destroy', $link) }}"
                  method="POST"
                  class="d-inline"
                  onsubmit="return confirm('Delete this link?')"
                >
                  @csrf
                  @method('DELETE')
                  <button class="btn btn-sm btn-outline-danger">
                    Delete
                  </button>
                </form>
              </td>
            </tr>
          @endforeach
        </tbody>
      </table>
    @endif

  </div>
@endsection