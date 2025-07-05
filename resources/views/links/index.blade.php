@extends('layouts.app')

@section('content')
  <div class="container py-5">
    <h1 class="mb-4">
      Manage Links for <strong>{{ $page->username }}</strong>
    </h1>

    @if(session('status'))
      <div class="alert alert-success">{{ session('status') }}</div>
    @endif

    <div class="mb-3">
      <a href="{{ route('pages.links.create', $page) }}" class="btn btn-primary">
        + Add New Link
      </a>
    </div>

    @if($links->isEmpty())
      <p>You haven’t added any links yet.</p>
    @else
      <table class="table table-striped align-middle">
        <thead>
          <tr>
            <th>Title & Icon</th>
            <th>Type</th>
            <th>URL</th>
            <th class="text-end">Actions</th>
          </tr>
        </thead>
        <tbody>
          @foreach($links as $link)
            <tr>
              <td>
                @if($link->icon)
                  <i class="{{ $link->icon }} me-1"></i>
                @endif
                {{ $link->title }}
              </td>
              <td>{{ ucfirst($link->type) }}</td>
              <td>
                <a href="{{ $link->url }}" target="_blank" class="text-decoration-none">
                  {{ \Illuminate\Support\Str::limit($link->url, 40) }}
                </a>
              </td>
              <td class="text-end">
                <!-- shallow edit -->
                <a href="{{ route('links.edit', $link) }}"
                   class="btn btn-sm btn-outline-secondary me-1">
                  Edit
                </a>

                <form action="{{ route('links.destroy', $link) }}"
                      method="POST"
                      onsubmit="return confirm('Delete this link?')">
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
