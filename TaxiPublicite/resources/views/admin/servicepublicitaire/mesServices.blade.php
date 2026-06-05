@extends('admin.layout.layout')

@section('title', 'index | service publicitaire')

@section('content')

<div class="container my-3">

    <div class="card">

        <div class="card-header fs-4 fw-bold">
            Mes {{ Str::plural('service publicitaire') }}
        </div>

        <div class="card-body">

            

            <div class="table-responsive">
                <table class="table table-bordered table-sm align-middle text-nowrap">

                    <thead>
                    <tr>
                        <th>Nom</th>
                        <th>Description</th>
                        <th>Tarif</th>
                        <th>Durée (jours)</th>
                        <th>Actif</th>
                     
                        <th>Created</th>
                        <th>Updated</th>
                       
                    </tr>
                    </thead>

                    <tbody>
                    @foreach($services as $service)
                        <tr>

                            <td>{{ $service->nomservice }}</td>

                            <td>{{ Str::limit($service->description, 30) }}</td>

                            <td>{{ $service->tarif }}</td>

                            <td>{{ $service->dureejour }}</td>

                            <td>
                                @if($service->actif)
                                    <span class="badge bg-success">Oui</span>
                                @else
                                    <span class="badge bg-danger">Non</span>
                                @endif
                            </td>


                            <td>{{ $service->created_at->diffForHumans() }}</td>
                            <td>{{ $service->updated_at->diffForHumans() }}</td>

                            

                        </tr>
                    @endforeach
                    </tbody>

                </table>
            </div>

        </div>

    </div>

</div>

@endsection