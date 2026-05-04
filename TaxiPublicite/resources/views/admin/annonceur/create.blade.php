@extends('admin.layout.layout')

@section('title', 'create | annonceur' )

@section('content')

    <div class="container my-3">
        <div class="row justify-content-center">

            <div class="col-md-10">

                {{-- form begin --}}
                <form action="{{ route('annonceur.store') }}" method="post" enctype="multipart/form-data" class="">
                    @csrf


                    <div class="card shadow-lg">

                        {{--card title--}}
                        <div class="card-header fs-4 fw-bold">Create annonceur</div>

                        {{--card body--}}
                        <div class="card-body">


                            {{-- text --}}
                            <div class="mb-3">
                                <div class="row align-items-center">
                                    <div class="col-md-3">
                                        <label for="">Insert Nom : </label>
                                    </div>
                                    <div class="col-md-9">
                                        <input type="text"
                                               name="nom"
                                               autofocus
                                               value="{{ old('nom')  }}"
                                               class="form-control">
                                        @error('nom')
                                        <div class="alert alert-danger py-2 mt-2">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                            </div>

                            {{-- text --}}
                            <div class="mb-3">
                                <div class="row align-items-center">
                                    <div class="col-md-3">
                                        <label for="">Insert Email : </label>
                                    </div>
                                    <div class="col-md-9">
                                        <input type="text"
                                               name="email"
                                               autofocus
                                               value="{{ old('email')  }}"
                                               class="form-control">
                                        @error('email')
                                        <div class="alert alert-danger py-2 mt-2">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                            </div>

                            {{-- text --}}
                            <div class="mb-3">
                                <div class="row align-items-center">
                                    <div class="col-md-3">
                                        <label for="">Insert Telephone : </label>
                                    </div>
                                    <div class="col-md-9">
                                        <input type="text"
                                               name="telephone"
                                               autofocus
                                               value="{{ old('telephone')  }}"
                                               class="form-control">
                                        @error('telephone')
                                        <div class="alert alert-danger py-2 mt-2">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                            </div>

                            {{-- text --}}
                            <div class="mb-3">
                                <div class="row align-items-center">
                                    <div class="col-md-3">
                                        <label for="">Insert Adresse : </label>
                                    </div>
                                    <div class="col-md-9">
                                        <input type="text"
                                               name="adresse"
                                               autofocus
                                               value="{{ old('adresse')  }}"
                                               class="form-control">
                                        @error('adresse')
                                        <div class="alert alert-danger py-2 mt-2">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                            </div>



                        </div>{{--end card body--}}

                        {{--card footer--}}
                        <div class="card-footer">

                            <button type="submit" class="btn btn-primary">Submit</button>

                            <a class="btn btn-dark" href="{{ route('annonceur.index') }}">Retour</a>

                        </div>

                    </div>
                </form>
                {{-- form end --}}

            </div>

        </div>
    </div>

@endsection
