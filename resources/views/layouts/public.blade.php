<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">

  <title>{{ $page->username }} • Beepicc</title>

  <!-- Bootstrap CSS (CDN) -->
  <link
    href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css"
    rel="stylesheet" crossorigin="anonymous"
  >

  {{-- Your sitewide CSS/JS bundles --}}
  @vite(['resources/css/app.css','resources/js/app.js'])
</head>
<body class="d-flex flex-column min-vh-100">


  {{-- MAIN --}}
  <main class="flex-grow-1">
    @yield('public-content')
  </main>



</body>
</html>
