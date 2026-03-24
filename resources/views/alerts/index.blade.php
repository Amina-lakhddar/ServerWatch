@extends('layouts.app')

@section('content')
<div class="d-flex justify-content-between align-items-center mb-4">
    <h4><i class="bi bi-bell me-2"></i>Alertes</h4>
</div>

<div class="card">
    <table class="table table-hover mb-0">
        <thead class="table-dark">
            <tr>
                <th>Serveur</th>
                <th>Message</th>
                <th>Seuil</th>
                <th>Statut</th>
                <th>Date</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @forelse($alerts as $alert)
            <tr class="{{ $alert->statut === 'non_lue' ? 'table-warning' : '' }}">
                <td>{{ $alert->serveur->nom ?? '-' }}</td>
                <td>{{ $alert->message }}</td>
                <td>{{ $alert->seuil }}%</td>
                <td>
                    <span class="badge {{ $alert->statut === 'non_lue' ? 'bg-danger' : 'bg-success' }}">
                        <i class="bi {{ $alert->statut === 'non_lue' ? 'bi-bell-fill' : 'bi-check-circle' }} me-1"></i>
                        {{ $alert->statut }}
                    </span>
                </td>
                <td>{{ $alert->date }}</td>
                <td>
                    @if($alert->statut === 'non_lue')
                    <form method="POST" action="{{ route('alerts.read', $alert) }}" class="d-inline">
                        @csrf @method('PATCH')
                        <button class="btn btn-sm btn-success" title="Marquer comme lue">
                            <i class="bi bi-check"></i>
                        </button>
                    </form>
                    @endif
                    <form method="POST" action="{{ route('alerts.destroy', $alert) }}" class="d-inline">
                        @csrf @method('DELETE')
                        <button class="btn btn-sm btn-danger" onclick="return confirm('Supprimer?')" title="Supprimer">
                            <i class="bi bi-trash"></i>
                        </button>
                    </form>
                </td>
            </tr>
            @empty
            <tr>
                <td colspan="6" class="text-center text-muted py-4">
                    <i class="bi bi-bell-slash fs-4 d-block mb-2"></i>
                    Aucune alerte trouvée
                </td>
            </tr>
            @endforelse
        </tbody>
    </table>
    <div class="p-3">{{ $alerts->links() }}</div>
</div>
@endsection