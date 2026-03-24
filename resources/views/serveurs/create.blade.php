@extends('layouts.app')

@section('content')
<div class="row justify-content-center">
    <div class="col-md-6">
        <div class="card p-4">
            <h5 class="mb-4">
                <i class="bi bi-plus-circle me-2"></i>Ajouter un Serveur
            </h5>
            <form method="POST" action="{{ route('serveurs.store') }}">
                @csrf
                <div class="mb-3">
                    <label class="form-label">Nom du serveur</label>
                    <input type="text" 
                           name="nom" 
                           class="form-control @error('nom') is-invalid @enderror" 
                           value="{{ old('nom') }}" 
                           placeholder="Ex: Serveur-01"
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
                           value="{{ old('adressIP') }}"
                           placeholder="Ex: 192.168.1.1"
                           required>
                    @error('adressIP')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="mb-4">
                    <label class="form-label">Statut</label>
                    <select name="statut" class="form-select" required>
                        <option value="actif"   {{ old('statut') === 'actif'   ? 'selected' : '' }}>Actif</option>
                        <option value="inactif" {{ old('statut') === 'inactif' ? 'selected' : '' }}>Inactif</option>
                    </select>
                </div>

                <div class="d-flex gap-2">
                    <button type="submit" class="btn btn-primary">
                        <i class="bi bi-save me-1"></i>Enregistrer
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