@extends('admin.layout.layout')

@section('title', 'edit | statut validation')

@section('content')

<div class="container my-3">

    <div class="row justify-content-center">
        <div class="col-md-10">

            <form action="{{ route('statutvalidation.update', $statutvalidation->id) }}"
                  method="post">
                @csrf
                @method('PUT')

                <div class="card shadow-lg">

                    <div class="card-header fs-4 fw-bold">
                        Edit Statut Validation
                    </div>

                    <div class="card-body">

                        {{-- Libellé --}}
                        <div class="mb-3">
                            <label>Libellé</label>
                            <input type="text" name="libelle"
                                   value="{{ old('libelle', $statutvalidation->libelle) }}"
                                   class="form-control">
                        </div>

                        {{-- Date --}}
                        <div class="mb-3">
                            <label>Date validation</label>
                            <input type="date" name="datevalidation"
                                   value="{{ old('datevalidation', $statutvalidation->datevalidation) }}"
                                   class="form-control">
                        </div>

                        {{-- Commentaire --}}
                        <div class="mb-3">
                            <label>Commentaire</label>
                            <textarea name="commentaire"
                                      class="form-control">{{ old('commentaire', $statutvalidation->commentaire) }}</textarea>
                        </div>

                    </div>

                    <div class="card-footer">
                        <button class="btn btn-primary">Update</button>
                        <a href="{{ route('statutvalidation.index') }}"
                           class="btn btn-dark">Retour</a>
                    </div>

                </div>

            </form>

        </div>
    </div>

</div>

@endsection