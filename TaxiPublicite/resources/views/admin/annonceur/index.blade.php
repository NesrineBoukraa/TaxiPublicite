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
                                <td class="text-center">
                                    <div class="d-flex justify-content-center gap-2">
                                        {{-- Voir et Modifier : Accessible à l'Admin ET au propriétaire du compte --}}
                                        <a href="{{ route('annonceur.show', $annonceur->id) }}" class="btn btn-sm btn-info text-white">
                                            <i class="fas fa-eye"></i> Voir
                                        </a>
                                        
                                                 @if(auth()->user()->role === 'annonceur')
                                        <a href="{{ route('annonceur.edit', $annonceur->id) }}" class="btn btn-sm btn-warning">
                                            <i class="fas fa-edit"></i> Modifier
                                        </a>

                                        <form action="{{ route('annonceur.destroy', $annonceur->id) }}" method="POST" onsubmit="return confirm('Supprimer cet annonceur définitivement ?')">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-sm btn-danger">
                                                    <i class="fas fa-trash"></i> Supprimer
                                                </button>
                                            </form>

                                          @endif

                                        
                                    </div>
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