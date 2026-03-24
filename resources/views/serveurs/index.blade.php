@extends('layouts.app')

@section('content')
<div class="d-flex justify-content-between align-items-center mb-4">
    <h4><i class="bi bi-hdd-network me-2"></i>Serveurs</h4>
    <a href="{{ route('serveurs.create') }}" class="btn btn-primary">
        <i class="bi bi-plus-lg me-1"></i>Ajouter
    </a>
</div>

<div class="card">
    <table class="table table-hover mb-0">
        <thead class="table-dark">
            <tr>
                <th>#</th>
                <th>Nom</th>
                <th>Adresse IP</th>
                <th>Statut</th>
                <th>Métriques</th>
                <th>Alertes</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @forelse($serveurs as $serveur)
            <tr>
                <td>{{ $serveur->id }}</td>
                <td><strong>{{ $serveur->nom }}</strong></td>
                <td><code>{{ $serveur->adressIP }}</code></td>
                <td>
                    <span class="badge {{ $serveur->statut === 'actif' ? 'bg-success' : 'bg-secondary' }}">
                        <i class="bi {{ $serveur->statut === 'actif' ? 'bi-check-circle' : 'bi-x-circle' }} me-1"></i>
                        {{ $serveur->statut }}
                    </span>
                </td>
                <td>
                    <span class="badge bg-primary">{{ $serveur->metrics_count }}</span>
                </td>
                <td>
                    <span class="badge bg-danger">{{ $serveur->alerts_count }}</span>
                </td>
                <td>
                    <a href="{{ route('serveurs.show', $serveur) }}" class="btn btn-sm btn-info">
                        <i class="bi bi-eye"></i>
                    </a>
                    <a href="{{ route('serveurs.edit', $serveur) }}" class="btn btn-sm btn-warning">
                        <i class="bi bi-pencil"></i>
                    </a>
                    <form method="POST" action="{{ route('serveurs.destroy', $serveur) }}" class="d-inline">
                        @csrf @method('DELETE')
                        <button class="btn btn-sm btn-danger" onclick="return confirm('Supprimer ce serveur?')">
                            <i class="bi bi-trash"></i>
                        </button>
                    </form>
                </td>
            </tr>
            @empty
            <tr>
                <td colspan="7" class="text-center text-muted py-4">
                    <i class="bi bi-inbox fs-4 d-block mb-2"></i>
                    Aucun serveur trouvé
                </td>
            </tr>
            @endforelse
        </tbody>
    </table>
</div>
@endsection