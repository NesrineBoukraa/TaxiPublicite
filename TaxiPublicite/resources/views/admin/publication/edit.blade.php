@extends('admin.layout.layout')

@section('title', 'edit | publication')

@section('content')

<div class="container my-3">

    <div class="row justify-content-center">
        <div class="col-md-10">

            <form action="{{ route('publication.update', $publication) }}" method="POST">
                @csrf
                @method('PUT')

                <div class="card shadow-lg">

                    <div class="card-header fs-4 fw-bold">
                        Edit Publication
                    </div>

                    <div class="card-body">

                        {{-- Titre --}}
                        <div class="mb-3">
                            <label>Titre</label>
                            <input type="text" name="titre"
                                   value="{{ old('titre', $publication->titre) }}"
                                   class="form-control">
                            @error('titre')
                                <small class="text-danger">{{ $message }}</small>
                            @enderror
                        </div>

                        {{-- Contenu --}}
                        <div class="mb-3">
                            <label>Contenu</label>
                            <textarea name="contenu" class="form-control">{{ old('contenu', $publication->contenu) }}</textarea>
                            @error('contenu')
                                <small class="text-danger">{{ $message }}</small>
                            @enderror
                        </div>

                        {{-- Date --}}
                        <div class="mb-3">
                            <label>Date publication</label>
                            <input type="date" name="datepublication"
                                   value="{{ old('datepublication', $publication->datepublication) }}"
                                   class="form-control">
                            @error('datepublication')
                                <small class="text-danger">{{ $message }}</small>
                            @enderror
                        </div>

                        {{-- Actif --}}
                        <div class="mb-3">
                            <label>Actif</label>
                            <select name="actif" class="form-control">
                                <option value="1" @selected(old('actif', $publication->actif) == 1)>Oui</option>
                                <option value="0" @selected(old('actif', $publication->actif) == 0)>Non</option>
                            </select>
                            @error('actif')
                                <small class="text-danger">{{ $message }}</small>
                            @enderror
                        </div>

                        {{-- URL média --}}
                        <div class="mb-3">
                            <label>URL média</label>
                            <input type="url" name="urlmedia"
                                   value="{{ old('urlmedia', $publication->urlmedia) }}"
                                   class="form-control">
                            @error('urlmedia')
                                <small class="text-danger">{{ $message }}</small>
                            @enderror
                        </div>

                        {{-- Dossier annonce --}}
                        <div class="mb-3">
                            <label>Dossier annonce</label>
                            <select name="dossier_annonce_id" class="form-control">
                                @foreach($dossiers as $dossier)
                                    <option value="{{ $dossier->id }}"
                                        @selected(old('dossier_annonce_id', $publication->dossier_annonce_id) == $dossier->id)>
                                        Dossier #{{ $dossier->id }}
                                    </option>
                                @endforeach
                            </select>
                            @error('dossier_annonce_id')
                                <small class="text-danger">{{ $message }}</small>
                            @enderror
                        </div>

                    </div>

                    <div class="card-footer">
                        <button class="btn btn-primary">Update</button>
                        <a href="{{ route('publication.index') }}" class="btn btn-dark">Retour</a>
                    </div>

                </div>

            </form>

        </div>
    </div>

</div>

@endsection