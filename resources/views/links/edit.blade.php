@extends('layouts.app')

@section('content')
  <div class="container py-5">
    <h1 class="mb-4">Edit Link</h1>

    @if($errors->any())
      <div class="alert alert-danger">
        <ul class="mb-0">
          @foreach($errors->all() as $err)
            <li>{{ $err }}</li>
          @endforeach
        </ul>
      </div>
    @endif

    <form
      action="{{ isset($link)
          ? route('links.update', $link)
          : route('pages.links.store', $page) }}"
      method="POST">
      @csrf
      @if(isset($link)) @method('PUT') @endif

      <div class="mb-3">
        <label class="form-label">Title</label>
        <input name="title"
               value="{{ old('title', $link->title) }}"
               class="form-control @error('title') is-invalid @enderror">
        @error('title') <div class="invalid-feedback">{{ $message }}</div> @enderror
      </div>

      <div class="mb-3">
        <label class="form-label">Icon (CSS class)</label>
        <input name="icon"
               value="{{ old('icon', $link->icon) }}"
               class="form-control @error('icon') is-invalid @enderror">
        @error('icon') <div class="invalid-feedback">{{ $message }}</div> @enderror
      </div>

      <div class="mb-3">
        <label class="form-label">Type</label>
        <select name="type" class="form-select @error('type') is-invalid @enderror">
          @foreach(['social','portfolio','blog','youtube','custom'] as $type)
            <option value="{{ $type }}" @selected(old('type', $link->type)==$type)>
              {{ ucfirst($type) }}
            </option>
          @endforeach
        </select>
        @error('type') <div class="invalid-feedback">{{ $message }}</div> @enderror
      </div>

      <div class="mb-3">
        <label class="form-label">URL</label>
        <input name="url"
               value="{{ old('url', $link->url) }}"
               class="form-control @error('url') is-invalid @enderror">
        @error('url') <div class="invalid-feedback">{{ $message }}</div> @enderror
      </div>

      <button type="submit" class="btn btn-primary">Update Link</button>
    </form>
  </div>
@endsection
