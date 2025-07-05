@extends('layouts.app')

@section('content')
  <div class="d-flex justify-content-between align-items-center mb-4">
    <h1 class="h3">All Pages</h1>
    <a href="{{ route('pages.create') }}" class="btn btn-primary">
      + New Page
    </a>
  </div>

  <div class="row g-3">
    @foreach($pages as $page)
      <div class="col-sm-6 col-lg-4">
        <a href="{{ route('pages.show',$page) }}"
           class="card h-100 text-decoration-none text-dark shadow-sm">
          <div class="card-body">
            <h5 class="card-title">Page #{{ $page->id }}</h5>
            <p class="card-text text-muted">{{ $page->links_count }} links</p>
          </div>
        </a>
      </div>
    @endforeach
  </div>

  <div class="mt-4">
    {{ $pages->links() }}
  </div>
@endsection
