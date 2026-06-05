@extends('admin.layout.layout')

@section('title', 'Edit | annonceur' )

@section('content')

    <div class="container my-3">
        <div class="row justify-content-center">

            <div class="col-md-10">

                
                <form action="{{ route('annonceur.update', $annonceur->id) }}" method="post" enctype="multipart/form-data" class="">
                    @csrf
                    @method('PUT')

                    <div class="card shadow-lg">

                        
                        <div class="card-header fs-4 fw-bold">Create annonceur</div>

                        
                        <div class="card-body">


                           
                            <div class="mb-3">
                                <div class="row align-items-center">
                                    <div class="col-md-3">
                                        <label for="">Edit Nom : </label>
                                    </div>
                                    <div class="col-md-9">
                                        <input type="text"
                                               name="nom"
                                               autofocus
                                               value="{{ old('nom', $annonceur->nom)  }}"
                                               class="form-control">
                                        @error('nom')
                                        <div class="alert alert-danger py-2 mt-2">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                            </div>

                           
                            <div class="mb-3">
                                <div class="row align-items-center">
                                    <div class="col-md-3">
                                        <label for="">Edit Email : </label>
                                    </div>
                                    <div class="col-md-9">
                                        <input type="text"
                                               name="email"
                                               autofocus
                                               value="{{ old('email', $annonceur->email)  }}"
                                               class="form-control">
                                        @error('email')
                                        <div class="alert alert-danger py-2 mt-2">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                            </div>

                       
                            <div class="mb-3">
                                <div class="row align-items-center">
                                    <div class="col-md-3">
                                        <label for="">Edit Telephone : </label>
                                    </div>
                                    <div class="col-md-9">
                                        <input type="text"
                                               name="telephone"
                                               autofocus
                                               value="{{ old('telephone', $annonceur->telephone)  }}"
                                               class="form-control">
                                        @error('telephone')
                                        <div class="alert alert-danger py-2 mt-2">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                            </div>

                         
                            <div class="mb-3">
                                <div class="row align-items-center">
                                    <div class="col-md-3">
                                        <label for="">Edit matricule fiscale : </label>
                                    </div>
                                    <div class="col-md-9">
                                        <input type="text"
                                               name="matricule_fiscale"
                                               autofocus
                                               value="{{ old('adresse', $annonceur->matricule_fiscale)  }}"
                                               class="form-control">
                                        @error('matricule_fiscale')
                                        <div class="alert alert-danger py-2 mt-2">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                            </div>

                            <div class="mb-3">
                                <div class="row align-items-center">
                                    <div class="col-md-3">
                                        <label for="">Edit Adresse : </label>
                                    </div>
                                    <div class="col-md-9">
                                        <input type="text"
                                               name="adresse"
                                               autofocus
                                               value="{{ old('adresse', $annonceur->adresse)  }}"
                                               class="form-control">
                                        @error('adresse')
                                        <div class="alert alert-danger py-2 mt-2">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                            </div>



                        </div>

                    
                        <div class="card-footer">

                            <button type="submit" class="btn btn-primary">Submit</button>

                            <a class="btn btn-dark" href="{{ route('annonceur.index') }}">Retour</a>

                        </div>

                    </div>
                </form>
               

            </div>

        </div>
    </div>

@endsection
