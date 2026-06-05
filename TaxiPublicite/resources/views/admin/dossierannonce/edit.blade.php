@extends('admin.layout.layout')

@section('title', 'edit | dossier annonce')

@section('content')

<div class="container my-3">

    <div class="row justify-content-center">
        <div class="col-md-10">

            <form action="{{ route('dossierannonce.update', $dossierannonce->id) }}"
                  method="post">
                @csrf
                @method('PUT')

                <div class="card shadow-lg">

                    <div class="card-header fs-4 fw-bold">
                        Edit Dossier Annonce
                    </div>

                    <div class="card-body">

                        {{-- Date --}}
                        <div class="mb-3">
                            <label>Date création</label>
                            <input type="date" name="datecreation"
                                   value="{{ old('datecreation', $dossierannonce->datecreation) }}"
                                   class="form-control">
                        </div>

                        {{-- Annonceur --}}
                        <div class="mb-3">
                            <label>Annonceur</label>
                            <select name="annonceur_id" class="form-control">
                                @foreach($annonceurs ?? [] as $annonceur)
                                    <option value="{{ $annonceur->id }}"
                                        @selected($dossierannonce->annonceur_id == $annonceur->id)>
                                        {{ $annonceur->nom }}
                                    </option>
                                @endforeach
                            </select>
                        </div>

                        {{-- Service --}}
                        <div class="mb-3">
                            <label>Service</label>
                            <select name="service_publicitaire_id" class="form-control">
                                @foreach($services as $service)
                                    <option value="{{ $service->id }}"
                                        @selected($dossierannonce->service_publicitaire_id == $service->id)>
                                        {{ $service->nomservice }}
                                    </option>
                                @endforeach
                            </select>
                        </div>

                    </div>

                    <div class="card-footer">
                        <button class="btn btn-primary">Update</button>
                        <a href="{{ route('dossierannonce.index') }}"
                           class="btn btn-dark">Retour</a>
                    </div>

                </div>

            </form>

        </div>
    </div>

</div>

@endsection