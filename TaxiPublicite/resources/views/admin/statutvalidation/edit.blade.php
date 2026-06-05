@extends('admin.layout.layout')

@section('title', 'Edit | Statut Validation')

@section('content')

<div class="container my-4">

    <div class="row justify-content-center">
        <div class="col-lg-8">

            <form action="{{ route('statutvalidation.update', $statutvalidation->id) }}"
                  method="POST">

                @csrf
                @method('PUT')

                <div class="card shadow border-0 rounded-4">

                    {{-- HEADER --}}
                    <div class="card-header bg-dark text-white rounded-top-4 py-3">
                        <h4 class="mb-0 fw-bold">
                            <i class="fas fa-edit me-2"></i>
                            Modifier le statut de validation
                        </h4>
                    </div>

                    {{-- BODY --}}
                    <div class="card-body p-4">

                        {{-- SUCCESS MESSAGE --}}
                        @if(session('success'))
                            <div class="alert alert-success">
                                {{ session('success') }}
                            </div>
                        @endif

                        {{-- ERREURS --}}
                        @if($errors->any())
                            <div class="alert alert-danger">
                                <ul class="mb-0">
                                    @foreach($errors->all() as $error)
                                        <li>{{ $error }}</li>
                                    @endforeach
                                </ul>
                            </div>
                        @endif

                        {{-- LIBELLE --}}
                        <div class="mb-4">
                            <label class="form-label fw-semibold">
                                Libellé
                            </label>

                            <input type="text"
                                   name="libelle"
                                   value="{{ old('libelle', $statutvalidation->libelle) }}"
                                   class="form-control rounded-3">

                        </div>

                        {{-- DATE VALIDATION --}}
                        <div class="mb-4">
                            <label class="form-label fw-semibold">
                                Date validation
                            </label>

                            <input type="date"
                                   name="datevalidation"
                                   value="{{ old('datevalidation', $statutvalidation->datevalidation?->format('Y-m-d')) }}"
                                   class="form-control rounded-3">

                        </div>

                        {{-- COMMENTAIRE --}}
                        <div class="mb-4">
                            <label class="form-label fw-semibold">
                                Commentaire
                            </label>

                            <textarea name="commentaire"
                                      rows="4"
                                      class="form-control rounded-3">{{ old('commentaire', $statutvalidation->commentaire) }}</textarea>

                        </div>

                        {{-- DOSSIER --}}
                        <div class="mb-4">
                            <label class="form-label fw-semibold">
                                Dossier annonce
                            </label>

                            <select name="dossier_annonce_id"
                                    class="form-select rounded-3">

                                @foreach($dossiers as $dossier)

                                    <option value="{{ $dossier->id }}"
                                        {{ old('dossier_annonce_id', $statutvalidation->dossier_annonce_id) == $dossier->id ? 'selected' : '' }}>

                                        Dossier #{{ $dossier->id }}

                                    </option>

                                @endforeach

                            </select>
                        </div>

                    </div>

                    {{-- FOOTER --}}
                    <div class="card-footer bg-white border-0 p-4">

                        <div class="d-flex gap-2">

                            <button type="submit"
                                    class="btn btn-success rounded-pill px-4 shadow-sm">

                                <i class="fas fa-save me-1"></i>
                                Update
                            </button>

                            <a href="{{ route('statutvalidation.index') }}"
                               class="btn btn-secondary rounded-pill px-4 shadow-sm">

                                <i class="fas fa-arrow-left me-1"></i>
                                Retour
                            </a>

                        </div>

                    </div>

                </div>

            </form>

        </div>
    </div>

</div>

@endsection