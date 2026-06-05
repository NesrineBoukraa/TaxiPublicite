@extends('admin.layout.layout')

@section('title', 'Créer | Dossier Annonce')

@section('content')

<div class="container my-5">
    <div class="row justify-content-center">
        <div class="col-md-8">

            <form action="{{ route('dossierannonce.store') }}" method="post">
                @csrf

                <div class="card shadow-lg border-0">

                    <div class="card-header bg-primary text-white fs-4 fw-bold">
                        <i class="fas fa-folder-plus me-2"></i> Créer un nouveau Dossier Annonce
                    </div>

                    <div class="card-body p-4">

                        <div class="mb-4">
                            <label class="form-label fw-bold">Date de création</label>
                            <input type="date" name="datecreation"
                                   value="{{ old('datecreation', date('Y-m-d')) }}"
                                   class="form-control @error('datecreation') is-invalid @enderror">
                            @error('datecreation')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-4">
                            <label class="form-label fw-bold">Annonceur</label>
                            
                            @if(auth()->user()->role === 'admin')
                                <select name="annonceur_id" class="form-select @error('annonceur_id') is-invalid @enderror">
                                    <option value="" selected disabled>Choisir un annonceur...</option>
                                    @foreach($annonceurs as $annonceur)
                                        <option value="{{ $annonceur->id }}" {{ old('annonceur_id') == $annonceur->id ? 'selected' : '' }}>
                                            {{ $annonceur->nom }}
                                        </option>
                                    @endforeach
                                </select>
                                @error('annonceur_id')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            @else
                                <input type="text" class="form-control bg-light" value="{{ auth()->user()->name }}" readonly>
                                <small class="text-muted">Le dossier sera automatiquement lié à votre profil.</small>
                            @endif
                        </div>

                        <div class="mb-4">
                            <label class="form-label fw-bold">Service publicitaire</label>
                            <select name="service_publicitaire_id" class="form-select @error('service_publicitaire_id') is-invalid @enderror">
                                <option value="" selected disabled>Sélectionner un service...</option>
                                @foreach($services as $service)
                                    <option value="{{ $service->id }}" {{ old('service_publicitaire_id') == $service->id ? 'selected' : '' }}>
                                        {{ $service->nomservice }} ({{ $service->tarif }} DT)
                                    </option>
                                @endforeach
                            </select>
                            @error('service_publicitaire_id')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                    </div>

                    <div class="card-footer bg-light d-flex justify-content-between p-3">
                        <a href="{{ route('dossierannonce.index') }}" class="btn btn-dark">
                            <i class="fas fa-arrow-left"></i> Retour
                        </a>
                        <button type="submit" class="btn btn-primary px-4">
                            <i class="fas fa-check"></i> Enregistrer le dossier
                        </button>
                    </div>

                </div>

            </form>

        </div>
    </div>
</div>

@endsection