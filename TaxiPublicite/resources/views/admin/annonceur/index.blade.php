@extends('admin.layout.layout')

@section('title', 'index | annonceur')

@section('content')

    {{-- begin container --}}
    <div class="container my-3">

        <div class="card">

            {{-- card header --}}
            <div class="card-header fs-4 fw-bold">All {{ Str::plural('annonceur') }}</div>
            <br>
            {{-- card body --}}
            <div class="card-body">

                {{-- button trashes + button create --}}
                <div class="d-flex justify-content-between mb-3">
                    <br>
                    <a class="btn btn-success rounded-pill px4 fw-medium shadow-sm" href="{{ route('annonceur.create')}}">+ Create un Annonceur</a>
                </div>
                <div class="table-responsive">
                    <table class="table table-bordered table-sm align-middle text-nowrap">
                        <thead>
                        <tr>
                            <th>Nom</th>
                            <th>Email</th>
                            <th>Telephone</th>
                            <th>Adresse</th>
                            <th>Created_at</th>
                            <th>Updated_at</th>
                            <th >Actions</th>
                        </tr>
                        </thead>
                        <tbody>


                        {{-- listing all resources --}}
                @foreach( $annonceurs as $annonceur)
                    <tr>

                        <td>{{ Str::limit($annonceur->nom) }}</td>
                        <td>{{ Str::limit($annonceur->email) }}</td>
                        <td>{{ Str::limit($annonceur->telephone) }}</td>
                        <td>{{ Str::limit($annonceur->adresse) }}</td>
                        <td>{{ $annonceur->created_at->diffForHumans() }}</td>
                        <td>{{ $annonceur->updated_at->diffForHumans() }}</td>


                        {{-- actions --}}
                        <td class="d-flex gap-1">

                            <a class="btn btn-sm btn-info text-white"
                               href="{{ route('annonceur.show', $annonceur->id)  }}">
                                show
                            </a>

                            <a class="btn btn-sm btn-warning text-dark"
                               href="{{ route('annonceur.edit', $annonceur->id)  }}">
                                edit
                            </a>

                            <form action="{{ route('annonceur.destroy', $annonceur->id)  }}" method="post">
                                @csrf
                                @method('DELETE')
                                <button onclick ="return confirm ('vous voulez supprimer ce annonceur ?')"  class="btn btn-sm btn-danger">destroy</button>
                            </form>

                        </td>
                    </tr>

                    @endforeach

                        </tbody>
                    </table>
                </div>


                {{-- card footer --}}
            <div class="card-footer"></div>


        </div>

    </div>
    {{-- end container --}}
    </div>
@endsection
