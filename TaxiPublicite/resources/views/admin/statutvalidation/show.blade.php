@extends('admin.layout.layout')

@section('title', 'show | statut validation')

@section('content')

<div class="container my-3">

    <div class="row justify-content-center">
        <div class="col-8">

            <div class="card shadow-lg">

                <div class="card-header fs-4 fw-bold">
                    Statut Details
                </div>

                <ul class="list-group list-group-flush">

                    <li class="list-group-item">
                        Libellé : {{ $statutvalidation->libelle }}
                    </li>

                    <li class="list-group-item">
                        Date validation : {{ $statutvalidation->datevalidation }}
                    </li>

                    <li class="list-group-item">
                        Commentaire : {{ $statutvalidation->commentaire ?? '-' }}
                    </li>

                    <li class="list-group-item">
                        Dossier :
                        {{ $statutvalidation->dossierAnnonces->titre ?? '-' }}
                    </li>

                    <li class="list-group-item">
                        Created : {{ $statutvalidation->created_at->diffForHumans() }}
                    </li>

                    <li class="list-group-item">
                        Updated : {{ $statutvalidation->updated_at->diffForHumans() }}
                    </li>

                </ul>

                <div class="card-footer">
                    <a href="{{ route('statutvalidation.index') }}"
                       class="btn btn-dark">
                        Retour
                    </a>
                </div>

            </div>

        </div>
    </div>

</div>

@endsection