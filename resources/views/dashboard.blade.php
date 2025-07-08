{{-- resources/views/dashboard.blade.php --}}
@extends('layouts.app')

@section('content')
<div class="container py-5">
  <h2 class="mb-4">Welcome back, {{ Auth::user()->name }}!</h2>

  {{-- safely count via the query builder --}}
  @php
    $count = Auth::user()->pages()->count();
  @endphp

  {{-- Create‐new‐directory CTA (disabled at 3) --}}
  <div class="mb-4">
    @if($count < 3)
      <a href="{{ route('pages.create') }}" class="btn btn-success">
        + Create New Directory
      </a>
    @else
      <button class="btn btn-secondary" disabled>
        You’ve reached the 3-directory limit
      </button>
    @endif
  </div>

  @if($count === 0)
    <p class="text-muted">You haven’t created any directories yet.</p>
  @else
    <table class="table table-striped align-middle">
      <thead>
        <tr>
          <th>Directory Slug</th>
          <th>Public URL</th>
          <th class="text-end">Actions</th>
        </tr>
      </thead>
      <tbody>
        @foreach(Auth::user()->pages as $page)
          <tr>
            <td><code>{{ $page->username }}</code></td>
            <td>
              <a href="{{ url($page->username) }}" target="_blank">
                {{ url($page->username) }}
              </a>
            </td>
            <td class="text-end">
              <a
                href="{{ route('pages.edit', $page) }}"
                class="btn btn-sm btn-primary me-2"
              >
                Edit
              </a>

              <form
                action="{{ route('pages.destroy', $page) }}"
                method="POST"
                class="d-inline"
                onsubmit="return confirm('Are you sure? Deleting this directory will remove all its links and cannot be undone.')"
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
