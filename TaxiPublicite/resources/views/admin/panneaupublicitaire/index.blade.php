@extends('admin.layout.layout')

@section('title', 'index | panneau publicitaire')

@section('content')

<div class="container my-3">

    <div class="card">

        <div class="card-header fs-4 fw-bold">
            All {{ Str::plural('panneau publicitaire') }}
        </div>

        <div class="card-body">

            <div class="d-flex justify-content-between mb-3">
                <a class="btn btn-success rounded-pill px-4 fw-medium shadow-sm"
                   href="{{ route('panneaupublicitaire.create') }}">
                    + Create un Panneau
                </a>

                <a class="btn btn-dark"
                   href="{{ route('panneaupublicitaire.disponibles') }}">
                    Panneaux disponibles
                </a>
            </div>

            <div class="table-responsive">
                <table class="table table-bordered table-sm align-middle text-nowrap">
                    <thead>
                    <tr>
                        <th>Nom</th>
                        <th>Largeur</th>
                        <th>Hauteur</th>
                        <th>Disponible</th>
                        <th>Service</th>
                        <th>Created</th>
                        <th>Updated</th>
                        <th>Actions</th>
                    </tr>
                    </thead>

                    <tbody>
                    @foreach($panneaux as $panneau)
                        <tr>
                            <td>{{ $panneau->nompanneau }}</td>
                            <td>{{ $panneau->largeur }}</td>
                            <td>{{ $panneau->hauteur }}</td>

                            <td>
                                @if($panneau->disponible)
                                    <span class="badge bg-success">Oui</span>
                                @else
                                    <span class="badge bg-danger">Non</span>
                                @endif
                            </td>

                            <td>{{ $panneau->servicePublicitaire->nomservice ?? '-' }}</td>

                            <td>{{ $panneau->created_at->diffForHumans() }}</td>
                            <td>{{ $panneau->updated_at->diffForHumans() }}</td>

                            <td class="d-flex gap-1">

                                <a class="btn btn-sm btn-info text-white"
                                   href="{{ route('panneaupublicitaire.show', $panneau->id) }}">
                                    show
                                </a>

                                <a class="btn btn-sm btn-warning"
                                   href="{{ route('panneaupublicitaire.edit', $panneau->id) }}">
                                    edit
                                </a>

                                <form action="{{ route('panneaupublicitaire.destroy', $panneau->id) }}"
                                      method="post">
                                    @csrf
                                    @method('DELETE')
                                    <button class="btn btn-sm btn-danger"
                                            onclick="return confirm('Supprimer ce panneau ?')">
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
