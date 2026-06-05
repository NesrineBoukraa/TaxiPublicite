@extends('admin.layout.layout')

@section('title', 'create | timesheet')

@section('content')

<div class="container my-3">

    <div class="row justify-content-center">
        <div class="col-md-10">

            <form action="{{ route('timesheet.store') }}" method="post">
                @csrf

                <div class="card shadow-lg">

                    <div class="card-header fs-4 fw-bold">
                        Create TimeSheet
                    </div>

                    <div class="card-body">

                        {{-- Date début --}}
                        <div class="mb-3">
                            <label>Date début</label>
                            <input type="date" name="datedebut"
                                   value="{{ old('datedebut') }}"
                                   class="form-control">
                            @error('datedebut')
                            <div class="alert alert-danger mt-2">{{ $message }}</div>
                            @enderror
                        </div>

                        {{-- Date fin --}}
                        <div class="mb-3">
                            <label>Date fin</label>
                            <input type="date" name="datefin"
                                   value="{{ old('datefin') }}"
                                   class="form-control">
                            @error('datefin')
                            <div class="alert alert-danger mt-2">{{ $message }}</div>
                            @enderror
                        </div>

                        {{-- Heure début --}}
                        <div class="mb-3">
                            <label>Heure début</label>
                            <input type="time" name="heuredebut"
                                   value="{{ old('heuredebut') }}"
                                   class="form-control">
                            @error('heuredebut')
                            <div class="alert alert-danger mt-2">{{ $message }}</div>
                            @enderror
                        </div>

                        {{-- Heure fin --}}
                        <div class="mb-3">
                            <label>Heure fin</label>
                            <input type="time" name="heurefin"
                                   value="{{ old('heurefin') }}"
                                   class="form-control">
                            @error('heurefin')
                            <div class="alert alert-danger mt-2">{{ $message }}</div>
                            @enderror
                        </div>

                        {{-- Service Publicitaire --}}
                        <div class="mb-4">
                            <label class="form-label fw-bold">Service publicitaire</label>
                            <select name="service_publicitaire_id" class="form-select @error('service_publicitaire_id') is-invalid @enderror">
                                <option value="" selected disabled>Sélectionner un service...</option>
                                @foreach($services as $service)
                                    <option value="{{ $service->id }}" {{ old('service_publicitaire_id') == $service->id ? 'selected' : '' }}>
                                        {{ $service->nomservice }} ({{ $service->tarif }} DT)
                                    </option>
                                @endforeach
                            </select>
                            @error('service_publicitaire_id')
                            <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                    </div>

                        {{-- Annonceur --}}
                        <div class="mb-4 ps-3">
                            <label class="form-label fw-bold mb-2">Annonceur</label>
                            <select name="annonceur_id" class="form-select">
                                <option value="" disabled selected>Choisir un annonceur...</option>

                                @foreach($annonceurs as $annonceur)
                                    <option value="{{ $annonceur->id }}"
                                        {{ old('annonceur_id') == $annonceur->id ? 'selected' : '' }}>
                                        {{ $annonceur->nom }}
                                    </option>
                                @endforeach
                            </select>

                            @error('annonceur_id')
                            <div class="text-danger">{{ $message }}</div>
                            @enderror
                        </div>

                    {{-- Panneau Publicitaire --}}
                    <div class="mb-4 ps-3">
                        <label class="form-label fw-bold mb-2">Panneau publicitaire</label>

                        <select name="panneau_publicitaire_id"
                                class="form-select @error('panneau_publicitaire_id') is-invalid @enderror">

                            <option value="" selected disabled>Sélectionner un panneau...</option>

                            @foreach($panneaux as $panneau)
                                <option value="{{ $panneau->id }}"
                                    {{ old('panneau_publicitaire_id') == $panneau->id ? 'selected' : '' }}>
                                    {{ $panneau->nompanneau }}
                                </option>
                            @endforeach

                        </select>

                        @error('panneau_publicitaire_id')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                        @enderror
                    </div>


                    <div class="card-footer">
                        <button class="btn btn-primary">Submit</button>
                        <a href="{{ route('timesheet.index') }}"
                           class="btn btn-dark">Retour</a>
                    </div>

                </div>

        </form>

        </div>
    </div>

</div>

@endsection
