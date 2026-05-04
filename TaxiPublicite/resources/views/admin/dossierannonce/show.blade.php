@extends('admin.layout.layout')

@section('title', 'show | dossier annonce')

@section('content')

<div class="container my-3">

    <div class="row justify-content-center">
        <div class="col-8">

            <div class="card shadow-lg">

                <div class="card-header fs-4 fw-bold">
                    Dossier Details
                </div>

                <ul class="list-group list-group-flush">

                    <li class="list-group-item">
                        Date création : {{ $dossierannonce->datecreation }}
                    </li>

                    <li class="list-group-item">
                        Annonceur : {{ $dossierannonce->annonceur->nom ?? '-' }}
                    </li>

                    <li class="list-group-item">
                        Service : {{ $dossierannonce->servicePublicitaire->nomservice ?? '-' }}
                    </li>

                    <li class="list-group-item">
                        Created : {{ $dossierannonce->created_at->diffForHumans() }}
                    </li>

                    <li class="list-group-item">
                        Updated : {{ $dossierannonce->updated_at->diffForHumans() }}
                    </li>

                </ul>

                <div class="card-footer d-flex gap-2">

                 

                    

                    <a href="{{ route('dossierannonce.index') }}"
                       class="btn btn-dark">
                        Retour
                    </a>

                </div>

            </div>

        </div>
    </div>

</div>

@endsection