<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Monitoring Serveurs</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css" rel="stylesheet">
    <style>
        body { background-color: #f0f2f5; }
        .sidebar {
            min-height: 100vh;
            background: #1e2a3a;
            color: white;
            width: 250px;
            position: fixed;
            top: 0;
            left: 0;
        }
        .sidebar a {
    
            color: #adb5bd;
            text-decoration: none;
            display: block;
            padding: 12px 20px;
            transition: all 0.2s;
        }
        .sidebar a:hover, .sidebar a.active {
            color: white;
            background: #2d3f55;
            border-left: 4px solid #0d6efd;
        }
        .main-content { margin-left: 250px; padding: 30px; }
        .card { border: none; border-radius: 12px; box-shadow: 0 2px 10px rgba(0,0,0,0.08); }
        .stat-card { border-left: 4px solid; }
    </style>
</head>
<body>
    <!-- Sidebar -->
    <div class="sidebar">
        <div class="p-4 border-bottom border-secondary">
            <h5 class="mb-0">
                <i class="bi bi-server me-2"></i>ServerWatch
            </h5>
        </div>
        <nav class="mt-3">
            <a href="{{ route('dashboard') }}" 
               class="{{ request()->routeIs('dashboard') ? 'active' : '' }}">
                <i class="bi bi-speedometer2 me-2"></i>Dashboard
            </a>
            <a href="{{ route('serveurs.index') }}" 
               class="{{ request()->routeIs('serveurs.*') ? 'active' : '' }}">
                <i class="bi bi-hdd-network me-2"></i>Serveurs
            </a>
            <a href="{{ route('metrics.index') }}" 
               class="{{ request()->routeIs('metrics.*') ? 'active' : '' }}">
                <i class="bi bi-graph-up me-2"></i>Métriques
            </a>
            <a href="{{ route('alerts.index') }}" 
               class="{{ request()->routeIs('alerts.*') ? 'active' : '' }}">
                <i class="bi bi-bell me-2"></i>Alertes
            </a>
        </nav>
    </div>
    <a href="{{ route('logs.index') }}"
   class="{{ request()->routeIs('logs.*') ? 'active' : '' }}">
    <i class="bi bi-journal-text me-2"></i>Logs
</a>

    <!-- Main Content -->
    <div class="main-content">
        @if(session('success'))
            <div class="alert alert-success alert-dismissible fade show">
                {{ session('success') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
            </div>
        @endif

        @yield('content')
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    @yield('scripts')
</body>
</html>