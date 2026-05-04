@extends('admin.layout.layout')

@section('title', 'edit | service publicitaire')

@section('content')

<div class="container my-3">

    <div class="row justify-content-center">
        <div class="col-md-10">

            <form action="{{ route('servicepublicitaire.update', $servicepublicitaire->id) }}"
                  method="post">
                @csrf
                @method('PUT')

                <div class="card shadow-lg">

                    <div class="card-header fs-4 fw-bold">
                        Edit Service Publicitaire
                    </div>

                    <div class="card-body">

                        <div class="mb-3">
                            <label>Nom</label>
                            <input type="text" name="nomservice"
                                   value="{{ old('nomservice', $servicepublicitaire->nomservice) }}"
                                   class="form-control">
                        </div>

                        <div class="mb-3">
                            <label>Description</label>
                            <textarea name="description"
                                      class="form-control">{{ old('description', $servicepublicitaire->description) }}</textarea>
                        </div>

                        <div class="mb-3">
                            <label>Tarif</label>
                            <input type="number" name="tarif"
                                   value="{{ old('tarif', $servicepublicitaire->tarif) }}"
                                   class="form-control">
                        </div>

                        <div class="mb-3">
                            <label>Durée</label>
                            <input type="number" name="dureejour"
                                   value="{{ old('dureejour', $servicepublicitaire->dureejour) }}"
                                   class="form-control">
                        </div>

                        <div class="mb-3">
                            <label>Actif</label>
                            <select name="actif" class="form-control">
                                <option value="1" @selected($servicepublicitaire->actif == 1)>Oui</option>
                                <option value="0" @selected($servicepublicitaire->actif == 0)>Non</option>
                            </select>
                        </div>

                        <div class="mb-3">
                            <label>Annonceur</label>
                            <select name="annonceur_id" class="form-control">
                                @foreach($annonceurs as $annonceur)
                                    <option value="{{ $annonceur->id }}"
                                        @selected($servicepublicitaire->annonceur_id == $annonceur->id)>
                                        {{ $annonceur->nom }}
                                    </option>
                                @endforeach
                            </select>
                        </div>

                    </div>

                    <div class="card-footer">
                        <button class="btn btn-primary">Update</button>
                        <a href="{{ route('servicepublicitaire.index') }}"
                           class="btn btn-dark">Retour</a>
                    </div>

                </div>

            </form>

        </div>
    </div>

</div>

@endsection