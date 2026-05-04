@extends('admin.layout.layout')

@section('title', 'create | dossier annonce')

@section('content')

<div class="container my-3">

    <div class="row justify-content-center">
        <div class="col-md-10">

            <form action="{{ route('dossierannonce.store') }}" method="post">
                @csrf

                <div class="card shadow-lg">

                    <div class="card-header fs-4 fw-bold">
                        Create Dossier Annonce
                    </div>

                    <div class="card-body">

                        {{-- Date création --}}
                        <div class="mb-3">
                            <label>Date création</label>
                            <input type="date" name="datecreation"
                                   value="{{ old('datecreation') }}"
                                   class="form-control">
                            @error('datecreation')
                            <div class="alert alert-danger mt-2">{{ $message }}</div>
                            @enderror
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

                            @error('annonceur_id')
                            <div class="alert alert-danger mt-2">{{ $message }}</div>
                            @enderror
                        </div>

                        {{-- Service --}}
                        <div class="mb-3">
                            <label>Service publicitaire</label>
                            <select name="service_publicitaire_id" class="form-control">
                                @foreach($services as $service)
                                    <option value="{{ $service->id }}">
                                        {{ $service->nomservice }}
                                    </option>
                                @endforeach
                            </select>

                            @error('service_publicitaire_id')
                            <div class="alert alert-danger mt-2">{{ $message }}</div>
                            @enderror
                        </div>

                    </div>

                    <div class="card-footer">
                        <button class="btn btn-primary">Submit</button>
                        <a href="{{ route('dossierannonce.index') }}"
                           class="btn btn-dark">Retour</a>
                    </div>

                </div>

            </form>

        </div>
    </div>

</div>

@endsection