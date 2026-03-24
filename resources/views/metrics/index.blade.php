@extends('layouts.app')

@section('content')
<div class="d-flex justify-content-between align-items-center mb-4">
    <h4><i class="bi bi-graph-up me-2"></i>Métriques</h4>

    <!-- Collect Form -->
    <form method="POST" action="{{ route('metrics.collect') }}" class="d-flex gap-2">
        @csrf
        <select name="serveur_id" class="form-select form-select-sm" required>
            <option value="">Choisir serveur...</option>
            @foreach($serveurs as $serveur)
                <option value="{{ $serveur->id }}">{{ $serveur->nom }}</option>
            @endforeach
        </select>
        <button class="btn btn-success btn-sm">
            <i class="bi bi-arrow-clockwise me-1"></i>Collecter
        </button>
    </form>
</div>

<div class="card">
    <table class="table table-hover mb-0">
        <thead class="table-dark">
            <tr>
                <th>Serveur</th>
                <th>Type</th>
                <th>Valeur</th>
                <th>Date</th>
            </tr>
        </thead>
        <tbody>
            @forelse($metrics as $metric)
            <tr>
                <td>{{ $metric->serveur->nom ?? '-' }}</td>
                <td>
                    <span class="badge {{ $metric->type === 'CPU' ? 'bg-primary' : ($metric->type === 'RAM' ? 'bg-info' : 'bg-warning text-dark') }}">
                        {{ $metric->type }}
                    </span>
                </td>
                <td>
                    <div class="progress" style="height:18px; width:150px;">
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
                <td colspan="4" class="text-center text-muted py-4">
                    <i class="bi bi-inbox fs-4 d-block mb-2"></i>
                    Aucune métrique trouvée
                </td>
            </tr>
            @endforelse
        </tbody>
    </table>
    <div class="p-3">{{ $metrics->links() }}</div>
</div>
@endsection