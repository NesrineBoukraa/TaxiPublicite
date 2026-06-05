@extends('admin.layout.layout')

@section('title', 'create | statut validation')

@section('content')

<div class="container my-3">

    <div class="row justify-content-center">
        <div class="col-md-10">

            <form action="{{ route('statutvalidation.store') }}" method="post">
                @csrf

                <div class="card shadow-lg">

                    <div class="card-header fs-4 fw-bold">
                        Create Statut Validation
                    </div>

                    <div class="card-body">

                        {{-- Libellé --}}
                        <div class="mb-3">
                            <label>Libellé</label>
                            <input type="text" name="libelle"
                                   value="{{ old('libelle') }}"
                                   class="form-control">
                            @error('libelle')
                            <div class="alert alert-danger mt-2">{{ $message }}</div>
                            @enderror
                        </div>

                        {{-- Date validation --}}
                        <div class="mb-3">
                            <label>Date validation</label>
                            <input type="date" name="datevalidation"
                                   value="{{ old('datevalidation') }}"
                                   class="form-control">
                            @error('datevalidation')
                            <div class="alert alert-danger mt-2">{{ $message }}</div>
                            @enderror
                        </div>

                        {{-- Commentaire --}}
                        <div class="mb-3">
                            <label>Commentaire</label>
                            <textarea name="commentaire"
                                      class="form-control">{{ old('commentaire') }}</textarea>
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
                        <a href="{{ route('statutvalidation.index') }}"
                           class="btn btn-dark">Retour</a>
                    </div>

                </div>

            </form>

        </div>
    </div>

</div>

@endsection
