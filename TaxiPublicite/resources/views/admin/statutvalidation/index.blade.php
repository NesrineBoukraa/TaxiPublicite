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

                            <td>{{ $statut->dossierAnnonce->id ?? '-' }}</td>

                            <td>{{ $statut->created_at->diffForHumans() }}</td>
                            <td>{{ $statut->updated_at->diffForHumans() }}</td>

                         <td>
    <div class="d-flex flex-wrap gap-2">

        @if(auth()->user()->role === 'admin')

            {{-- VALIDER --}}
            <form action="" method="POST">
                @csrf
                @method('PATCH')

                <button type="submit"
                        class="btn btn-success btn-sm rounded-pill px-3 shadow-sm"
                        onclick="return confirm('Voulez-vous vraiment valider ce dossier ?')">

                    <i class="fas fa-check-circle me-1"></i>
                    Valider
                </button>
            </form>

            {{-- REFUSER --}}
            <form action="" method="POST">
                @csrf
                @method('PATCH')

                <button type="submit"
                        class="btn btn-danger btn-sm rounded-pill px-3 shadow-sm"
                        onclick="return confirm('Voulez-vous vraiment refuser ce dossier ?')">

                    <i class="fas fa-times-circle me-1"></i>
                    Refuser
                </button>
            </form>

        @endif

        {{-- SHOW --}}
        <a class="btn btn-info btn-sm text-white rounded-pill px-3 shadow-sm"
           href="{{ route('statutvalidation.show', $statut->id) }}">

            <i class="fas fa-eye me-1"></i>
            Show
        </a>

        {{-- EDIT --}}
        <a class="btn btn-warning btn-sm rounded-pill px-3 shadow-sm"
           href="{{ route('statutvalidation.edit', $statut->id) }}">

            <i class="fas fa-edit me-1"></i>
            Edit
        </a>

        {{-- DELETE --}}
        <form action="{{ route('statutvalidation.destroy', $statut->id) }}"
              method="POST">

            @csrf
            @method('DELETE')

            <button type="submit"
                    class="btn btn-dark btn-sm rounded-pill px-3 shadow-sm"
                    onclick="return confirm('Supprimer ce statut ?')">

                <i class="fas fa-trash-alt me-1"></i>
                Delete
            </button>

        </form>

    </div>
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
