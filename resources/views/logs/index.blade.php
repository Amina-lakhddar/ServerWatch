@extends('layouts.app')

@section('content')
<div class="d-flex justify-content-between align-items-center mb-4">
    <h4><i class="bi bi-journal-text me-2"></i>Logs Système</h4>
</div>

<div class="card">
    <table class="table table-hover mb-0">
        <thead class="table-dark">
            <tr>
                <th>Statut</th>
                <th>Message</th>
                <th>Date</th>
            </tr>
        </thead>
        <tbody>
            @forelse($logs as $log)
            <tr class="{{ str_contains($log->message, '[5') ? 'table-danger' : (str_contains($log->message, '[4') ? 'table-warning' : '') }}">
                <td>
                    @if(str_contains($log->message, '[5'))
                        <span class="badge bg-danger">500</span>
                    @elseif(str_contains($log->message, '[4'))
                        <span class="badge bg-warning text-dark">400</span>
                    @elseif(str_contains($log->message, 'Alert'))
                        <span class="badge bg-danger">Alert</span>
                    @else
                        <span class="badge bg-secondary">Info</span>
                    @endif
                </td>
                <td>{{ $log->message }}</td>
                <td>{{ $log->date }}</td>
            </tr>
            @empty
            <tr>
                <td colspan="3" class="text-center text-muted py-4">
                    <i class="bi bi-inbox fs-4 d-block mb-2"></i>
                    Aucun log trouvé
                </td>
            </tr>
            @endforelse
        </tbody>
    </table>
    <div class="p-3">{{ $logs->links() }}</div>
</div>
@endsection