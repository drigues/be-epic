{{-- LAYOUTS/GUEST.BLADE.PHP --}}

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">

  {{-- HEAD TAGS --}}
  @include('layouts.layers.head')

  <title>Clinky # Link in Bio Made for You</title>

</head>

<body class="d-flex flex-column min-vh-100">

  {{-- NAVBAR --}}
  <nav class="navbar navbar-light bg-white shadow-sm px-1">
    <div class="container">
      <a class="navbar-brand" href="{{ route('landing') }}">
        <img src="{{ asset('images/clinky.svg') }}" alt="Clinky">
      </a>
      <div>
        <a href="{{ route('login') }}" class="btn btn-outline-dark me-2 rounded-pill">Login</a>
        <a href="{{ route('register') }}" class="btn btn-dark rounded-pill">Sign Up Free</a>
      </div>
    </div>
  </nav>

  {{-- MAIN CONTENT --}}
  <main class="flex-shrink-0">
    @yield('content')
  </main>

   {{-- FOOTER --}}
  <footer class="mt-auto bg-dark text-light py-4">
    <div class="container text-center">
      <a href="{{ route('terms') }}" class="text-white me-3">Terms</a>
      <a href="{{ route('privacy') }}" class="text-white me-3">Privacy</a>
      <a href="{{ route('cookies') }}" class="text-white">Cookies</a>
    </div>
  </footer>

</body>

</html>