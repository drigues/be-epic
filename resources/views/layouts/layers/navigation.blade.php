{{-- LAYOUTS/LAYERS/NAVIGATION.BLADE.PHP --}}

<nav class="navbar navbar-expand-lg navbar-light bg-dash shadow-sm">
  <div class="container">
    <a class="navbar-brand" href="{{ route('dashboard') }}">
      <img src="{{ asset('images/clinky.svg') }}" height="32" alt="Clinky" class="logo-white">
    </a>

    <div>
      <ul class="mb-0">
        @guest
          <li class="nav-item"><a class="nav-link" href="{{ route('login') }}">Login</a></li>
          <li class="nav-item"><a class="btn btn-primary rounded-pill" href="{{ route('register') }}">Sign Up</a></li>
        @else
          <li class="nav-item dropdown btn btn-sm btn-outline-light">
            <a class="nav-link dropdown-toggle" href="#" id="userMenu" role="button" data-bs-toggle="dropdown" aria-expanded="false">
              {{ Auth::user()->name }}
            </a>
            <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="userMenu">
              <li class="nav-item">
                <a class="dropdown-item" href="{{ route('dashboard') }}">Dashboard</a>
              </li>
              <li><hr class="dropdown-divider"></li>

              @foreach(Auth::user()->pages as $page)
                <li><a class="dropdown-item" href="{{ route('pages.edit', $page) }}">/ {{ $page->username }}</a></li>
                <li><hr class="dropdown-divider"></li>
              @endforeach

              @php
                $count = Auth::user()->pages()->count();
              @endphp
              @if($count < 3)
                <li><a class="dropdown-item" href="{{ route('pages.create') }}">+ Create New Clinky Page</a></li>
                <li><hr class="dropdown-divider"></li>
              @endif

              <li><a class="dropdown-item" href="{{ route('profile.edit') }}">Account Details</a></li>
              <li><hr class="dropdown-divider"></li>
              <li>
                  <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <button type="submit" class="dropdown-item">Log Out</button>
                  </form>
              </li>
            </ul>
          </li>
        @endguest
      </ul>
    </div>

  </div>
</nav>