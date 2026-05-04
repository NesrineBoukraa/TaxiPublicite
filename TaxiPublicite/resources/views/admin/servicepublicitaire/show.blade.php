@extends('admin.layout.layout')

@section('title', 'show | service publicitaire')

@section('content')

<div class="container my-3">

    <div class="row justify-content-center">
        <div class="col-8">

            <div class="card shadow-lg">

                <div class="card-header fs-4 fw-bold">
                    Service Details
                </div>

                <ul class="list-group list-group-flush">

                    <li class="list-group-item">
                        Nom : {{ $servicepublicitaire->nomservice }}
                    </li>

                    <li class="list-group-item">
                        Description : {{ $servicepublicitaire->description }}
                    </li>

                    <li class="list-group-item">
                        Tarif : {{ $servicepublicitaire->tarif }}
                    </li>

                    <li class="list-group-item">
                        Durée : {{ $servicepublicitaire->dureejour }} jours
                    </li>

                    <li class="list-group-item">
                        Actif :
                        {{ $servicepublicitaire->actif ? 'Oui' : 'Non' }}
                    </li>

                    <li class="list-group-item">
                        Annonceur :
                        {{ $servicepublicitaire->annonceur->nom ?? '-' }}
                    </li>

                    <li class="list-group-item">
                        Created : {{ $servicepublicitaire->created_at->diffForHumans() }}
                    </li>

                    <li class="list-group-item">
                        Updated : {{ $servicepublicitaire->updated_at->diffForHumans() }}
                    </li>

                </ul>

                <div class="card-footer">
                    <a href="{{ route('servicepublicitaire.index') }}"
                       class="btn btn-dark">
                        Retour
                    </a>
                </div>

            </div>

        </div>
    </div>

</div>

@endsection