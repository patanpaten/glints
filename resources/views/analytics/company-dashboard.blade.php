<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Analytics Dashboard - Glints</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.0/font/bootstrap-icons.css">
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <style>
        .metric-card {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            color: white;
            border-radius: 15px;
            padding: 20px;
            margin-bottom: 20px;
            transition: transform 0.3s;
        }
        .metric-card:hover {
            transform: translateY(-5px);
        }
        .metric-card.success {
            background: linear-gradient(135deg, #28a745 0%, #20c997 100%);
        }
        .metric-card.info {
            background: linear-gradient(135deg, #17a2b8 0%, #6f42c1 100%);
        }
        .metric-card.warning {
            background: linear-gradient(135deg, #ffc107 0%, #fd7e14 100%);
        }
        .metric-value {
            font-size: 2.5rem;
            font-weight: bold;
            margin-bottom: 5px;
        }
        .metric-label {
            font-size: 0.9rem;
            opacity: 0.9;
        }
        .chart-container {
            background: white;
            border-radius: 10px;
            padding: 20px;
            box-shadow: 0 2px 10px rgba(0,0,0,0.1);
            margin-bottom: 20px;
        }
        .export-section {
            background: #f8f9fa;
            border-radius: 10px;
            padding: 20px;
            margin-bottom: 20px;
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
                        <h4 class="text-white">Analytics</h4>
                        <p class="text-white-50">Performance Insights</p>
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
                            <a class="nav-link text-white" href="{{ route('company.cv-search.index') }}">
                                <i class="bi bi-search me-2"></i>
                                CV Search
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link active text-white" href="{{ route('company.analytics.dashboard') }}">
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
                    <h1 class="h2">Analytics Dashboard</h1>
                    <div class="btn-toolbar mb-2 mb-md-0">
                        <div class="btn-group me-2">
                            <a href="{{ route('company.analytics.export') }}" class="btn btn-sm btn-outline-primary">
                                <i class="bi bi-download"></i> Export Data
                            </a>
                        </div>
                    </div>
                </div>

                <!-- Key Metrics -->
                <div class="row mb-4">
                    <div class="col-md-3">
                        <div class="metric-card">
                            <div class="metric-value">{{ number_format($totalViews) }}</div>
                            <div class="metric-label">Total Job Views</div>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="metric-card success">
                            <div class="metric-value">{{ number_format($totalApplications) }}</div>
                            <div class="metric-label">Total Applications</div>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="metric-card info">
                            <div class="metric-value">{{ number_format($totalSaves) }}</div>
                            <div class="metric-label">Job Saves</div>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="metric-card warning">
                            <div class="metric-value">{{ number_format($totalShares) }}</div>
                            <div class="metric-label">Job Shares</div>
                        </div>
                    </div>
                </div>

                <!-- Charts Row -->
                <div class="row">
                    <!-- Daily Performance Chart -->
                    <div class="col-md-8">
                        <div class="chart-container">
                            <h5><i class="bi bi-graph-up"></i> Daily Performance (Last 30 Days)</h5>
                            <canvas id="dailyPerformanceChart" width="400" height="200"></canvas>
                        </div>
                    </div>

                    <!-- Application Trends -->
                    <div class="col-md-4">
                        <div class="chart-container">
                            <h5><i class="bi bi-pie-chart"></i> Application Trends</h5>
                            <canvas id="applicationTrendsChart" width="400" height="200"></canvas>
                        </div>
                    </div>
                </div>

                <!-- Top Performing Jobs -->
                <div class="row">
                    <div class="col-md-6">
                        <div class="chart-container">
                            <h5><i class="bi bi-trophy"></i> Top Performing Jobs</h5>
                            @if($topJobs->count() > 0)
                                <div class="table-responsive">
                                    <table class="table table-sm">
                                        <thead>
                                            <tr>
                                                <th>Job Title</th>
                                                <th>Applications</th>
                                                <th>Status</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach($topJobs as $job)
                                                <tr>
                                                    <td>
                                                        <a href="{{ route('company.analytics.job', $job->id) }}">
                                                            {{ Str::limit($job->title, 30) }}
                                                        </a>
                                                    </td>
                                                    <td>
                                                        <span class="badge bg-primary">{{ $job->applications_count }}</span>
                                                    </td>
                                                    <td>
                                                        @if($job->is_active)
                                                            <span class="badge bg-success">Active</span>
                                                        @else
                                                            <span class="badge bg-danger">Inactive</span>
                                                        @endif
                                                    </td>
                                                </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                </div>
                            @else
                                <p class="text-muted text-center py-3">No jobs posted yet.</p>
                            @endif
                        </div>
                    </div>

                    <!-- Recent Activity -->
                    <div class="col-md-6">
                        <div class="chart-container">
                            <h5><i class="bi bi-activity"></i> Recent Activity</h5>
                            @if($applicationTrends->count() > 0)
                                <div class="table-responsive">
                                    <table class="table table-sm">
                                        <thead>
                                            <tr>
                                                <th>Date</th>
                                                <th>Applications</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach($applicationTrends->take(7) as $trend)
                                                <tr>
                                                    <td>{{ \Carbon\Carbon::parse($trend->date)->format('M d') }}</td>
                                                    <td>
                                                        <span class="badge bg-info">{{ $trend->count }}</span>
                                                    </td>
                                                </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                </div>
                            @else
                                <p class="text-muted text-center py-3">No recent activity.</p>
                            @endif
                        </div>
                    </div>
                </div>

                <!-- Export Section -->
                <div class="export-section">
                    <h5><i class="bi bi-download"></i> Export Analytics Data</h5>
                    <form action="{{ route('company.analytics.export') }}" method="GET" class="row g-3">
                        <div class="col-md-3">
                            <label for="start_date" class="form-label">Start Date</label>
                            <input type="date" class="form-control" id="start_date" name="start_date" 
                                   value="{{ now()->subDays(30)->format('Y-m-d') }}">
                        </div>
                        <div class="col-md-3">
                            <label for="end_date" class="form-label">End Date</label>
                            <input type="date" class="form-control" id="end_date" name="end_date" 
                                   value="{{ now()->format('Y-m-d') }}">
                        </div>
                        <div class="col-md-3">
                            <label for="format" class="form-label">Format</label>
                            <select class="form-control" id="format" name="format">
                                <option value="csv">CSV</option>
                                <option value="json">JSON</option>
                            </select>
                        </div>
                        <div class="col-md-3">
                            <label class="form-label">&nbsp;</label>
                            <button type="submit" class="btn btn-primary w-100">
                                <i class="bi bi-download"></i> Export
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        // Daily Performance Chart
        const dailyCtx = document.getElementById('dailyPerformanceChart').getContext('2d');
        const dailyData = @json($dailyData);
        
        const labels = Object.keys(dailyData);
        const viewsData = labels.map(date => dailyData[date].views);
        const applicationsData = labels.map(date => dailyData[date].applications);
        const savesData = labels.map(date => dailyData[date].saves);
        const sharesData = labels.map(date => dailyData[date].shares);

        new Chart(dailyCtx, {
            type: 'line',
            data: {
                labels: labels,
                datasets: [
                    {
                        label: 'Views',
                        data: viewsData,
                        borderColor: '#667eea',
                        backgroundColor: 'rgba(102, 126, 234, 0.1)',
                        tension: 0.4
                    },
                    {
                        label: 'Applications',
                        data: applicationsData,
                        borderColor: '#28a745',
                        backgroundColor: 'rgba(40, 167, 69, 0.1)',
                        tension: 0.4
                    },
                    {
                        label: 'Saves',
                        data: savesData,
                        borderColor: '#17a2b8',
                        backgroundColor: 'rgba(23, 162, 184, 0.1)',
                        tension: 0.4
                    },
                    {
                        label: 'Shares',
                        data: sharesData,
                        borderColor: '#ffc107',
                        backgroundColor: 'rgba(255, 193, 7, 0.1)',
                        tension: 0.4
                    }
                ]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                plugins: {
                    legend: {
                        position: 'top',
                    }
                },
                scales: {
                    y: {
                        beginAtZero: true
                    }
                }
            }
        });

        // Application Trends Chart
        const trendsCtx = document.getElementById('applicationTrendsChart').getContext('2d');
        const trendsData = @json($applicationTrends);
        
        const trendLabels = trendsData.map(trend => trend.date);
        const trendCounts = trendsData.map(trend => trend.count);

        new Chart(trendsCtx, {
            type: 'doughnut',
            data: {
                labels: trendLabels,
                datasets: [{
                    data: trendCounts,
                    backgroundColor: [
                        '#667eea',
                        '#28a745',
                        '#17a2b8',
                        '#ffc107',
                        '#fd7e14',
                        '#6f42c1',
                        '#e83e8c'
                    ]
                }]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                plugins: {
                    legend: {
                        position: 'bottom',
                    }
                }
            }
        });

        // Date range validation
        document.getElementById('start_date').addEventListener('change', function() {
            const startDate = new Date(this.value);
            const endDateInput = document.getElementById('end_date');
            const endDate = new Date(endDateInput.value);
            
            if (startDate > endDate) {
                endDateInput.value = this.value;
            }
        });

        document.getElementById('end_date').addEventListener('change', function() {
            const endDate = new Date(this.value);
            const startDateInput = document.getElementById('start_date');
            const startDate = new Date(startDateInput.value);
            
            if (endDate < startDate) {
                startDateInput.value = this.value;
            }
        });
    </script>
</body>
</html>
