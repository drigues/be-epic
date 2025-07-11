<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">

  <title>{{ $page->username }} • Clinky</title>

  {{-- Bootstrap CSS (CDN) --}}
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet"crossorigin="anonymous">

  {{-- Your built CSS/JS--}}
  <link rel="stylesheet" href="{{ asset('build/assets/app.css') }}">
  <script src="{{ asset('build/assets/app.js') }}" defer></script>
</head>

<body class="d-flex flex-column min-vh-100">

  {{-- MAIN --}}
  <main class="flex-grow-1">
    @yield('public-content')
  </main>


</body>
</html>