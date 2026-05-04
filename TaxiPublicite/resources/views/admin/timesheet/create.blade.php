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

                        {{-- Service --}}
                        <div class="mb-3">
                            <label>Service publicitaire</label>
                            <select name="service_publicitaire_id" class="form-control">
                                @foreach($services as $service)
                                    <option value="{{ $service->id }}">
                                        {{ $service->nomservice }}
                                    </option>
                                @endforeach
                            </select>
                        </div>

                        {{-- Panneau --}}
                        <div class="mb-3">
                            <label>Panneau publicitaire</label>
                            <select name="panneau_publicitaire_id" class="form-control">
                                @foreach($panneaux as $panneau)
                                    <option value="{{ $panneau->id }}">
                                        {{ $panneau->nompanneau }}
                                    </option>
                                @endforeach
                            </select>
                        </div>

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