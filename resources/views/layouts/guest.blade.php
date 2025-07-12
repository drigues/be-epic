{{-- LAYOUTS/GUEST.BLADE.PHP --}}

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">

  {{-- HEAD TAGS --}}
  @include('layouts.layers.head')

  <link href="https://cdnjs.cloudflare.com/ajax/libs/aos/2.3.4/aos.css" rel="stylesheet" />

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
  <footer class="mt-auto bg-dark text-light px-3 py-5">
    <div class="container p-3">
      <div class="row p-3">
        <div class="col-md-4 mb-4">
          <a class="navbar-brand" href="{{ route('landing') }}">
            <img src="{{ asset('images/clinky.svg') }}" height="60" alt="Clinky" class="logo-white">
          </a>
          <p class="py-3"><a class="text-light link-underline link-underline-opacity-0" href="mailto:clinkycc@gmail.com">clinkycc@gmail.com</a></p>
        </div>
        <div class="col-md-3 mb-3">
          <h6 class="text-uppercase text-secondary">Home</h6>
          <ul class="list-unstyled">
            <li class="p-1"><a href="#" class="text-light link-underline link-underline-opacity-0">How it works</a></li>
            <li class="p-1"><a href="#" class="text-light link-underline link-underline-opacity-0">Cases</a></li>
            <li class="p-1"><a href="#" class="text-light link-underline link-underline-opacity-0">FAQs</a></li>
          </ul>
        </div>
        <div class="col-md-3 mb-3">
          <h6 class="text-uppercase text-secondary">Pages</h6>
          <ul class="list-unstyled">
            <li class="p-1"><a href="{{ route('terms') }}" class="text-light link-underline link-underline-opacity-0">Terms</a></li>
            <li class="p-1"><a href="{{ route('privacy') }}" class="text-light link-underline link-underline-opacity-0">Privacy</a></li>
            <li class="p-1"><a href="{{ route('cookies') }}" class="text-light link-underline link-underline-opacity-0">Cookies</a></li>
          </ul>
        </div>
        <div class="col-md-2 mb-2">
          <h6 class="text-uppercase text-secondary">Social</h6>
          <ul class="list-unstyled">
            <li><a href="#" class="text-light link-underline link-underline-opacity-0">LinkedIn</a></li>
            <li><a href="#" class="text-light link-underline link-underline-opacity-0">Instagram</a></li>
          </ul>
        </div>
      </div>
      <div class="text-center mt-3 small text-secondary">
        © {{ date('Y') }} Clinky. All rights reserved.
      </div>
    </div>
  </footer>

  {{-- SCRIPTS --}}
  <script src="https://cdnjs.cloudflare.com/ajax/libs/aos/2.3.4/aos.js"></script>
  <script>
    document.addEventListener('DOMContentLoaded', () => {
      AOS.init({
        // Global settings:
        duration: 600,      // animation duration (ms)
        delay: 100,         // global delay before animate (ms)
        once: true,         // whether animation should happen only once
        offset: 120,        // offset (px) from top to trigger
        easing: 'ease-out', // default easing for animations
      });
    });
  </script>
</body>

</html>