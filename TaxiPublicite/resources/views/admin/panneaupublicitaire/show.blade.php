@extends('admin.layout.layout')

@section('title', 'show | panneau publicitaire')

@section('content')

<div class="container my-3">

    <div class="row justify-content-center">
        <div class="col-8">

            <div class="card shadow-lg">

                <div class="card-header fs-4 fw-bold">
                    Panneau Details
                </div>

                <ul class="list-group list-group-flush">

                    <li class="list-group-item">
                        Nom : {{ $panneaupublicitaire->nompanneau }}
                    </li>

                    <li class="list-group-item">
                        Largeur : {{ $panneaupublicitaire->largeur }}
                    </li>

                    <li class="list-group-item">
                        Hauteur : {{ $panneaupublicitaire->hauteur }}
                    </li>

                    <li class="list-group-item">
                        Disponible :
                        {{ $panneaupublicitaire->disponible ? 'Oui' : 'Non' }}
                    </li>

                    <li class="list-group-item">
                        Service :
                        {{ $panneaupublicitaire->servicePublicitaire->nom ?? '-' }}
                    </li>

                    <li class="list-group-item">
                        Created : {{ $panneaupublicitaire->created_at->diffForHumans() }}
                    </li>

                    <li class="list-group-item">
                        Updated : {{ $panneaupublicitaire->updated_at->diffForHumans() }}
                    </li>

                </ul>

                <div class="card-footer">
                    <a href="{{ route('panneaupublicitaire.index') }}"
                       class="btn btn-dark">
                        Retour
                    </a>
                </div>

            </div>

        </div>
    </div>

</div>

@endsection