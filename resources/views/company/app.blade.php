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
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css">

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
            height: 70px;
            width: auto;
            object-fit: contain;
        }
        .navbar .nav-link {
            color: #333;
            font-weight: 500;
            padding: 0.5rem 1rem;
            position: relative;
            padding-bottom: 6px;
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
    </style>
</head>
@stack('scripts')
<body>

    <!-- BANNER PERINGATAN (tengah) -->
<div class="alert alert-warning d-flex justify-content-center align-items-center border-0 rounded-0 mb-0 py-3 px-4 text-center"
     role="alert" style="background-color:#f8e1bc; color:#333; font-size:14px;">

  <!-- Icon -->
  <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="#F48620" class="me-2"
       viewBox="0 0 24 24">
    <path d="M12 22C6.477 22 2 17.523 2 12S6.477
             2 12 2s10 4.477 10 10-4.477 10-10
             10Zm-1-7v2h2v-2h-2Zm0-8v6h2V7h-2Z">
    </path>
  </svg>

  <!-- Text + Action -->
<span class="fw-semibold" style="font-size:17px;">
  Verifikasi perusahaan anda untuk posting lowongan pekerjaan dan dapatkan akses ke banyak fitur.
  <a href="#"
    class="fw-semibold text-primary text-decoration-none ms-1"
    data-bs-toggle="modal"
    data-bs-target="#verificationModal">
    Verifikasi Perusahaan
    </a>
</span>

</div>

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
                @if(Auth::guard('company')->user()->user->profile_picture)
                    <img src="{{ asset('storage/' . Auth::guard('company')->user()->user->profile_picture) }}"
                        alt="{{ Auth::guard('company')->user()->user->name }}"
                        class="rounded-circle border"
                        style="width: 30px; height: 30px; object-fit: cover;">
                @else
                    <div class="rounded-circle border d-flex align-items-center justify-content-center bg-light text-muted"
                        style="width: 30px; height: 30px; font-size: 14px;">
                        <i class="fas fa-user"></i>
                    </div>
                @endif
            </div>

            <!-- Info -->
            <div class="text-start small lh-1">
              <div class="fw-semibold">{{ Str::limit(Auth::guard('company')->user()->user->name, 10) }}...</div>
              <div class="d-flex align-items-center">
                <svg xmlns="http://www.w3.org/2000/svg"
                    width="12" height="12"
                    fill="red" viewBox="0 0 24 24"
                    class="me-1">
                  <path d="m10.72 2 4.2 5.78L22 7.69l-4.15 5.64L20.26 20l-6.76-2.22L7.88 22v-7.08L2 10.86l6.73-2.09L10.72 2Z"></path>
                </svg>
                <span class="text-dark">{{ Auth::guard('company')->user()->user->credits }}</span>
              </div>
            </div>
          </a>
          <ul class="dropdown-menu dropdown-menu-end shadow"
          style="min-width: 460px; border-radius: 10px;">

          <!-- Header profil -->
          <li class="px-3 py-3 d-flex align-items-center border-bottom">
              <div class="position-relative me-3">
                  @if(Auth::guard('company')->user()->user->profile_picture)
                      <img src="{{ asset('storage/' . Auth::guard('company')->user()->user->profile_picture) }}"
                          alt="{{ Auth::guard('company')->user()->user->name }}"
                          class="rounded-circle border"
                          style="width: 50px; height: 50px; object-fit: cover;">
                  @else
                      <div class="rounded-circle border d-flex align-items-center justify-content-center bg-light text-muted"
                          style="width: 50px; height: 50px; font-size: 20px;">
                          <i class="fas fa-user"></i>
                      </div>
                  @endif
              </div>
              <div>
                  <div class="fw-semibold" style="letter-spacing:1px;">{{ Auth::guard('company')->user()->user->name }}</div>
                  <small class="text-muted">{{ Auth::guard('company')->user()->user->country }}</small>
              </div>

              <!-- Badge Gratis / VIP -->
              @if(Auth::guard('company')->user()->isVip())
                  <span class="badge bg-warning text-dark ms-auto px-3 py-1">VIP</span>
              @else
                  <span class="badge bg-dark text-white ms-auto px-3 py-1" style="letter-spacing:2px;">Gratis</span>
              @endif
          </li>

         <!-- Status VIP -->
          <li class="px-3 py-2 d-flex align-items-center">
              <img src="{{ asset('images/glints-vip-icon.svg') }}" alt="VIP Icon"
              style="width:18px; height:18px; filter: grayscale(100%) contrast(100%);" class="me-2">



              <div>
                  <div class="text-muted small">
                      Glints VIP:
                      <span class="text-dark">
                          {{ Auth::guard('company')->user()->isVip() ? 'Aktif' : 'Tidak Aktif' }}
                      </span>
                  </div>
                  @if(!Auth::guard('company')->user()->isVip())
                      <a href="{{ route('company.premium-features.index') }}"
                        class="fw-semibold text-primary small text-decoration-none"
                        style="letter-spacing:1px;">
                          Upgrade ke VIP
                      </a>
                  @endif
              </div>
          </li>


          <!-- Promo (hanya tampil jika tidak VIP) -->
          @if(!Auth::guard('company')->user()->isVip())
              <li class="px-3 py-0 ms-4">
                  <div class="alert alert-warning p-2 mb-0 small" style="background-color:#ffeb3b;">
                      <strong>Promo Terbatas!</strong> Upgrade ke VIP, dapatkan 150 Glints Credits per bulan gratis!
                  </div>
              </li>
          @endif

          <!-- Credits -->
          <li class="px-3 py-2">
              <div class="d-flex justify-content-between align-items-center">
                  <span class="small d-flex align-items-center gap-1">
                      <i class="fas fa-star" style="color:#6c757d; font-size:18px;"></i>
                      Glints Credits: {{ Auth::guard('company')->user()->credits }}
                  </span>
              </div>

              @if(!Auth::guard('company')->user()->isVip())
                  <a href="{{ route('company.premium-features.index') }}"
                    class="small fw-semibold text-primary text-decoration-none d-block mt-1 ms-4"
                    style="letter-spacing:1px;">
                      Top Up
                  </a>
              @endif
          </li>

<!-- Menu navigasi -->
<li>
    <a class="dropdown-item d-flex align-items-center gap-2" href="{{ route('company.account-settings.index') }}">
        <i class="bi bi-gear"></i> Pengaturan Akun
    </a>
</li>
<li>
    <a class="dropdown-item d-flex align-items-center gap-2" href="{{ route('company.profile.edit2') }}">
        <i class="bi bi-building"></i> Profil Perusahaan
    </a>
</li>
<li>
    <a class="dropdown-item d-flex align-items-center gap-2" href="{{ route('company.tim.index') }}">
        <i class="bi bi-people"></i> Tim Perusahaan
    </a>
</li>

<!-- Logout -->
<li>
    <form action="{{ route('logout') }}" method="POST">
        @csrf
        <button type="submit" class="dropdown-item d-flex align-items-center gap-2">
            <i class="bi bi-arrow-counterclockwise"></i> Keluar
        </button>
    </form>
</li>

      </ul>

        </div>
        @else
        <!-- Login/Register buttons -->
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
