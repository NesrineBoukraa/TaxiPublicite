@extends('admin.layout.layout')

@section('title', 'index | publication')

@section('content')

<div class="container my-3">

    <div class="card">

        <div class="card-header fs-4 fw-bold">
            All {{ Str::plural('publication') }}
        </div>

        <div class="card-body">

            <div class="d-flex justify-content-between mb-3">

                <a class="btn btn-success rounded-pill px-4 fw-medium shadow-sm"
                   href="{{ route('publication.create') }}">
                    + Create Publication
                </a>

              

            </div>

            <div class="table-responsive">
                <table class="table table-bordered table-sm align-middle text-nowrap">

                    <thead>
                    <tr>
                        <th>Titre</th>
                        <th>Contenu</th>
                        <th>Date</th>
                        <th>Actif</th>
                        <th>URL média</th>
                        <th>Dossier</th>
                        <th>Created</th>
                        <th>Updated</th>
                        <th>Actions</th>
                    </tr>
                    </thead>

                    <tbody>

                    @foreach($publications as $publication)
                        <tr>

                            <td>{{ $publication->titre }}</td>

                            <td>{{ Str::limit($publication->contenu, 30) }}</td>

                            <td>{{ $publication->datepublication }}</td>

                            <td>
                                @if($publication->actif)
                                    <span class="badge bg-success">Oui</span>
                                @else
                                    <span class="badge bg-danger">Non</span>
                                @endif
                            </td>

                            <td>
                                @if($publication->urlmedia)
                                    <a href="{{ $publication->urlmedia }}" target="_blank">
                                        lien
                                    </a>
                                @else
                                    -
                                @endif
                            </td>

                            <td>{{ $publication->dossierAnnonce->id ?? '-' }}</td>

                            <td>{{ $publication->created_at->diffForHumans() }}</td>
                            <td>{{ $publication->updated_at->diffForHumans() }}</td>

                            <td class="d-flex gap-1">

                                <a class="btn btn-sm btn-info text-white"
                                   href="{{ route('publication.show', $publication->id) }}">
                                    show
                                </a>

                                <a class="btn btn-sm btn-warning"
                                   href="{{ route('publication.edit', $publication->id) }}">
                                    edit
                                </a>

                                <form action="{{ route('publication.destroy', $publication->id) }}"
                                      method="post">
                                    @csrf
                                    @method('DELETE')

                                    <button class="btn btn-sm btn-danger"
                                            onclick="return confirm('Supprimer cette publication ?')">
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