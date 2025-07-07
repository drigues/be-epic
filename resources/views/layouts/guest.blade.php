<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">

  <title>Clinky - Link in Bio Made for You</title>

  <!-- 1) Bootstrap CSS via CDN -->
  <link
    href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css"
    rel="stylesheet"
    integrity="sha384-…"
    crossorigin="anonymous"
  >

   <!-- 2) Your built CSS/JS -->
    <link rel="stylesheet" href="{{ asset('build/assets/app.css') }}">
    <script src="{{ asset('build/assets/app.js') }}" defer></script>
</head>
<body class="d-flex flex-column min-vh-100">

  {{-- NAVBAR --}}
  <nav class="navbar navbar-light bg-white shadow-sm">
    <div class="container">
      <a class="navbar-brand" href="{{ route('landing') }}">
        <img src="{{ asset('images/clinky.svg') }}" height="32" alt="Clinky">
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
    <div class="container">
      <div class="row">
        <div class="col-md-3 mb-3">
          <p class="mb-0">hello@clinky.cc</p>
        </div>
        <div class="col-md-3 mb-3">
          <h6 class="text-uppercase">Home</h6>
          <ul class="list-unstyled">
            <li><a href="{{ route('home') }}" class="text-light">Home</a></li>
            <li><a href="#how-it-works" class="text-light">How it works</a></li>
            <li><a href="#cases" class="text-light">Cases</a></li>
            <li><a href="#faqs" class="text-light">FAQs</a></li>
          </ul>
        </div>
        <div class="col-md-3 mb-3">
          <h6 class="text-uppercase">Pages</h6>
          <ul class="list-unstyled">
            <li><a href="{{ route('home') }}" class="text-light">Home</a></li>
            <li><a href="{{ route('cookies') }}" class="text-light">Cookies</a></li>
            <li><a href="{{ route('privacy') }}" class="text-light">Privacy</a></li>
            <li><a href="{{ route('terms') }}" class="text-light">Terms</a></li>
          </ul>
        </div>
        <div class="col-md-3 mb-3">
          <h6 class="text-uppercase">Social</h6>
          <ul class="list-unstyled">
            <li><a href="#" class="text-light">LinkedIn</a></li>
            <li><a href="#" class="text-light">Instagram</a></li>
          </ul>
        </div>
      </div>
      <div class="text-center mt-3 small text-muted">
        © {{ date('Y') }} Clinky. All rights reserved.
      </div>
    </div>
  </footer>

</body>
</html>
