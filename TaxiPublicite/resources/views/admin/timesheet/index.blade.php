@extends('admin.layout.layout')

@section('title', 'index | timesheet')

@section('content')

<div class="container my-3">

    <div class="card">

        <div class="card-header fs-4 fw-bold">
            All {{ Str::plural('timesheet') }}
        </div>

        <div class="card-body">

            <div class="d-flex justify-content-between mb-3">
                <a class="btn btn-success rounded-pill px-4 fw-medium shadow-sm"
                   href="{{ route('timesheet.create') }}">
                    + Create TimeSheet
                </a>
            </div>

            <div class="table-responsive">
                <table class="table table-bordered table-sm align-middle text-nowrap">

                    <thead>
                    <tr>
                        <th>Date début</th>
                        <th>Date fin</th>
                        <th>Heure début</th>
                        <th>Heure fin</th>
                        <th>Service</th>
                        <th>Panneau</th>
                        <th>Created</th>
                        <th>Updated</th>
                        <th>Actions</th>
                    </tr>
                    </thead>

                    <tbody>

                    @foreach($timeSheets as $ts)
                        <tr>

                            <td>{{ $ts->datedebut->diffForHumans()  }}</td>

                            <td>{{ $ts->datefin->diffForHumans()  }}</td>

                            <td>{{ $ts->heuredebut }}</td>

                            <td>{{ $ts->heurefin }}</td>

                            <td>{{ $ts->servicePublicitaire->nomservice ?? '-' }}</td>

                            <td>{{ $ts->panneauPublicitaire->nompanneau ?? '-' }}</td>

                            <td>{{ $ts->created_at->diffForHumans() }}</td>
                            <td>{{ $ts->updated_at->diffForHumans() }}</td>

                            <td class="d-flex gap-1">

                                <a class="btn btn-sm btn-info text-white"
                                   href="{{ route('timesheet.show', $ts->id) }}">
                                    show
                                </a>

                                <a class="btn btn-sm btn-warning"
                                   href="{{ route('timesheet.edit', $ts->id) }}">
                                    edit
                                </a>

                                <form action="{{ route('timesheet.destroy', $ts->id) }}"
                                      method="post">
                                    @csrf
                                    @method('DELETE')

                                    <button class="btn btn-sm btn-danger"
                                            onclick="return confirm('Supprimer ce timesheet ?')">
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