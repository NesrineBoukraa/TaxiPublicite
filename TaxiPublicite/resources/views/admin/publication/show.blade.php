@extends('admin.layout.layout')

@section('title', 'show | publication')

@section('content')

<div class="container my-3">

    <div class="row justify-content-center">
        <div class="col-8">

            <div class="card shadow-lg">

                <div class="card-header fs-4 fw-bold">
                    Publication Details
                </div>

                <ul class="list-group list-group-flush">

                    <li class="list-group-item">
                        Titre : {{ $publication->titre }}
                    </li>

                    <li class="list-group-item">
                        Contenu : {{ $publication->contenu }}
                    </li>

                    <li class="list-group-item">
                        Date : {{ $publication->datepublication }}
                    </li>

                    <li class="list-group-item">
                        Actif : {{ $publication->actif ? 'Oui' : 'Non' }}
                    </li>

                    <li class="list-group-item">
                        URL média :
                        @if($publication->urlmedia)
                            <a href="{{ $publication->urlmedia }}" target="_blank">
                                lien
                            </a>
                        @else
                            -
                        @endif
                    </li>

                    <li class="list-group-item">
                        Dossier :
                        {{ $publication->dossierAnnonce->id ?? '-' }}
                    </li>

                    <li class="list-group-item">
                        Created : {{ $publication->created_at->diffForHumans() }}
                    </li>

                    <li class="list-group-item">
                        Updated : {{ $publication->updated_at->diffForHumans() }}
                    </li>

                </ul>

                <div class="card-footer">
                    <a href="{{ route('publication.index') }}"
                       class="btn btn-dark">
                        Retour
                    </a>
                </div>

            </div>

        </div>
    </div>

</div>

@endsection