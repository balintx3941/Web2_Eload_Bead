<!DOCTYPE html>
<html lang="hu">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta name="csrf-token" content="{{ csrf_token() }}">
  <title>LaptopDB - Hardver Nyilvántartó</title>
  
  <!-- Bootstrap 5 CSS & Icons -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">

  <style>
    :root {
      --bg-page: #0d141f;
      --card-bg: #151e2b;
      --card-border: #202d3f;
      --teal-primary: #14b8a6;
      --teal-light: #2dd4bf;
      --text-muted: #8e9eb5;
    }

    body {
      background-color: var(--bg-page) !important;
      color: #ffffff;
      font-family: system-ui, -apple-system, "Segoe UI", Roboto, sans-serif;
      min-height: 100vh;
      display: flex;
      flex-direction: column;
    }

    /* Navbar */
    .navbar-custom {
      background-color: var(--bg-page);
      border-bottom: 1px solid rgba(255, 255, 255, 0.05);
      padding: 18px 0;
    }

    .brand-logo {
      display: flex;
      align-items: center;
      gap: 10px;
      text-decoration: none;
      color: #ffffff;
      font-weight: 700;
      font-size: 1.35rem;
      letter-spacing: -0.5px;
    }

    .brand-logo i {
      color: var(--teal-light);
      font-size: 1.5rem;
    }

    .nav-link-custom {
      color: var(--text-muted);
      text-decoration: none;
      font-size: 0.95rem;
      font-weight: 500;
      transition: color 0.2s ease;
    }

    .nav-link-custom:hover,
    .nav-link-custom.active {
      color: var(--teal-light) !important;
    }

    /* Gombok */
    .btn-teal {
      background-color: var(--teal-primary) !important;
      color: #ffffff !important;
      border: none !important;
      border-radius: 8px !important;
      padding: 9px 22px !important;
      font-weight: 600;
      font-size: 0.95rem;
      transition: all 0.2s ease;
    }
    .btn-teal:hover {
      background-color: #0d9488 !important;
      color: #ffffff !important;
    }

    .btn-teal-outline {
      background-color: transparent !important;
      border: 1px solid var(--teal-primary) !important;
      color: var(--teal-light) !important;
      border-radius: 8px !important;
      padding: 9px 22px !important;
      font-weight: 600;
      font-size: 0.95rem;
      text-decoration: none;
      transition: all 0.2s ease;
    }
    .btn-teal-outline:hover {
      background-color: rgba(20, 184, 166, 0.12) !important;
      color: #ffffff !important;
    }

    /* Kártya alapstílus */
    .rentiz-card {
      background-color: var(--card-bg);
      border: 1px solid var(--card-border);
      border-radius: 18px;
    }

    /* Kategória tag badge-ek */
    .category-tag {
      background-color: #12222d;
      border: 1px solid #1a3842;
      color: var(--teal-light);
      font-size: 0.72rem;
      font-weight: 500;
      padding: 4px 10px;
      border-radius: 6px;
      display: inline-block;
    }
  </style>
</head>
<body>

  <!-- Fejléc / Navigáció -->
  <nav class="navbar-custom">
    <div class="container d-flex justify-content-between align-items-center">
      
      <!-- Bal oldal: Logo és Menü -->
      <div class="d-flex align-items-center gap-4">
        <a href="{{ url('/') }}" class="brand-logo">
          <i class="bi bi-laptop"></i>
          <span>Laptop<span style="font-weight: 800;">DB</span></span>
        </a>

        <div class="d-none d-md-flex align-items-center gap-3 ms-2">
          <a class="nav-link-custom {{ request()->is('/') ? 'active' : '' }}" href="{{ url('/') }}">Főoldal</a>
          <a class="nav-link-custom {{ request()->is('adatbazis*') ? 'active' : '' }}" href="{{ url('/adatbazis') }}">Adatbázis</a>
          <a class="nav-link-custom {{ request()->is('kapcsolat*') ? 'active' : '' }}" href="{{ url('/kapcsolat') }}">Kapcsolat</a>
          <a class="nav-link-custom {{ request()->is('diagram*') ? 'active' : '' }}" href="{{ url('/diagram') }}">Diagram</a>
          @auth
            <a class="nav-link-custom {{ request()->is('uzenetek*') ? 'active' : '' }}" href="{{ url('/uzenetek') }}">Üzenetek</a>
          @endauth
        </div>
      </div>

      <!-- Jobb oldal: Auth gombok -->
      <div class="d-flex align-items-center gap-3">
        @auth
          <span class="small" style="color: var(--text-muted);">{{ Auth::user()->name }}</span>
          <form method="POST" action="{{ url('/logout') }}" class="d-inline">
            @csrf
            <button type="submit" class="btn btn-teal-outline btn-sm">Kijelentkezés</button>
          </form>
        @else
          <a href="{{ url('/login') }}" class="btn btn-teal">Bejelentkezés</a>
          <a href="{{ url('/register') }}" class="btn btn-teal-outline">Regisztráció</a>
        @endauth
      </div>

    </div>
  </nav>

  <!-- Oldal tartalma -->
  <main class="flex-grow-1">
    {{ $slot }}
  </main>

  <!-- Lábléc a képen látható pontos adatokkal -->
  <footer class="py-4 mt-5" style="background-color: #0c121b; border-top: 1px solid rgba(255,255,255,0.06);">
    <div class="container d-flex flex-wrap justify-content-between align-items-center small" style="color: var(--text-muted);">
      <div>&copy; 2026 <strong>LaptopDB</strong></div>
      <div><strong>Horváth Gréta</strong> - AZQ13J &amp; <strong>Bódi Bálint</strong> - KLNK5L</div>
      <div>Téma: Rentiz (ThemeWagon)</div>
    </div>
  </footer>

  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
