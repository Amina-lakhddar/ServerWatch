@extends('layouts.app')

@section('content')
<div class="d-flex justify-content-between align-items-center mb-4">
    <h4><i class="bi bi-hdd-network me-2"></i>{{ $serveur->nom }}</h4>
    <div class="d-flex gap-2">
        <a href="{{ route('serveurs.edit', $serveur) }}" class="btn btn-warning">
            <i class="bi bi-pencil me-1"></i>Modifier
        </a>
        <a href="{{ route('serveurs.index') }}" class="btn btn-secondary">
            <i class="bi bi-arrow-left me-1"></i>Retour
        </a>
    </div>
</div>

<!-- Infos Serveur -->
<div class="row g-3 mb-4">
    <div class="col-md-4">
        <div class="card p-3">
            <div class="text-muted small">Adresse IP</div>
            <div class="fs-5 fw-bold"><code>{{ $serveur->adressIP }}</code></div>
        </div>
    </div>
    <div class="col-md-4">
        <div class="card p-3">
            <div class="text-muted small">Statut</div>
            <div class="fs-5 fw-bold">
                <span class="badge {{ $serveur->statut === 'actif' ? 'bg-success' : 'bg-secondary' }} fs-6">
                    <i class="bi {{ $serveur->statut === 'actif' ? 'bi-check-circle' : 'bi-x-circle' }} me-1"></i>
                    {{ $serveur->statut }}
                </span>
            </div>
        </div>
    </div>
    <div class="col-md-4">
        <div class="card p-3">
            <div class="text-muted small">Créé le</div>
            <div class="fs-5 fw-bold">{{ $serveur->created_at->format('d/m/Y') }}</div>
        </div>
    </div>
</div>

<!-- Métriques + Alertes -->
<div class="row g-3">
    <!-- Métriques -->
    <div class="col-md-7">
        <div class="card p-3">
            <h6 class="mb-3"><i class="bi bi-graph-up me-2"></i>Dernières Métriques</h6>
            <table class="table table-sm table-hover">
                <thead class="table-light">
                    <tr>
                        <th>Type</th>
                        <th>Valeur</th>
                        <th>Date</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($metrics as $metric)
                    <tr>
                        <td>
                            <span class="badge {{ $metric->type === 'CPU' ? 'bg-primary' : ($metric->type === 'RAM' ? 'bg-info' : 'bg-warning text-dark') }}">
                                {{ $metric->type }}
                            </span>
                        </td>
                        <td>
                            <div class="progress" style="height:16px; width:120px;">
                                <div class="progress-bar {{ $metric->valeur > 80 ? 'bg-danger' : 'bg-success' }}"
                                     style="width:{{ $metric->valeur }}%">
                                    {{ $metric->valeur }}%
                                </div>
                            </div>
                        </td>
                        <td>{{ $metric->date }}</td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="3" class="text-center text-muted">Aucune métrique</td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
            <a href="{{ route('metrics.index') }}" class="btn btn-sm btn-outline-primary">
                Voir tout
            </a>
        </div>
    </div>

    <!-- Alertes -->
    <div class="col-md-5">
        <div class="card p-3">
            <h6 class="mb-3"><i class="bi bi-bell me-2"></i>Dernières Alertes</h6>
            @forelse($alerts as $alert)
            <div class="alert {{ $alert->statut === 'non_lue' ? 'alert-danger' : 'alert-secondary' }} py-2 mb-2">
                <div class="small fw-bold">{{ $alert->message }}</div>
                <div class="small">Seuil: {{ $alert->seuil }}%</div>
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