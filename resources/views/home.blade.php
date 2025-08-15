<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Glints - Job Portal</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.0/font/bootstrap-icons.css">
    <style>
        .hero-section {
            background: linear-gradient(rgba(0, 0, 0, 0.7), rgba(0, 0, 0, 0.7)), url('https://images.unsplash.com/photo-1521737711867-e3b97375f902?ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D&auto=format&fit=crop&w=1920&q=80');
            background-size: cover;
            background-position: center;
            color: white;
            padding: 100px 0;
        }
        .feature-card {
            transition: transform 0.3s;
        }
        .feature-card:hover {
            transform: translateY(-10px);
        }
    </style>
</head>
<body>
    <!-- Navigation -->
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
        <div class="container">
            <a class="navbar-brand" href="{{ route('home') }}">Glints</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav me-auto">
                    <li class="nav-item">
                        <a class="nav-link active" href="{{ route('home') }}">Home</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('jobs.index') }}">Jobs</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('about') }}">About</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('contact') }}">Contact</a>
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
                            <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                                {{ Auth::user()->name }}
                            </a>
                            <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown">
                                @if(Auth::user()->isAdmin())
                                    <li><a class="dropdown-item" href="{{ route('admin.dashboard') }}">Dashboard</a></li>
                                @elseif(Auth::user()->isCompany())
                                    <li><a class="dropdown-item" href="{{ route('company.dashboard') }}">Dashboard</a></li>
                                @elseif(Auth::user()->isJobSeeker())
                                    <li><a class="dropdown-item" href="{{ route('jobseeker.dashboard') }}">Dashboard</a></li>
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
    <section class="hero-section text-center">
        <div class="container">
            <h1 class="display-4 fw-bold mb-4">Find Your Dream Job Today</h1>
            <p class="lead mb-5">Connect with top employers and discover opportunities that match your skills and aspirations.</p>
            <form action="{{ route('jobs.index') }}" method="GET" class="row g-3 justify-content-center">
                <div class="col-md-5">
                    <input type="text" name="search" class="form-control form-control-lg" placeholder="Job title, keywords, or company">
                </div>
                <div class="col-md-3">
                    <select name="category" class="form-select form-select-lg">
                        <option value="">All Categories</option>
                        @foreach(\App\Models\JobCategory::all() as $category)
                            <option value="{{ $category->id }}">{{ $category->name }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="col-md-2">
                    <button type="submit" class="btn btn-primary btn-lg w-100">Search</button>
                </div>
            </form>
        </div>
    </section>

    <!-- Featured Jobs Section -->
    <section class="py-5">
        <div class="container">
            <h2 class="text-center mb-5">Featured Jobs</h2>
            <div class="row">
                @foreach(\App\Models\Job::where('is_active', true)->latest()->take(6)->get() as $job)
                    <div class="col-md-4 mb-4">
                        <div class="card h-100 shadow-sm">
                            <div class="card-body">
                                <h5 class="card-title">{{ $job->title }}</h5>
                                <h6 class="card-subtitle mb-2 text-muted">{{ $job->company->name }}</h6>
                                <p class="card-text">{{ Str::limit($job->description, 100) }}</p>
                                <div class="d-flex justify-content-between align-items-center">
                                    <span class="badge bg-primary">{{ $job->job_type }}</span>
                                    <small class="text-muted">{{ $job->created_at->diffForHumans() }}</small>
                                </div>
                            </div>
                            <div class="card-footer bg-transparent border-top-0">
                                <a href="{{ route('jobs.show', $job->id) }}" class="btn btn-outline-primary w-100">View Details</a>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
            <div class="text-center mt-4">
                <a href="{{ route('jobs.index') }}" class="btn btn-outline-primary">View All Jobs</a>
            </div>
        </div>
    </section>

    <!-- Categories Section -->
    <section class="py-5 bg-light">
        <div class="container">
            <h2 class="text-center mb-5">Browse by Category</h2>
            <div class="row">
                @foreach(\App\Models\JobCategory::withCount('jobs')->orderByDesc('jobs_count')->take(8)->get() as $category)
                    <div class="col-md-3 mb-4">
                        <a href="{{ route('jobs.category', $category->id) }}" class="text-decoration-none">
                            <div class="card feature-card h-100 text-center shadow-sm">
                                <div class="card-body">
                                    <i class="bi bi-briefcase fs-1 text-primary mb-3"></i>
                                    <h5 class="card-title">{{ $category->name }}</h5>
                                    <p class="card-text text-muted">{{ $category->jobs_count }} Jobs Available</p>
                                </div>
                            </div>
                        </a>
                    </div>
                @endforeach
            </div>
        </div>
    </section>

    <!-- Features Section -->
    <section class="py-5">
        <div class="container">
            <h2 class="text-center mb-5">Why Choose Glints?</h2>
            <div class="row">
                <div class="col-md-4 mb-4">
                    <div class="card feature-card h-100 text-center shadow-sm">
                        <div class="card-body">
                            <i class="bi bi-search fs-1 text-primary mb-3"></i>
                            <h5 class="card-title">Find the Perfect Job</h5>
                            <p class="card-text">Browse thousands of job listings from top companies across various industries.</p>
                        </div>
                    </div>
                </div>
                <div class="col-md-4 mb-4">
                    <div class="card feature-card h-100 text-center shadow-sm">
                        <div class="card-body">
                            <i class="bi bi-person-badge fs-1 text-primary mb-3"></i>
                            <h5 class="card-title">Professional Profile</h5>
                            <p class="card-text">Create a comprehensive profile to showcase your skills and experience to employers.</p>
                        </div>
                    </div>
                </div>
                <div class="col-md-4 mb-4">
                    <div class="card feature-card h-100 text-center shadow-sm">
                        <div class="card-body">
                            <i class="bi bi-building fs-1 text-primary mb-3"></i>
                            <h5 class="card-title">For Employers</h5>
                            <p class="card-text">Post job openings and find qualified candidates for your company's positions.</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- CTA Section -->
    <section class="py-5 bg-primary text-white text-center">
        <div class="container">
            <h2 class="mb-4">Ready to Start Your Career Journey?</h2>
            <p class="lead mb-4">Join thousands of job seekers who have found their dream jobs through Glints.</p>
            <a href="{{ route('register') }}" class="btn btn-light btn-lg px-4 me-2">Sign Up Now</a>
            <a href="{{ route('jobs.index') }}" class="btn btn-outline-light btn-lg px-4">Browse Jobs</a>
        </div>
    </section>

    <!-- Footer -->
    <footer class="bg-dark text-white py-5">
        <div class="container">
            <div class="row">
                <div class="col-md-4 mb-4">
                    <h5>Glints</h5>
                    <p>Your trusted platform for finding the perfect job match and advancing your career.</p>
                </div>
                <div class="col-md-2 mb-4">
                    <h5>For Job Seekers</h5>
                    <ul class="list-unstyled">
                        <li><a href="{{ route('jobs.index') }}" class="text-white">Browse Jobs</a></li>
                        <li><a href="#" class="text-white">Career Advice</a></li>
                        <li><a href="#" class="text-white">Resume Tips</a></li>
                    </ul>
                </div>
                <div class="col-md-2 mb-4">
                    <h5>For Employers</h5>
                    <ul class="list-unstyled">
                        <li><a href="{{ route('register') }}" class="text-white">Post a Job</a></li>
                        <li><a href="#" class="text-white">Hiring Solutions</a></li>
                        <li><a href="#" class="text-white">Pricing</a></li>
                    </ul>
                </div>
                <div class="col-md-2 mb-4">
                    <h5>Company</h5>
                    <ul class="list-unstyled">
                        <li><a href="{{ route('about') }}" class="text-white">About Us</a></li>
                        <li><a href="{{ route('contact') }}" class="text-white">Contact Us</a></li>
                        <li><a href="#" class="text-white">Privacy Policy</a></li>
                    </ul>
                </div>
                <div class="col-md-2 mb-4">
                    <h5>Connect</h5>
                    <div class="d-flex gap-3 fs-4">
                        <a href="#" class="text-white"><i class="bi bi-facebook"></i></a>
                        <a href="#" class="text-white"><i class="bi bi-twitter"></i></a>
                        <a href="#" class="text-white"><i class="bi bi-linkedin"></i></a>
                        <a href="#" class="text-white"><i class="bi bi-instagram"></i></a>
                    </div>
                </div>
            </div>
            <hr>
            <div class="text-center">
                <p>&copy; {{ date('Y') }} Glints. All rights reserved.</p>
            </div>
        </div>
    </footer>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>