@extends('admin.layout.layout')

@section('title', 'show | timesheet')

@section('content')

<div class="container my-3">

    <div class="row justify-content-center">
        <div class="col-8">

            <div class="card shadow-lg">

                <div class="card-header fs-4 fw-bold">
                    TimeSheet Details
                </div>

                <ul class="list-group list-group-flush">

                    <li class="list-group-item">
                        Date début : {{ $timesheet->datedebut }}
                    </li>

                    <li class="list-group-item">
                        Date fin : {{ $timesheet->datefin }}
                    </li>

                    <li class="list-group-item">
                        Heure début : {{ $timesheet->heuredebut }}
                    </li>

                    <li class="list-group-item">
                        Heure fin : {{ $timesheet->heurefin }}
                    </li>

                    <li class="list-group-item">
                        Service : {{ $timesheet->servicePublicitaire->nomservice ?? '-' }}
                    </li>

                    <li class="list-group-item">
                        Panneau : {{ $timesheet->panneauPublicitaire->nompanneau ?? '-' }}
                    </li>

                    <li class="list-group-item">
                        Created : {{ $timesheet->created_at->diffForHumans() }}
                    </li>

                    <li class="list-group-item">
                        Updated : {{ $timesheet->updated_at->diffForHumans() }}
                    </li>

                </ul>

                <div class="card-footer">
                    <a href="{{ route('timesheet.index') }}"
                       class="btn btn-dark">
                        Retour
                    </a>
                </div>

            </div>

        </div>
    </div>

</div>

@endsection