<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>About Us - Glints</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.0/font/bootstrap-icons.css">
    <style>
        .hero-section {
            background: linear-gradient(rgba(0, 0, 0, 0.7), rgba(0, 0, 0, 0.7)), url('https://images.unsplash.com/photo-1522071820081-009f0129c71c?ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D&auto=format&fit=crop&w=1920&q=80');
            background-size: cover;
            background-position: center;
            color: white;
            padding: 100px 0;
        }
        .team-member {
            transition: transform 0.3s;
        }
        .team-member:hover {
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
                        <a class="nav-link" href="{{ route('home') }}">Home</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('jobs.index') }}">Jobs</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link active" href="{{ route('about') }}">About</a>
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
            <h1 class="display-4 fw-bold mb-4">About Glints</h1>
            <p class="lead">Connecting talent with opportunity since 2023</p>
        </div>
    </section>

    <!-- About Section -->
    <section class="py-5">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-md-6 mb-4 mb-md-0">
                    <h2 class="mb-4">Our Mission</h2>
                    <p class="lead">To empower individuals to find meaningful careers and help companies discover exceptional talent.</p>
                    <p>At Glints, we believe that the right job can transform a person's life, and the right talent can transform a company. Our platform is designed to make these connections seamless, efficient, and effective.</p>
                    <p>We're committed to creating a job marketplace that values transparency, fairness, and opportunity for all, regardless of background or experience level.</p>
                </div>
                <div class="col-md-6">
                    <img src="https://images.unsplash.com/photo-1552664730-d307ca884978?ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D&auto=format&fit=crop&w=800&q=80" alt="Team meeting" class="img-fluid rounded shadow">
                </div>
            </div>
        </div>
    </section>

    <!-- Values Section -->
    <section class="py-5 bg-light">
        <div class="container">
            <h2 class="text-center mb-5">Our Values</h2>
            <div class="row">
                <div class="col-md-4 mb-4">
                    <div class="card h-100 shadow-sm">
                        <div class="card-body text-center">
                            <i class="bi bi-people-fill fs-1 text-primary mb-3"></i>
                            <h4 class="card-title">Community First</h4>
                            <p class="card-text">We prioritize building a supportive community where job seekers and employers can thrive together.</p>
                        </div>
                    </div>
                </div>
                <div class="col-md-4 mb-4">
                    <div class="card h-100 shadow-sm">
                        <div class="card-body text-center">
                            <i class="bi bi-lightbulb-fill fs-1 text-primary mb-3"></i>
                            <h4 class="card-title">Innovation</h4>
                            <p class="card-text">We constantly seek new ways to improve the job search and recruitment process through technology and creative solutions.</p>
                        </div>
                    </div>
                </div>
                <div class="col-md-4 mb-4">
                    <div class="card h-100 shadow-sm">
                        <div class="card-body text-center">
                            <i class="bi bi-shield-check fs-1 text-primary mb-3"></i>
                            <h4 class="card-title">Integrity</h4>
                            <p class="card-text">We operate with honesty, transparency, and a commitment to fairness in all our interactions.</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Team Section -->
    <section class="py-5">
        <div class="container">
            <h2 class="text-center mb-5">Our Leadership Team</h2>
            <div class="row">
                <div class="col-md-3 mb-4">
                    <div class="card team-member h-100 text-center shadow-sm">
                        <img src="https://randomuser.me/api/portraits/men/32.jpg" class="card-img-top" alt="Team member">
                        <div class="card-body">
                            <h5 class="card-title">John Smith</h5>
                            <p class="card-text text-muted">CEO & Founder</p>
                            <div class="d-flex justify-content-center gap-2 fs-5">
                                <a href="#" class="text-primary"><i class="bi bi-linkedin"></i></a>
                                <a href="#" class="text-primary"><i class="bi bi-twitter"></i></a>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-3 mb-4">
                    <div class="card team-member h-100 text-center shadow-sm">
                        <img src="https://randomuser.me/api/portraits/women/44.jpg" class="card-img-top" alt="Team member">
                        <div class="card-body">
                            <h5 class="card-title">Sarah Johnson</h5>
                            <p class="card-text text-muted">CTO</p>
                            <div class="d-flex justify-content-center gap-2 fs-5">
                                <a href="#" class="text-primary"><i class="bi bi-linkedin"></i></a>
                                <a href="#" class="text-primary"><i class="bi bi-twitter"></i></a>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-3 mb-4">
                    <div class="card team-member h-100 text-center shadow-sm">
                        <img src="https://randomuser.me/api/portraits/men/67.jpg" class="card-img-top" alt="Team member">
                        <div class="card-body">
                            <h5 class="card-title">Michael Chen</h5>
                            <p class="card-text text-muted">COO</p>
                            <div class="d-flex justify-content-center gap-2 fs-5">
                                <a href="#" class="text-primary"><i class="bi bi-linkedin"></i></a>
                                <a href="#" class="text-primary"><i class="bi bi-twitter"></i></a>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-3 mb-4">
                    <div class="card team-member h-100 text-center shadow-sm">
                        <img src="https://randomuser.me/api/portraits/women/28.jpg" class="card-img-top" alt="Team member">
                        <div class="card-body">
                            <h5 class="card-title">Emily Rodriguez</h5>
                            <p class="card-text text-muted">Head of Marketing</p>
                            <div class="d-flex justify-content-center gap-2 fs-5">
                                <a href="#" class="text-primary"><i class="bi bi-linkedin"></i></a>
                                <a href="#" class="text-primary"><i class="bi bi-twitter"></i></a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Stats Section -->
    <section class="py-5 bg-primary text-white">
        <div class="container">
            <div class="row text-center">
                <div class="col-md-3 mb-4 mb-md-0">
                    <h2 class="display-4 fw-bold">500+</h2>
                    <p class="lead">Companies</p>
                </div>
                <div class="col-md-3 mb-4 mb-md-0">
                    <h2 class="display-4 fw-bold">10,000+</h2>
                    <p class="lead">Job Seekers</p>
                </div>
                <div class="col-md-3 mb-4 mb-md-0">
                    <h2 class="display-4 fw-bold">5,000+</h2>
                    <p class="lead">Jobs Posted</p>
                </div>
                <div class="col-md-3">
                    <h2 class="display-4 fw-bold">3,000+</h2>
                    <p class="lead">Successful Hires</p>
                </div>
            </div>
        </div>
    </section>

    <!-- CTA Section -->
    <section class="py-5 bg-light text-center">
        <div class="container">
            <h2 class="mb-4">Join Our Growing Community</h2>
            <p class="lead mb-4">Whether you're looking for your next career move or searching for top talent, Glints is here to help.</p>
            <div class="d-flex justify-content-center gap-3">
                <a href="{{ route('register') }}" class="btn btn-primary btn-lg px-4">Sign Up Now</a>
                <a href="{{ route('contact') }}" class="btn btn-outline-primary btn-lg px-4">Contact Us</a>
            </div>
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