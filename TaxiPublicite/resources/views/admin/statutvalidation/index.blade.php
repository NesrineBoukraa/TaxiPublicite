@extends('admin.layout.layout')

@section('title', 'index | statut validation')

@section('content')

<div class="container my-3">

    <div class="card">

        <div class="card-header fs-4 fw-bold">
            All {{ Str::plural('statut validation') }}
        </div>

        <div class="card-body">

            <div class="d-flex justify-content-between mb-3">
                <a class="btn btn-success rounded-pill px-4 fw-medium shadow-sm"
                   href="{{ route('statutvalidation.create') }}">
                    + Create Statut
                </a>
            </div>

            <div class="table-responsive">
                <table class="table table-bordered table-sm align-middle text-nowrap">

                    <thead>
                    <tr>
                        <th>Libellé</th>
                        <th>Date validation</th>
                        <th>Commentaire</th>
                        <th>Dossier</th>
                        <th>Created</th>
                        <th>Updated</th>
                        <th>Actions</th>
                    </tr>
                    </thead>

                    <tbody>
                    @foreach($statuts as $statut)
                        <tr>

                            <td>{{ $statut->libelle }}</td>

                            <td>{{ $statut->datevalidation }}</td>

                            <td>{{ Str::limit($statut->commentaire, 30) }}</td>

                            <td>{{ $statut->dossierAnnonces->titre ?? '-' }}</td>

                            <td>{{ $statut->created_at->diffForHumans() }}</td>
                            <td>{{ $statut->updated_at->diffForHumans() }}</td>

                            <td class="d-flex gap-1">

                                <a class="btn btn-sm btn-info text-white"
                                   href="{{ route('statutvalidation.show', $statut->id) }}">
                                    show
                                </a>

                                <a class="btn btn-sm btn-warning"
                                   href="{{ route('statutvalidation.edit', $statut->id) }}">
                                    edit
                                </a>

                                <form action="{{ route('statutvalidation.destroy', $statut->id) }}"
                                      method="post">
                                    @csrf
                                    @method('DELETE')

                                    <button class="btn btn-sm btn-danger"
                                            onclick="return confirm('Supprimer ce statut ?')">
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