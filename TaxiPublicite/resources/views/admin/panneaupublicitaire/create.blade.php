@extends('admin.layout.layout')

@section('title', 'create | panneau publicitaire')

@section('content')

<div class="container my-3">
    <div class="row justify-content-center">
        <div class="col-md-10">

            <form action="{{ route('panneaupublicitaire.store') }}" method="post">
                @csrf

                <div class="card shadow-lg">

                    <div class="card-header fs-4 fw-bold">
                        Create Panneau Publicitaire
                    </div>

                    <div class="card-body">

                        {{-- Nom --}}
                        <div class="mb-3">
                            <label>Nom Panneau</label>
                            <input type="text" name="nompanneau"
                                   value="{{ old('nompanneau') }}"
                                   class="form-control">
                            @error('nompanneau')
                            <div class="alert alert-danger mt-2">{{ $message }}</div>
                            @enderror
                        </div>

                        {{-- Largeur --}}
                        <div class="mb-3">
                            <label>Largeur</label>
                            <input type="number" step="0.01" name="largeur"
                                   value="{{ old('largeur') }}"
                                   class="form-control">
                            @error('largeur')
                            <div class="alert alert-danger mt-2">{{ $message }}</div>
                            @enderror
                        </div>

                        {{-- Hauteur --}}
                        <div class="mb-3">
                            <label>Hauteur</label>
                            <input type="number" step="0.01" name="hauteur"
                                   value="{{ old('hauteur') }}"
                                   class="form-control">
                            @error('hauteur')
                            <div class="alert alert-danger mt-2">{{ $message }}</div>
                            @enderror
                        </div>

                        {{-- Disponible --}}
                        <div class="mb-3">
                            <label>Disponible</label>
                            <select name="disponible" class="form-control">
                                <option value="1">Oui</option>
                                <option value="0">Non</option>
                            </select>
                        </div>

                        {{-- Service --}}
                        <div class="mb-3">
                            <label>Service Publicitaire</label>
                            <select name="service_publicitaire_id" class="form-control">
                                @foreach($services as $service)
                                    <option value="{{ $service->id }}">
                                        {{ $service->nom }}
                                    </option>
                                @endforeach
                            </select>
                        </div>

                    </div>

                    <div class="card-footer">
                        <button class="btn btn-primary">Submit</button>
                        <a href="{{ route('panneaupublicitaire.index') }}"
                           class="btn btn-dark">Retour</a>
                    </div>

                </div>

            </form>

        </div>
    </div>
</div>

@endsection