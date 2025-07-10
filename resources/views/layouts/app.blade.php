{{-- LAYOUTS/APP.BLADE.PHP --}}

{{-- AUTHENTICATED AREA --}}

<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  
  {{-- HEAD TAGS --}}
  @include('layouts.layers.head')
  
</head>

<body class="d-flex flex-column min-vh-100">

  {{-- NAVIGATION --}}
  @include('layouts.layers.navigation')

  {{-- MAIN CONTENT, now inside a Bootstrap container --}}
  <main class="flex-shrink-0 py-5">
    <div class="container">
      @yield('content')
    </div>
  </main>

  <div id="vue-test">
    <hello-world></hello-world>
  </div>

  {{-- FOOTER --}}
  <footer class="mt-auto bg-dark text-light py-4">
    <div class="container text-center">
      <a href="{{ route('terms') }}" class="text-muted me-3">Terms</a>
      <a href="{{ route('privacy') }}" class="text-muted me-3">Privacy</a>
      <a href="{{ route('cookies') }}" class="text-muted">Cookies</a>
    </div>
  </footer>

  {{-- Bootstrap JS Bundle (optional) --}}
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-…" crossorigin="anonymous"></script>
</body>

</html>