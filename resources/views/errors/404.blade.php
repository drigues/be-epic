@extends('layouts.app') {{-- Or use layout of your choice --}}

@section('content')
@php
    $path = request()->path();
    $isCatchAll = !str_contains($path, '/'); // Only /{username}, no slashes
@endphp

<div class="container text-center py-5">
    <h1 class="display-4">Oops! Page Not Found 😢</h1>

    @if ($isCatchAll)
        <p class="lead">But it looks like <strong>{{ url($path) }}</strong> is still available. Want to claim it?</p>

        <form action="{{ route('register') }}" method="GET" class="d-flex justify-content-center mt-4">
            <div class="input-group" style="max-width: 400px;">
                <span class="input-group-text">clinky.cc/</span>
                <input type="text" name="username" class="form-control" value="{{ $path }}" readonly>
                <button type="submit" class="btn btn-dark">Claim Now</button>
            </div>
        </form>
    @else
        <p class="lead">This page doesn't exist. You can go back to <a href="{{ url('/') }}">home</a>.</p>
    @endif
</div>
@endsection
