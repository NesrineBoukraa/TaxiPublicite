@extends('admin.layout.layout')

@section('title', 'edit | panneau publicitaire')

@section('content')

<div class="container my-3">
    <div class="row justify-content-center">
        <div class="col-md-10">

            <form action="{{ route('panneaupublicitaire.update', $panneaupublicitaire->id) }}"
                  method="post">
                @csrf
                @method('PUT')

                <div class="card shadow-lg">

                    <div class="card-header fs-4 fw-bold">
                        Edit Panneau Publicitaire
                    </div>

                    <div class="card-body">

                        <input type="hidden" name="id" value="{{ $panneaupublicitaire->id }}">

                        <div class="mb-3">
                            <label>Nom</label>
                            <input type="text" name="nompanneau"
                                   value="{{ old('nompanneau', $panneaupublicitaire->nompanneau) }}"
                                   class="form-control">
                        </div>

                        <div class="mb-3">
                            <label>Largeur</label>
                            <input type="number" name="largeur"
                                   value="{{ old('largeur', $panneaupublicitaire->largeur) }}"
                                   class="form-control">
                        </div>

                        <div class="mb-3">
                            <label>Hauteur</label>
                            <input type="number" name="hauteur"
                                   value="{{ old('hauteur', $panneaupublicitaire->hauteur) }}"
                                   class="form-control">
                        </div>

                        <div class="mb-3">
                            <label>Disponible</label>
                            <select name="disponible" class="form-control">
                                <option value="1" @selected($panneaupublicitaire->disponible == 1)>Oui</option>
                                <option value="0" @selected($panneaupublicitaire->disponible == 0)>Non</option>
                            </select>
                        </div>

                        <div class="mb-3">
                            <label>Service</label>
                            <select name="service_publicitaire_id" class="form-control">
                                @foreach($services as $service)
                                    <option value="{{ $service->id }}"
                                        @selected($panneaupublicitaire->service_publicitaire_id == $service->id)>
                                        {{ $service->nomservice }}
                                    </option>
                                @endforeach
                            </select>
                        </div>

                    </div>

                    <div class="card-footer">
                        <button class="btn btn-primary">Update</button>
                        <a href="{{ route('panneaupublicitaire.index') }}"
                           class="btn btn-dark">Retour</a>
                    </div>

                </div>

            </form>

        </div>
    </div>
</div>

@endsection
