<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Premium Features - Glints</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.0/font/bootstrap-icons.css">
    <style>
        .feature-card {
            transition: transform 0.3s, box-shadow 0.3s;
            border: 2px solid transparent;
        }
        .feature-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 10px 25px rgba(0,0,0,0.1);
        }
        .feature-card.featured {
            border-color: #ffc107;
            position: relative;
        }
        .feature-card.featured::before {
            content: 'Most Popular';
            position: absolute;
            top: -10px;
            right: 20px;
            background: #ffc107;
            color: #000;
            padding: 5px 15px;
            border-radius: 20px;
            font-size: 0.8rem;
            font-weight: bold;
        }
        .price {
            font-size: 2.5rem;
            font-weight: bold;
            color: #007bff;
        }
        .price .currency {
            font-size: 1rem;
            vertical-align: top;
        }
        .price .period {
            font-size: 1rem;
            color: #6c757d;
        }
        .feature-list {
            list-style: none;
            padding: 0;
        }
        .feature-list li {
            padding: 8px 0;
            border-bottom: 1px solid #f8f9fa;
        }
        .feature-list li:last-child {
            border-bottom: none;
        }
        .feature-list li i {
            color: #28a745;
            margin-right: 10px;
        }
        .subscription-status {
            position: absolute;
            top: 15px;
            right: 15px;
            z-index: 10;
        }
    </style>
</head>
<body>
    <!-- Navigation -->
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
        <div class="container">
            <a class="navbar-brand" href="{{ route('home') }}">Glints</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav me-auto">
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('home') }}">Home</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('jobs.index') }}">Jobs</a>
                    </li>
                </ul>
                <ul class="navbar-nav">
                    @guest
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('login') }}">Login</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('register') }}">Register</a>
                        </li>
                    @else
                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown">
                                {{ Auth::user()->name }}
                            </a>
                            <ul class="dropdown-menu">
                                @if(Auth::user()->isCompany())
                                    <li><a class="dropdown-item" href="{{ route('company.dashboard') }}">Dashboard</a></li>
                                    <li><a class="dropdown-item" href="{{ route('company.subscriptions.history') }}">My Subscriptions</a></li>
                                @endif
                                <li><hr class="dropdown-divider"></li>
                                <li>
                                    <form action="{{ route('logout') }}" method="POST">
                                        @csrf
                                        <button type="submit" class="dropdown-item">Logout</button>
                                    </form>
                                </li>
                            </ul>
                        </li>
                    @endguest
                </ul>
            </div>
        </div>
    </nav>

    <!-- Hero Section -->
    <section class="py-5 bg-primary text-white text-center">
        <div class="container">
            <h1 class="display-4 fw-bold mb-4">Unlock Premium Features</h1>
            <p class="lead mb-4">Take your hiring to the next level with our premium features designed for companies.</p>
            @if(Auth::user() && Auth::user()->isCompany())
                <a href="{{ route('company.subscriptions.history') }}" class="btn btn-light btn-lg">View My Subscriptions</a>
            @else
                <a href="{{ route('register') }}" class="btn btn-light btn-lg">Get Started</a>
            @endif
        </div>
    </section>

    <!-- Features Section -->
    <section class="py-5">
        <div class="container">
            <div class="row">
                @foreach($features as $feature)
                    <div class="col-lg-4 col-md-6 mb-4">
                        <div class="card feature-card h-100 {{ $feature->name === 'Professional' ? 'featured' : '' }}">
                            @if(Auth::user() && Auth::user()->isCompany())
                                @php
                                    $hasActiveSubscription = $feature->hasActiveSubscription(Auth::user()->company->id);
                                @endphp
                                @if($hasActiveSubscription)
                                    <div class="subscription-status">
                                        <span class="badge bg-success">Active</span>
                                    </div>
                                @endif
                            @endif
                            
                            <div class="card-body text-center">
                                <h4 class="card-title">{{ $feature->name }}</h4>
                                <p class="card-text text-muted">{{ $feature->description }}</p>
                                
                                <div class="price mb-4">
                                    <span class="currency">$</span>{{ number_format($feature->price, 2) }}
                                    <span class="period">/ {{ $feature->duration_days }} days</span>
                                </div>
                                
                                <ul class="feature-list text-start mb-4">
                                    @foreach($feature->features as $featureItem)
                                        <li>
                                            <i class="bi bi-check-circle-fill"></i>
                                            {{ $featureItem }}
                                        </li>
                                    @endforeach
                                </ul>
                                
                                @if(Auth::user() && Auth::user()->isCompany())
                                    @if($hasActiveSubscription)
                                        <button class="btn btn-success w-100" disabled>
                                            <i class="bi bi-check-circle"></i> Subscribed
                                        </button>
                                    @else
                                        <form action="{{ route('company.premium-features.subscribe', $feature->id) }}" method="POST">
                                            @csrf
                                            <button type="submit" class="btn btn-primary w-100">
                                                <i class="bi bi-star"></i> Subscribe Now
                                            </button>
                                        </form>
                                    @endif
                                @else
                                    <a href="{{ route('register') }}" class="btn btn-primary w-100">
                                        <i class="bi bi-person-plus"></i> Sign Up to Subscribe
                                    </a>
                                @endif
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </section>

    <!-- Benefits Section -->
    <section class="py-5 bg-light">
        <div class="container">
            <h2 class="text-center mb-5">Why Choose Premium Features?</h2>
            <div class="row">
                <div class="col-md-4 mb-4">
                    <div class="text-center">
                        <i class="bi bi-graph-up-arrow fs-1 text-primary mb-3"></i>
                        <h5>Better Hiring Results</h5>
                        <p class="text-muted">Access advanced tools to find the perfect candidates faster and more efficiently.</p>
                    </div>
                </div>
                <div class="col-md-4 mb-4">
                    <div class="text-center">
                        <i class="bi bi-people fs-1 text-primary mb-3"></i>
                        <h5>Larger Talent Pool</h5>
                        <p class="text-muted">Reach more qualified candidates with premium job posting features and CV search.</p>
                    </div>
                </div>
                <div class="col-md-4 mb-4">
                    <div class="text-center">
                        <i class="bi bi-bar-chart fs-1 text-primary mb-3"></i>
                        <h5>Detailed Analytics</h5>
                        <p class="text-muted">Get insights into your job performance and candidate engagement with comprehensive analytics.</p>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- CTA Section -->
    <section class="py-5 bg-dark text-white text-center">
        <div class="container">
            <h2 class="mb-4">Ready to Upgrade?</h2>
            <p class="lead mb-4">Join thousands of companies that have improved their hiring process with Glints Premium.</p>
            @if(Auth::user() && Auth::user()->isCompany())
                <a href="{{ route('company.dashboard') }}" class="btn btn-primary btn-lg">Go to Dashboard</a>
            @else
                <a href="{{ route('register') }}" class="btn btn-primary btn-lg">Start Free Trial</a>
            @endif
        </div>
    </section>

    <!-- Footer -->
    <footer class="bg-dark text-white py-4">
        <div class="container text-center">
            <p>&copy; {{ date('Y') }} Glints. All rights reserved.</p>
        </div>
    </footer>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
