@extends('admin.layout.layout')

@section('title', 'index | dossier annonce')

@section('content')

<div class="container my-3">

    <div class="card">

        <div class="card-header fs-4 fw-bold">
            All {{ Str::plural('dossier annonce') }}
        </div>

        <div class="card-body">

            <div class="d-flex justify-content-between mb-3">
                <a class="btn btn-success rounded-pill px-4 fw-medium shadow-sm"
                   href="{{ route('dossierannonce.create') }}">
                    + Create Dossier
                </a>
            </div>

            <div class="table-responsive">
                <table class="table table-bordered table-sm align-middle text-nowrap">

                    <thead>
                    <tr>

                        <th>Annonceur</th>
                        <th>Service</th>
                        <th>Date de Creation</th>
                        <th>Created</th>
                        <th>Updated</th>
                        <th>Actions</th>
                    </tr>
                    </thead>

                    <tbody>
                    @foreach($dossierannonces as $dossierannonce)
                        <tr>


                            <td>{{ $dossierannonce->annonceur->nom ?? '-' }}</td>
                            <td>{{ $dossierannonce->servicePublicitaire->nomservice ?? '-' }}</td>
                            <td>{{ $dossierannonce->datecreation }}</td>
                            <td>{{ $dossierannonce->created_at->diffForHumans() }}</td>
                            <td>{{ $dossierannonce->updated_at->diffForHumans() }}</td>

                            <td class="d-flex gap-1">


                                <a class="btn btn-sm btn-info text-white"
                                   href="{{ route('dossierannonce.show', $dossierannonce->id) }}">
                                    show
                                </a>
 
                                <a class="btn btn-sm btn-warning"
                                   href="{{ route('dossierannonce.edit', $dossierannonce->id) }}">
                                    edit
                                </a>

                                <form action="{{ route('dossierannonce.destroy', $dossierannonce->id) }}"
                                      method="post">
                                    @csrf
                                    @method('DELETE')

                                    <button class="btn btn-sm btn-danger"
                                            onclick="return confirm('Supprimer ce dossier ?')">
                                        delete
                                    </button>

                                </form>

                            </td>

                        </tr>
                    @endforeach
                    </tbody>

                </table>
            </div>

        </div>

    </div>

</div>

@endsection
