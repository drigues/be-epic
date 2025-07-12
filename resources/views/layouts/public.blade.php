{{-- LAYOUTS/PUBLIC.BLADE.PHP --}}

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">

  <title>{{ $page->username }} • Clinky</title>

  <link href="https://cdnjs.cloudflare.com/ajax/libs/aos/2.3.4/aos.css" rel="stylesheet" />

  {{-- Bootstrap CSS (CDN) --}}
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet"crossorigin="anonymous">

  {{-- Built CSS/JS --}}
  @vite([
    'resources/css/app.css',
    'resources/js/app.js',
    'resources/css/guest.css',
    'resources/js/guest.js',
  ])
</head>

<body class="d-flex flex-column min-vh-100">

  {{-- MAIN --}}
  <main class="flex-grow-1 mb-5">
    @yield('public-content')
  </main>

  <div class="d-flex flex-column align-items-center justify-content-center text-center p-3 bg-light">
    <p class="my-4"><i class="ck-1">clinky.cc/YOU</i> # Create your page FREE now!!</p>
    <p>
      <a class="navbar-brand" href="{{ route('landing') }}"><img src="{{ asset('images/clinky.svg') }}" alt="Clinky" height="60"></a>
    </p>
  </div>
  

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