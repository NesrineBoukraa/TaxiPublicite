@extends('admin.layout.layout')

@section('title', 'edit | timesheet')

@section('content')

<div class="container my-3">

    <div class="row justify-content-center">
        <div class="col-md-10">

            <form action="{{ route('timesheet.update', $timesheet->id) }}"
                  method="post">
                @csrf
                @method('PUT')

                <div class="card shadow-lg">

                    <div class="card-header fs-4 fw-bold">
                        Edit TimeSheet
                    </div>

                    <div class="card-body">

                        <div class="mb-3">
                            <label>Date début</label>
                            <input type="date" name="datedebut"
                                   value="{{ old('datedebut', $timesheet->datedebut) }}"
                                   class="form-control">
                        </div>

                        <div class="mb-3">
                            <label>Date fin</label>
                            <input type="date" name="datefin"
                                   value="{{ old('datefin', $timesheet->datefin) }}"
                                   class="form-control">
                        </div>

                        <div class="mb-3">
                            <label>Heure début</label>
                            <input type="time" name="heuredebut"
                                   value="{{ old('heuredebut', $timesheet->heuredebut) }}"
                                   class="form-control">
                        </div>

                        <div class="mb-3">
                            <label>Heure fin</label>
                            <input type="time" name="heurefin"
                                   value="{{ old('heurefin', $timesheet->heurefin) }}"
                                   class="form-control">
                        </div>

                        <div class="mb-3">
                            <label>Service</label>
                            <select name="service_publicitaire_id" class="form-control">
                                @foreach($services as $service)
                                    <option value="{{ $service->id }}"
                                        @selected($timesheet->service_publicitaire_id == $service->id)>
                                        {{ $service->nomservice }}
                                    </option>
                                @endforeach
                            </select>
                        </div>

                        {{-- Annonceur --}}
                        <div class="mb-3">
                            <label class="form-label">Annonceur</label>

                            <select name="annonceur_id" class="form-control">

                                @foreach($annonceurs as $annonceur)
                                    <option value="{{ $annonceur->id }}"
                                        @selected(old('annonceur_id', $timesheet->annonceur_id) == $annonceur->id)>
                                        {{ $annonceur->nom }}
                                    </option>
                                @endforeach

                            </select>

                            @error('annonceur_id')
                            <div class="text-danger">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label>Panneau</label>
                            <select name="panneau_publicitaire_id" class="form-control">
                                @foreach($panneaux as $panneau)
                                    <option value="{{ $panneau->id }}"
                                        @selected($timesheet->panneau_publicitaire_id == $panneau->id)>
                                        {{ $panneau->nompanneau }}
                                    </option>
                                @endforeach
                            </select>
                        </div>

                    </div>


                    <div class="card-footer">
                        <button class="btn btn-primary">Update</button>
                        <a href="{{ route('timesheet.index') }}"
                           class="btn btn-dark">Retour</a>
                    </div>

                </div>

            </form>

        </div>
    </div>

</div>

@endsection
