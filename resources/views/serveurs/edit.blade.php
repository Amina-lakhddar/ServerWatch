@extends('layouts.app')

@section('content')
<div class="row justify-content-center">
    <div class="col-md-6">
        <div class="card p-4">
            <h5 class="mb-4">
                <i class="bi bi-pencil-square me-2"></i>Modifier le Serveur
            </h5>
            <form method="POST" action="{{ route('serveurs.update', $serveur) }}">
                @csrf @method('PUT')

                <div class="mb-3">
                    <label class="form-label">Nom du serveur</label>
                    <input type="text" 
                           name="nom" 
                           class="form-control @error('nom') is-invalid @enderror" 
                           value="{{ old('nom', $serveur->nom) }}"
                           required>
                    @error('nom')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="mb-3">
                    <label class="form-label">Adresse IP</label>
                    <input type="text" 
                           name="adressIP" 
                           class="form-control @error('adressIP') is-invalid @enderror" 
                           value="{{ old('adressIP', $serveur->adressIP) }}"
                           required>
                    @error('adressIP')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="mb-4">
                    <label class="form-label">Statut</label>
                    <select name="statut" class="form-select" required>
                        <option value="actif"   {{ $serveur->statut === 'actif'   ? 'selected' : '' }}>Actif</option>
                        <option value="inactif" {{ $serveur->statut === 'inactif' ? 'selected' : '' }}>Inactif</option>
                    </select>
                </div>

                <div class="d-flex gap-2">
                    <button type="submit" class="btn btn-warning">
                        <i class="bi bi-save me-1"></i>Mettre à jour
                    </button>
                    <a href="{{ route('serveurs.index') }}" class="btn btn-secondary">
                        <i class="bi bi-arrow-left me-1"></i>Annuler
                    </a>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection