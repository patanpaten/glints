<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Company Dashboard')</title>

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">

    <!-- Custom CSS -->
    <style>
        body {
            background-color: #f8f9fa;
        }
        .navbar {
            background-color: #ffffff;
            box-shadow: 0 2px 4px rgba(0,0,0,0.05);
        }
        .navbar-brand {
            font-weight: bold;
            color: #0d6efd !important;
            padding-top: 0;
            padding-bottom: 0;
        }
        .logo-navbar {
            height: 70px;     /* ukuran logo diperbesar */
            width: auto;      /* proporsional */
            object-fit: contain;
        }
        .navbar .nav-link {
            color: #333;
            font-weight: 500;
            padding: 0.5rem 1rem;
            position: relative;
            padding-bottom: 6px; /* kasih ruang buat garis bawah */
            transition: color 0.3s ease;
        }
        .navbar .nav-link.active {
            color: #0d6efd;
            font-weight: 600;
        }
        .navbar-nav .nav-link::after {
            content: "";
            position: absolute;
            left: 0;
            bottom: 0;
            width: 0%;
            height: 3px;
            background-color: #0d6efd;
            transition: width 0.3s ease;
        }
        .navbar-nav .nav-link:hover {
            color: #0d6efd;
        }
        .navbar-nav .nav-link:hover::after,
        .navbar-nav .nav-link.active::after {
            width: 100%;
        }

        .btn-chat {
            background-color: #ffffff;
            color: #333;
            border: 1px solid #dee2e6;
            position: relative;
        }
        .btn-chat .badge {
            position: absolute;
            top: -5px;
            right: -5px;
            background-color: #ff5c5c;
        }
        .btn-loker {
            background-color: #0d6efd;
            color: white;
        }
        .content-wrapper {
            padding: 20px;
        }
        .user-avatar {
            width: 30px;
            height: 30px;
            border-radius: 50%;
            background-color: #f0f0f0;
            display: flex;
            align-items: center;
            justify-content: center;
            font-weight: bold;
            color: #666;
        }
        .user-rating {
            font-size: 12px;
            color: #666;
        }
    </style>
</head>
<body>

  <!-- NAVBAR -->
<nav class="navbar navbar-expand-lg navbar-light bg-white shadow-sm sticky-top">
  <div class="container-fluid px-4">

    <!-- Logo -->
    <a class="navbar-brand d-flex align-items-center" href="{{ route('company.dashboard') }}">
      <img src="/images/logo dan teks glints.png" alt="Glints" class="logo-navbar">
    </a>

    <!-- Toggler -->
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
      <span class="navbar-toggler-icon"></span>
    </button>

    <!-- Menu -->
    <div class="collapse navbar-collapse" id="navbarNav">
      <!-- Left nav -->
      <ul class="navbar-nav me-auto ms-4">
        <li class="nav-item">
          <a class="nav-link {{ request()->routeIs('company.dashboard') ? 'active fw-bold text-dark' : '' }}" href="{{ route('company.dashboard') }}">DASHBOARD</a>
        </li>
        <li class="nav-item">
          <a class="nav-link {{ request()->routeIs('company.premium-features.*') ? 'active fw-bold text-dark' : '' }}" href="{{ route('company.premium-features.index') }}">FITUR PREMIUM</a>
        </li>
        <li class="nav-item">
          <a class="nav-link {{ request()->routeIs('company.cv-search.*') ? 'active fw-bold text-dark' : '' }}" href="{{ route('company.cv-search.index') }}">CARI CV</a>
        </li>
      </ul>

      <!-- Right nav -->
      <div class="d-flex align-items-center gap-3">

        <!-- Chat -->
        <button class="btn btn-outline-secondary btn-sm d-flex align-items-center gap-1">
          <i class="far fa-comment-alt"></i>
          CHAT
        </button>

        <!-- Pasang Loker -->
        <a href="{{ route('company.jobs.create') }}" class="btn btn-primary btn-sm fw-bold">
          PASANG LOKER
        </a>

        <!-- Garis pembatas -->
        <div class="border-start" style="height: 24px;"></div>

        <!-- Profile dropdown -->
        @auth('company')
        <div class="dropdown">
          <a class="d-flex align-items-center gap-2 text-decoration-none text-dark dropdown-toggle" href="#" id="profileDropdown" role="button" data-bs-toggle="dropdown">
            <!-- Avatar -->
            <div class="position-relative">
                @if(Auth::guard('company')->user()->logo)
                    <img src="{{ asset('storage/' . Auth::guard('company')->user()->logo) }}"
                        alt="{{ Auth::guard('company')->user()->name }}"
                        class="rounded-circle"
                        style="width: 30px; height: 30px; object-fit: cover;">
                @else
                    <div class="bg-primary rounded-circle d-flex align-items-center justify-content-center text-white fw-bold"
                        style="width: 50px; height: 50px; font-size: 24px;">
                        {{ Auth::guard('company')->user()->initials }}
                    </div>
                @endif
            </div>

            <!-- Info -->
            <div class="text-start small lh-1">
              <div class="fw-semibold">{{ Str::limit(Auth::guard('company')->user()->name, 10) }}...</div>
              <div class="d-flex align-items-center">
                <!-- Bintang SVG -->
                <svg xmlns="http://www.w3.org/2000/svg"
                    width="12" height="12"
                    fill="red" viewBox="0 0 24 24"
                    class="me-1">
                  <path d="m10.72 2 4.2 5.78L22 7.69l-4.15 5.64L20.26 20l-6.76-2.22L7.88 22v-7.08L2 10.86l6.73-2.09L10.72 2Z"></path>
                </svg>
                <!-- Angka tetap hitam -->
                <span class="text-dark">{{ Auth::guard('company')->user()->credits }}</span>
              </div>
            </div>


          </a>
          <ul class="dropdown-menu dropdown-menu-end shadow" style="min-width: 280px;">
        <!-- Header profil -->
        <li class="px-3 py-2 d-flex align-items-center border-bottom">
                      <div class="position-relative me-3">
                      @if(Auth::guard('company')->user()->logo)
                          <img src="{{ asset('storage/' . Auth::guard('company')->user()->logo) }}"
                              alt="{{ Auth::guard('company')->user()->name }}"
                              class="rounded-circle"
                              style="width: 50px; height: 50px; object-fit: cover;">
                      @else
                          <div class="bg-primary rounded-circle d-flex align-items-center justify-content-center text-white fw-bold"
                              style="width: 50px; height: 50px; font-size: 24px;">
                              {{ Auth::guard('company')->user()->initials }}
                          </div>
                      @endif
                  </div>
                  <div>
                      <div class="fw-semibold">{{ Auth::guard('company')->user()->name }}</div>
                      <small class="text-muted">{{ Auth::guard('company')->user()->country }}</small>
                  </div>

          <span class="badge {{ Auth::guard('company')->user()->isVip() ? 'bg-warning text-dark' : 'bg-light text-dark' }} ms-auto">
            {{ Auth::guard('company')->user()->isVip() ? 'VIP' : 'Gratis' }}
          </span>
        </li>

        <!-- Status VIP -->
        <li class="px-3 py-2 border-bottom">
          <div class="text-muted small">Glints VIP:
            <span class="text-dark">{{ Auth::guard('company')->user()->isVip() ? 'Aktif' : 'Tidak Aktif' }}</span>
          </div>
          @if(!Auth::guard('company')->user()->isVip())
            <a href="{{ route('company.premium-features.index') }}" class="fw-semibold text-primary small text-decoration-none">Upgrade ke VIP</a>
          @endif
        </li>

        @if(!Auth::guard('company')->user()->isVip())
        <!-- Promo -->
        <li class="px-3 py-2 border-bottom">
          <div class="alert alert-warning p-2 mb-0 small">
            <strong>Promo Terbatas!</strong> Upgrade ke VIP, dapatkan 150 Glints Credits per bulan gratis!
          </div>
        </li>
        @endif

        <!-- Credits -->
        <li class="px-3 py-2 border-bottom">
          <div class="d-flex justify-content-between align-items-center">
            <span class="small">Glints Credits: <strong>{{ Auth::guard('company')->user()->credits }}</strong></span>
            <a href="#" class="small fw-semibold text-primary text-decoration-none">Top Up</a>
          </div>
        </li>

        <!-- Menu navigasi -->
        <li><a class="dropdown-item" href="{{ route('company.account-settings.index') }}">Pengaturan Akun</a></li>
        <li><a class="dropdown-item" href="{{ route('company.profile.edit2') }}">Profil Perusahaan</a></li>
        <li><a class="dropdown-item" href="#">Tim Perusahaan</a></li>

        <li><hr class="dropdown-divider"></li>

        <!-- Logout -->
        <li>
          <form action="{{ route('logout') }}" method="POST">
            @csrf
            <button type="submit" class="dropdown-item text-danger d-flex align-items-center gap-2">
              <i class="fas fa-sign-out-alt"></i> Keluar
            </button>
          </form>
        </li>
      </ul>

        </div>
        @else
        <!-- Login/Register buttons for non-authenticated users -->
        <div class="d-flex gap-2">
          <a href="{{ route('company.login') }}" class="btn btn-outline-primary btn-sm">Masuk</a>
          <a href="{{ route('company.register') }}" class="btn btn-primary btn-sm">Daftar</a>
        </div>
        @endauth

        <!-- Garis pembatas -->
        <div class="border-start" style="height: 24px;"></div>

      <!-- Language dropdown -->
    <div class="dropdown">
      <button
        class="btn btn-sm btn-light d-flex align-items-center gap-1"
        type="button"
        id="langDropdown"
        data-bs-toggle="dropdown"
        aria-expanded="false">

        <i class="fas fa-globe text-secondary"></i>
        <span>ID</span>
        <i class="fas fa-chevron-down small text-secondary"></i>
      </button>

      <ul class="dropdown-menu dropdown-menu-end shadow-sm" aria-labelledby="langDropdown">
        <li>
          <a href="?lang=id" class="dropdown-item d-flex flex-column">
            <span class="fw-bold">ID</span>
            <small class="text-muted">Bahasa Indonesia</small>
          </a>
        </li>
        <li>
          <a href="?lang=en" class="dropdown-item d-flex flex-column">
            <span class="fw-bold">EN</span>
            <small class="text-muted">English</small>
          </a>
        </li>
      </ul>
    </div>

    </div>
  </div>
</nav>



    <!-- MAIN LAYOUT -->
    <div class="container-fluid">
        <div class="row">
            <!-- CONTENT -->
            <div class="col-12 content-wrapper">
                @yield('content')
            </div>
        </div>
    </div>

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
