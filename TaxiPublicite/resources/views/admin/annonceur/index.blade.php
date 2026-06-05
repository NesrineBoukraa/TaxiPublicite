@extends('admin.layout.layout')

@section('title', 'Liste des Annonceurs')

@section('content')
<div class="container my-3">
    <div class="card shadow-sm">
        <div class="card-header fs-4 fw-bold d-flex justify-content-between align-items-center">
            <span>
                @if(auth()->user()->role === 'admin')
                    Tous les Annonceurs
                @else
                    Mon Profil Annonceur
                @endif
            </span>


        </div>

        <div class="card-body">
            @if(session('success'))
                <div class="alert alert-success">{{ session('success') }}</div>
            @endif
                <div class="card-body">

                    <div class="d-flex justify-content-between mb-3">
                        <a class="btn btn-success rounded-pill px-4 fw-medium shadow-sm"
                           href="{{ route('annonceur.create') }}">
                            + Create Annonceur
                        </a>
                    </div>

            <div class="table-responsive">
                <table class="table table-hover align-middle">
                    <thead class="table-light">
                        <tr>
                            <th>Nom</th>
                            <th>Email</th>
                            <th>Téléphone</th>
                            <th>Matricule Fiscale</th>
                            <th>Adresse</th>
                            <th class="text-center">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($annonceurs as $annonceur)
                            <tr>
                                <td class="fw-bold">{{ $annonceur->nom }}</td>
                                <td>{{ $annonceur->email }}</td>
                                <td>{{ $annonceur->telephone }}</td>
                                 <td>{{ $annonceur->matricule_fiscale }}</td>
                                <td>{{ Str::limit($annonceur->adresse, 40) }}</td>
                                <td class="d-flex gap-1">


                                    <a class="btn btn-sm btn-info text-white"
                                       href="{{ route('annonceur.show', $annonceur->id) }}">
                                        show
                                    </a>

                                    <a class="btn btn-sm btn-warning"
                                       href="{{ route('annonceur.edit', $annonceur->id) }}">
                                        edit
                                    </a>

                                    <form action="{{ route('annonceur.destroy', $annonceur->id) }}"
                                          method="post">
                                        @csrf
                                        @method('DELETE')

                                        <button class="btn btn-sm btn-danger"
                                                onclick="return confirm('Supprimer ce annonceur ?')">
                                            delete
                                        </button>

                                    </form>

                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="5" class="text-center">Aucun annonceur trouvé.</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
@endsection
