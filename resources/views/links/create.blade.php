{{-- resources/views/links/create.blade.php --}}
@extends('layouts.app')

@section('content')
<div class="container py-5">
  <h1 class="mb-4">Add Link</h1>

  {{-- Existing Links --}}
  @if($page->links->isNotEmpty())
    <div class="mb-4">
      <h2 class="h5">Existing Links</h2>
      <table class="table table-borderless align-middle">
        <thead>
          <tr>
            <th style="width:10%">Order</th>
            <th>Title</th>
            <th>URL</th>
          </tr>
        </thead>
        <tbody>
          @foreach($page->links->sortBy('sort_order') as $link)
            <tr>
              <td>{{ $link->sort_order }}</td>
              <td>{{ $link->title }}</td>
              <td>
                <a href="{{ $link->url }}" target="_blank" class="text-decoration-none">
                  {{ \Illuminate\Support\Str::limit($link->url, 40) }}
                </a>
              </td>
            </tr>
          @endforeach
        </tbody>
      </table>
    </div>
  @endif

  {{-- Validation Errors --}}
  @if($errors->any())
    <div class="alert alert-danger">
      <ul class="mb-0">
        @foreach($errors->all() as $err)
          <li>{{ $err }}</li>
        @endforeach
      </ul>
    </div>
  @endif

  {{-- Add Link Form --}}
  <form action="{{ route('pages.links.store', $page) }}" method="POST">
    @csrf

    <div class="mb-3">
      <label class="form-label">Title</label>
      <input
        type="text"
        name="title"
        value="{{ old('title') }}"
        class="form-control @error('title') is-invalid @enderror"
      >
      @error('title')
        <div class="invalid-feedback">{{ $message }}</div>
      @enderror
    </div>

    <div class="mb-3">
      <label class="form-label">Icon (CSS class)</label>
      <input
        type="text"
        name="icon"
        value="{{ old('icon') }}"
        class="form-control @error('icon') is-invalid @enderror"
      >
      @error('icon')
        <div class="invalid-feedback">{{ $message }}</div>
      @enderror
    </div>

    <div class="mb-3">
      <label class="form-label">Type</label>
      <select
        name="type"
        class="form-select @error('type') is-invalid @enderror"
      >
        <option value="">Choose…</option>
        @foreach(['social','portfolio','blog','youtube','custom'] as $type)
          <option value="{{ $type }}" @selected(old('type') === $type)>
            {{ ucfirst($type) }}
          </option>
        @endforeach
      </select>
      @error('type')
        <div class="invalid-feedback">{{ $message }}</div>
      @enderror
    </div>

    <div class="mb-3">
      <label class="form-label">URL</label>
      <input
        type="url"
        name="url"
        value="{{ old('url') }}"
        class="form-control @error('url') is-invalid @enderror"
      >
      @error('url')
        <div class="invalid-feedback">{{ $message }}</div>
      @enderror
    </div>

    <div class="mb-3">
      <label class="form-label">Position</label>
      <input
        type="number"
        name="sort_order"
        min="1"
        value="{{ old('sort_order', ($page->links->max('sort_order') ?? 0) + 1) }}"
        class="form-control @error('sort_order') is-invalid @enderror"
      >
      @error('sort_order')
        <div class="invalid-feedback">{{ $message }}</div>
      @enderror
      <small class="form-text text-muted">
        1 = top of the list; larger numbers push it down.
      </small>
    </div>

    <button type="submit" class="btn btn-success">
      Save Link
    </button>
  </form>
</div>
@endsection
