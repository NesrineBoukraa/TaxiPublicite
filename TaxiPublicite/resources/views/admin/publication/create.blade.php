@extends('admin.layout.layout')

@section('title', 'create | publication')

@section('content')

<div class="container my-3">

    <div class="row justify-content-center">
        <div class="col-md-10">

            <form action="{{ route('publication.store') }}" method="post">
                @csrf

                <div class="card shadow-lg">

                    <div class="card-header fs-4 fw-bold">
                        Create Publication
                    </div>

                    <div class="card-body">

                        {{-- Titre --}}
                        <div class="mb-3">
                            <label>Titre</label>
                            <input type="text" name="titre"
                                   value="{{ old('titre') }}"
                                   class="form-control">
                            @error('titre')
                            <div class="alert alert-danger mt-2">{{ $message }}</div>
                            @enderror
                        </div>

                        {{-- Contenu --}}
                        <div class="mb-3">
                            <label>Contenu</label>
                            <textarea name="contenu"
                                      class="form-control">{{ old('contenu') }}</textarea>
                            @error('contenu')
                            <div class="alert alert-danger mt-2">{{ $message }}</div>
                            @enderror
                        </div>

                        {{-- Date publication --}}
                        <div class="mb-3">
                            <label>Date publication</label>
                            <input type="date" name="datepublication"
                                   value="{{ old('datepublication') }}"
                                   class="form-control">
                            @error('datepublication')
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

                        {{-- URL média --}}
                        <div class="mb-3">
                            <label>URL média</label>
                            <input type="url" name="urlmedia"
                                   value="{{ old('urlmedia') }}"
                                   class="form-control">
                            @error('urlmedia')
                            <div class="alert alert-danger mt-2">{{ $message }}</div>
                            @enderror
                        </div>

                        {{-- Dossier --}}
                        <div class="mb-3">
                            <label>Dossier annonce</label>
                            <select name="dossier_annonce_id" class="form-control">
                                @foreach($dossiers as $dossier)
                                    <option value="{{ $dossier->id }}">
                                        Dossier #{{ $dossier->id }}
                                    </option>
                                @endforeach
                            </select>

                            @error('dossier_annonce_id')
                            <div class="alert alert-danger mt-2">{{ $message }}</div>
                            @enderror
                        </div>

                    </div>

                    <div class="card-footer">
                        <button class="btn btn-primary">Submit</button>
                        <a href="{{ route('publication.index') }}"
                           class="btn btn-dark">Retour</a>
                    </div>

                </div>

            </form>

        </div>
    </div>

</div>

@endsection