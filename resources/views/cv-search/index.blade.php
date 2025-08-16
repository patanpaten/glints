<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>CV Search - Glints</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.0/font/bootstrap-icons.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css">
    <style>
        .search-form {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            color: white;
            padding: 40px 0;
            border-radius: 15px;
            margin-bottom: 30px;
        }
        .filter-section {
            background-color: #f8f9fa;
            border-radius: 10px;
            padding: 20px;
            margin-bottom: 20px;
        }
        .recent-search {
            background-color: white;
            border: 1px solid #dee2e6;
            border-radius: 8px;
            padding: 15px;
            margin-bottom: 15px;
            transition: all 0.3s;
        }
        .recent-search:hover {
            box-shadow: 0 5px 15px rgba(0,0,0,0.1);
            transform: translateY(-2px);
        }
        .search-stats {
            background: linear-gradient(45deg, #28a745, #20c997);
            color: white;
            border-radius: 10px;
            padding: 20px;
            text-align: center;
        }
        .select2-container--default .select2-selection--multiple {
            border: 1px solid #ced4da;
            border-radius: 0.375rem;
        }
    </style>
</head>
<body>
    <div class="container-fluid">
        <div class="row">
            <!-- Sidebar -->
            <div class="col-md-3 col-lg-2 d-md-block bg-dark sidebar collapse" style="min-height: 100vh;">
                <div class="position-sticky pt-3">
                    <div class="text-center mb-4">
                        <h4 class="text-white">CV Search</h4>
                        <p class="text-white-50">Find Perfect Candidates</p>
                    </div>
                    
                    <ul class="nav flex-column">
                        <li class="nav-item">
                            <a class="nav-link text-white" href="{{ route('company.dashboard') }}">
                                <i class="bi bi-speedometer2 me-2"></i>
                                Dashboard
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link text-white" href="{{ route('company.jobs.index') }}">
                                <i class="bi bi-briefcase me-2"></i>
                                Manage Jobs
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link text-white" href="{{ route('company.applications.all') }}">
                                <i class="bi bi-file-earmark-text me-2"></i>
                                Applications
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link active text-white" href="{{ route('company.cv-search.index') }}">
                                <i class="bi bi-search me-2"></i>
                                CV Search
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link text-white" href="{{ route('company.analytics.dashboard') }}">
                                <i class="bi bi-bar-chart me-2"></i>
                                Analytics
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link text-white" href="{{ route('company.premium-features.index') }}">
                                <i class="bi bi-star me-2"></i>
                                Premium Features
                            </a>
                        </li>
                        <li class="nav-item mt-5">
                            <form action="{{ route('logout') }}" method="POST">
                                @csrf
                                <button type="submit" class="nav-link text-white border-0 bg-transparent">
                                    <i class="bi bi-box-arrow-right me-2"></i>
                                    Logout
                                </button>
                            </form>
                        </li>
                    </ul>
                </div>
            </div>

            <!-- Main Content -->
            <div class="col-md-9 ms-sm-auto col-lg-10 px-md-4">
                <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
                    <h1 class="h2">CV Search</h1>
                    <div class="btn-toolbar mb-2 mb-md-0">
                        <div class="btn-group me-2">
                            <a href="{{ route('company.premium-features.index') }}" class="btn btn-sm btn-outline-primary">
                                <i class="bi bi-star"></i> Upgrade to Premium
                            </a>
                        </div>
                    </div>
                </div>

                <!-- Search Stats -->
                <div class="search-stats mb-4">
                    <h4><i class="bi bi-search"></i> Find Your Perfect Candidate</h4>
                    <p class="mb-0">Search through thousands of qualified candidates with advanced filters</p>
                </div>

                <!-- Search Form -->
                <div class="search-form">
                    <div class="container">
                        <form action="{{ route('company.cv-search.search') }}" method="POST" id="cvSearchForm">
                            @csrf
                            <div class="row g-3">
                                <div class="col-md-6">
                                    <label for="search_query" class="form-label">Search Keywords</label>
                                    <input type="text" class="form-control form-control-lg" id="search_query" name="search_query" 
                                           placeholder="e.g., Software Engineer, Marketing Manager, etc." required>
                                </div>
                                <div class="col-md-6">
                                    <label for="location" class="form-label">Location</label>
                                    <input type="text" class="form-control form-control-lg" id="location" name="location" 
                                           placeholder="e.g., Jakarta, Remote, etc.">
                                </div>
                                <div class="col-md-6">
                                    <label for="skills" class="form-label">Skills</label>
                                    <select class="form-control form-control-lg" id="skills" name="skills[]" multiple>
                                        @foreach($skills as $skill)
                                            <option value="{{ $skill->id }}">{{ $skill->name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="col-md-6">
                                    <label for="category_id" class="form-label">Job Category</label>
                                    <select class="form-control form-control-lg" id="category_id" name="category_id">
                                        <option value="">All Categories</option>
                                        @foreach($categories as $category)
                                            <option value="{{ $category->id }}">{{ $category->name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="col-md-6">
                                    <label for="experience_min" class="form-label">Minimum Experience (Years)</label>
                                    <input type="number" class="form-control form-control-lg" id="experience_min" name="experience_min" 
                                           min="0" max="50" placeholder="0">
                                </div>
                                <div class="col-md-6">
                                    <label for="experience_max" class="form-label">Maximum Experience (Years)</label>
                                    <input type="number" class="form-control form-control-lg" id="experience_max" name="experience_max" 
                                           min="0" max="50" placeholder="10">
                                </div>
                                <div class="col-md-6">
                                    <label for="education_level" class="form-label">Education Level</label>
                                    <select class="form-control form-control-lg" id="education_level" name="education_level">
                                        <option value="">Any Education Level</option>
                                        <option value="SMA">SMA/SMK</option>
                                        <option value="D3">D3</option>
                                        <option value="S1">S1</option>
                                        <option value="S2">S2</option>
                                        <option value="S3">S3</option>
                                    </select>
                                </div>
                                <div class="col-12 text-center">
                                    <button type="submit" class="btn btn-light btn-lg px-5">
                                        <i class="bi bi-search"></i> Search Candidates
                                    </button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>

                <!-- Recent Searches -->
                @if($recentSearches->count() > 0)
                    <div class="filter-section">
                        <h5><i class="bi bi-clock-history"></i> Recent Searches</h5>
                        <div class="row">
                            @foreach($recentSearches as $search)
                                <div class="col-md-6">
                                    <div class="recent-search">
                                        <div class="d-flex justify-content-between align-items-start">
                                            <div>
                                                <h6 class="mb-1">{{ $search->search_query }}</h6>
                                                <p class="text-muted mb-1 small">{{ $search->filters_string }}</p>
                                                <small class="text-muted">{{ $search->results_count }} results found</small>
                                            </div>
                                            <div class="text-end">
                                                <small class="text-muted">{{ $search->created_at->diffForHumans() }}</small>
                                                <br>
                                                <a href="{{ route('company.cv-search.results', $search->id) }}" class="btn btn-sm btn-outline-primary">
                                                    View Results
                                                </a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div>
                @endif

                <!-- Search Tips -->
                <div class="filter-section">
                    <h5><i class="bi bi-lightbulb"></i> Search Tips</h5>
                    <div class="row">
                        <div class="col-md-4">
                            <div class="text-center">
                                <i class="bi bi-keyboard fs-1 text-primary mb-2"></i>
                                <h6>Use Specific Keywords</h6>
                                <p class="text-muted small">Be specific with job titles and skills to get better matches.</p>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="text-center">
                                <i class="bi bi-funnel fs-1 text-primary mb-2"></i>
                                <h6>Apply Filters</h6>
                                <p class="text-muted small">Use location, experience, and education filters to narrow down results.</p>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="text-center">
                                <i class="bi bi-star fs-1 text-primary mb-2"></i>
                                <h6>Premium Features</h6>
                                <p class="text-muted small">Upgrade to access advanced search features and larger candidate pool.</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
    <script>
        $(document).ready(function() {
            // Initialize Select2 for skills
            $('#skills').select2({
                placeholder: 'Select skills...',
                allowClear: true,
                tags: true,
                tokenSeparators: [',', ' ']
            });

            // Form validation
            $('#cvSearchForm').on('submit', function(e) {
                const searchQuery = $('#search_query').val().trim();
                if (!searchQuery) {
                    e.preventDefault();
                    alert('Please enter search keywords');
                    $('#search_query').focus();
                    return false;
                }
            });

            // Auto-suggestions for search query
            $('#search_query').on('input', function() {
                const query = $(this).val().trim();
                if (query.length >= 2) {
                    // You can implement AJAX suggestions here
                }
            });

            // Experience validation
            $('#experience_min, #experience_max').on('change', function() {
                const min = parseInt($('#experience_min').val()) || 0;
                const max = parseInt($('#experience_max').val()) || 0;
                
                if (max > 0 && min > max) {
                    alert('Maximum experience cannot be less than minimum experience');
                    $(this).val('');
                }
            });
        });
    </script>
</body>
</html>
