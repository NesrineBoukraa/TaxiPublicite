@extends('admin.layout.layout')

@section('title', 'create | service publicitaire')

@section('content')

<div class="container my-3">

    <div class="row justify-content-center">
        <div class="col-md-10">

            <form action="{{ route('servicepublicitaire.store') }}" method="post">
                @csrf

                <div class="card shadow-lg">

                    <div class="card-header fs-4 fw-bold">
                        Create Service Publicitaire
                    </div>

                    <div class="card-body">

                        {{-- Nom --}}
                        <div class="mb-3">
                            <label>Nom Service</label>
                            <input type="text" name="nomservice"
                                   value="{{ old('nomservice') }}"
                                   class="form-control">
                            @error('nomservice')
                            <div class="alert alert-danger mt-2">{{ $message }}</div>
                            @enderror
                        </div>

                        {{-- Description --}}
                        <div class="mb-3">
                            <label>Description</label>
                            <textarea name="description"
                                      class="form-control">{{ old('description') }}</textarea>
                            @error('description')
                            <div class="alert alert-danger mt-2">{{ $message }}</div>
                            @enderror
                        </div>

                        {{-- Tarif --}}
                        <div class="mb-3">
                            <label>Tarif</label>
                            <input type="number" step="0.01" name="tarif"
                                   value="{{ old('tarif') }}"
                                   class="form-control">
                            @error('tarif')
                            <div class="alert alert-danger mt-2">{{ $message }}</div>
                            @enderror
                        </div>

                        {{-- Durée --}}
                        <div class="mb-3">
                            <label>Durée (jours)</label>
                            <input type="number" name="dureejour"
                                   value="{{ old('dureejour') }}"
                                   class="form-control">
                            @error('dureejour')
                            <div class="alert alert-danger mt-2">{{ $message }}</div>
                            @enderror
                        </div>

                        {{-- Actif --}}
                        <div class="mb-3">
                            <label>Actif</label>
                            <select name="actif" class="form-control">
                                <option value="1">Oui</option>
                                <option value="0">Non</option>
                            </select>
                        </div>

                        {{-- Annonceur --}}
                        <div class="mb-3">
                            <label>Annonceur</label>
                            <select name="annonceur_id" class="form-control">
                                @foreach($annonceurs as $annonceur)
                                    <option value="{{ $annonceur->id }}">
                                        {{ $annonceur->nom }}
                                    </option>
                                @endforeach
                            </select>
                        </div>

                    </div>

                    <div class="card-footer">
                        <button class="btn btn-primary">Submit</button>
                        <a href="{{ route('servicepublicitaire.index') }}"
                           class="btn btn-dark">Retour</a>
                    </div>

                </div>

            </form>

        </div>
    </div>

</div>

@endsection