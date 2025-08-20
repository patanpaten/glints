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
        }
        .navbar-brand img {
            height: 30px;
            margin-right: 5px;
        }
        .navbar .nav-link {
            color: #333;
            font-weight: 500;
            padding: 0.5rem 1rem;
        }
        .navbar .nav-link.active {
            color: #0d6efd;
            font-weight: 600;
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
    <nav class="navbar navbar-expand-lg navbar-light sticky-top">
        <div class="container-fluid px-4">
            <a class="navbar-brand d-flex align-items-center" href="{{ route('company.dashboard') }}">
                <img src="/images/logohome.svg" alt="Glints" style="height: 80px;">
            </a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
                <span class="navbar-toggler-icon"></span>
            </button>

            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav me-auto">
                    <li class="nav-item">
                        <a class="nav-link {{ request()->routeIs('company.dashboard') ? 'active' : '' }}" href="{{ route('company.dashboard') }}">DASHBOARD</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link {{ request()->routeIs('company.premium-features.*') ? 'active' : '' }}" href="{{ route('company.premium-features.index') }}">FITUR PREMIUM</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link {{ request()->routeIs('company.cv-search.*') ? 'active' : '' }}" href="{{ route('company.cv-search.index') }}">CARI CV</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link {{ request()->routeIs('company.analytics.*') ? 'active' : '' }}" href="{{ route('company.analytics.dashboard') }}">ANALYTICS</a>
                    </li>
                </ul>
                
                <div class="d-flex align-items-center gap-3">
                    <button class="btn btn-chat position-relative">
                        <i class="far fa-comment-alt"></i> CHAT
                        <span class="badge rounded-pill">25</span>
                    </button>
                    <a href="{{ route('company.jobs.create') }}" class="btn btn-loker">
                        <i class="fas fa-plus-circle"></i> PASANG LOKER
                    </a>
                    <div class="dropdown">
                        <a class="nav-link dropdown-toggle d-flex align-items-center gap-2" href="#" id="profileDropdown" role="button" data-bs-toggle="dropdown">
                            <div class="d-flex flex-column align-items-end">
                                <span>Area</span>
                                <span class="user-rating">⭐ 4.90</span>
                            </div>
                            <div class="user-avatar">A</div>
                        </a>
                        <ul class="dropdown-menu dropdown-menu-end">
                            <li><a class="dropdown-item" href="{{ route('company.profile') }}">Profil</a></li>
                            <li><a class="dropdown-item" href="#">Pengaturan</a></li>
                            <li><hr class="dropdown-divider"></li>
                            <li>
                                <form action="{{ route('logout') }}" method="POST">
                                    @csrf
                                    <button type="submit" class="dropdown-item">Logout</button>
                                </form>
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
