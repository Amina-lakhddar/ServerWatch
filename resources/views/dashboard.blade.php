@extends('layouts.app')

@section('content')
<h4 class="mb-4"><i class="bi bi-speedometer2 me-2"></i>Dashboard</h4>

<!-- Stats Cards -->
<div class="row g-3 mb-4">
    <div class="col-md-4">
        <div class="card stat-card p-3" style="border-color:#0d6efd">
            <div class="text-muted small">Total Serveurs</div>
            <div class="fs-2 fw-bold text-primary">{{ $totalServeurs }}</div>
            <div class="text-muted small"><i class="bi bi-hdd-network me-1"></i>Tous les serveurs</div>
        </div>
    </div>
    <div class="col-md-4">
        <div class="card stat-card p-3" style="border-color:#198754">
            <div class="text-muted small">Serveurs Actifs</div>
            <div class="fs-2 fw-bold text-success">{{ $serveursActifs }}</div>
            <div class="text-muted small"><i class="bi bi-check-circle me-1"></i>En ligne</div>
        </div>
    </div>
    <div class="col-md-4">
        <div class="card stat-card p-3" style="border-color:#dc3545">
            <div class="text-muted small">Alertes Non Lues</div>
            <div class="fs-2 fw-bold text-danger">{{ $totalAlerts }}</div>
            <div class="text-muted small"><i class="bi bi-bell me-1"></i>À traiter</div>
        </div>
    </div>
</div>

<!-- Recent Metrics + Alerts -->
<div class="row g-3">
    <!-- Métriques récentes -->
    <div class="col-md-7">
        <div class="card p-3">
            <h6 class="mb-3"><i class="bi bi-graph-up me-2"></i>Métriques Récentes</h6>
            <table class="table table-sm table-hover">
                <thead class="table-light">
                    <tr>
                        <th>Serveur</th>
                        <th>Type</th>
                        <th>Valeur</th>
                        <th>Date</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($recentMetrics as $metric)
                    <tr>
                        <td>{{ $metric->serveur->nom ?? '-' }}</td>
                        <td>
                            <span class="badge {{ $metric->type === 'CPU' ? 'bg-primary' : ($metric->type === 'RAM' ? 'bg-info' : 'bg-warning text-dark') }}">
                                {{ $metric->type }}
                            </span>
                        </td>
                        <td>
                            <div class="progress" style="height:16px; width:100px;">
                                <div class="progress-bar {{ $metric->valeur > 80 ? 'bg-danger' : 'bg-success' }}"
                                     id="bar-{{ $metric->type }}"
                                     style="width:{{ $metric->valeur }}%">
                                    {{ $metric->valeur }}%
                                </div>
                            </div>
                        </td>
                        <td>{{ $metric->date }}</td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="4" class="text-center text-muted">Aucune métrique</td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
            <a href="{{ route('metrics.index') }}" class="btn btn-sm btn-outline-primary">
                Voir tout
            </a>
        </div>
    </div>

    <!-- Alertes récentes -->
    <div class="col-md-5">
        <div class="card p-3">
            <h6 class="mb-3"><i class="bi bi-bell me-2"></i>Alertes Récentes</h6>
            @forelse($recentAlerts as $alert)
            <div class="alert {{ $alert->statut === 'non_lue' ? 'alert-danger' : 'alert-secondary' }} py-2 mb-2">
                <div class="small fw-bold">{{ $alert->serveur->nom ?? '-' }}</div>
                <div class="small">{{ $alert->message }}</div>
                <div class="small text-muted">{{ $alert->date }}</div>
            </div>
            @empty
            <p class="text-muted text-center">Aucune alerte</p>
            @endforelse
            <a href="{{ route('alerts.index') }}" class="btn btn-sm btn-outline-danger">
                Voir tout
            </a>
        </div>
    </div>
</div>

@endsection

@section('scripts')
<script>
    setInterval(function() {
        fetch('/api/metrics/latest')
            .then(r => r.json())
            .then(data => {
                data.forEach(metric => {
                    let bar = document.getElementById('bar-' + metric.type);
                    if (bar) {
                        bar.style.width = metric.valeur + '%';
                        bar.textContent = metric.valeur + '%';
                    }
                });
            });
    }, 10000);
</script>
@endsection