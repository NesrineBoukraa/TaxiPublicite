@extends('admin.layout.layout')

@section('title', 'index | service publicitaire')

@section('content')

<div class="container my-3">

    <div class="card">

        <div class="card-header fs-4 fw-bold">
            All {{ Str::plural('service publicitaire') }}
        </div>

        <div class="card-body">

            <div class="d-flex justify-content-between mb-3">
                <a class="btn btn-success rounded-pill px-4 fw-medium shadow-sm"
                   href="{{ route('servicepublicitaire.create') }}">
                    + Create Service
                </a>
            </div>

            <div class="table-responsive">
                <table class="table table-bordered table-sm align-middle text-nowrap">

                    <thead>
                    <tr>
                        <th>Nom</th>
                        <th>Description</th>
                        <th>Tarif</th>
                        <th>Durée (jours)</th>
                        <th>Actif</th>
                        <th>Annonceur</th>
                        <th>Created</th>
                        <th>Updated</th>
                        <th>Actions</th>
                    </tr>
                    </thead>

                    <tbody>
                    @foreach($services as $service)
                        <tr>

                            <td>{{ $service->nomservice }}</td>

                            <td>{{ Str::limit($service->description, 30) }}</td>

                            <td>{{ $service->tarif }}</td>

                            <td>{{ $service->dureejour }}</td>

                            <td>
                                @if($service->actif)
                                    <span class="badge bg-success">Oui</span>
                                @else
                                    <span class="badge bg-danger">Non</span>
                                @endif
                            </td>

                            <td>{{ $service->annonceur->nom ?? '-' }}</td>

                            <td>{{ $service->created_at->diffForHumans() }}</td>
                            <td>{{ $service->updated_at->diffForHumans() }}</td>

                            <td class="d-flex gap-1">

                                <a class="btn btn-sm btn-info text-white"
                                   href="{{ route('servicepublicitaire.show', $service->id) }}">
                                    show
                                </a>

                                <a class="btn btn-sm btn-warning"
                                   href="{{ route('servicepublicitaire.edit', $service->id) }}">
                                    edit
                                </a>

                                <form action="{{ route('servicepublicitaire.destroy', $service->id) }}"
                                      method="post">
                                    @csrf
                                    @method('DELETE')

                                    <button class="btn btn-sm btn-danger"
                                            onclick="return confirm('Supprimer ce service ?')">
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