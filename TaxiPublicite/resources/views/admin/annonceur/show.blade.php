@extends('admin.layout.layout')

@section('title', 'index | annonceur')

@section('content')

    <div class="container my-3">

        <div class="row justify-content-center">
            <div class="col-8">

                <div class="card shadow-lg">

                  
                    <div class="card-header fs-4 fw-bold">annonceur Details</div>

                  
                    <ul class="list-group list-group-flush">


                        <li class="list-group-item">
                            <div class="row">
                                <div class="col-4 text-secondary">Nom :</div>
                                <div class="col-6">{{$annonceur->nom}}</div>
                            </div>
                        </li>

                        <li class="list-group-item">
                            <div class="row">
                                <div class="col-4 text-secondary">Email :</div>
                                <div class="col-6">{{$annonceur->email}}</div>
                            </div>
                        </li>

                        <li class="list-group-item">
                            <div class="row">
                                <div class="col-4 text-secondary">Telephone :</div>
                                <div class="col-6">{{$annonceur->telephone}}</div>
                            </div>
                        </li>

                        <li class="list-group-item">
                            <div class="row">
                                <div class="col-4 text-secondary">Adresse :</div>
                                <div class="col-6">{{$annonceur->adresse}}</div>
                            </div>
                        </li>

                        <li class="list-group-item">
                            <div class="row">
                                <div class="col-6">{{$annonceur->created_at->diffForHumans()}}</div>
                            </div>
                        </li>
                        <li class="list-group-item">
                            <div class="row">
                                <div class="col-6">{{$annonceur->updated_at->diffForHumans()}}</div>
                            </div>
                        </li>

                    </ul>

                    
                    <div class="card-footer">
                        <a class="btn btn-dark" href="{{ route('annonceur.index') }}">Retour</a>
                    </div>

                </div>

            </div>
        </div>

    </div>

@endsection
