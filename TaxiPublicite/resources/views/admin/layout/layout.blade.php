<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    {{--  <link rel="stylesheet" href="{{ asset('') }}">--}}
    <title>PubliciteTaxi | @yield('title')</title>
    @vite(['resources/js/app.js'])
</head>
<body class="min-vh-100 d-flex flex-column">

<nav class="navbar navbar-expand-lg bg-danger navbar-dark">
    <div class="container-fluid">

        <a class="navbar-brand" href="#">Navbar</a>

        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNavAltMarkup"
                aria-controls="navbarNavAltMarkup" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse justify-content-between" id="navbarNavAltMarkup">

            <div class="navbar-nav">
                <a class="nav-link" href="{{ route('dashboard') }}">Home</a>
                <a class="nav-link" href="{{ route('annonceur.index') }}">Annonceur</a>
                <a class="nav-link" href="{{ route('dossierannonce.index') }}">DossierAnnonce</a>
                <a class="nav-link" href="{{ route('servicepublicitaire.index') }}">ServicePublicitaire</a>
                <a class="nav-link" href="{{ route('publication.index') }}">Publication</a>
                 <a class="nav-link" href="{{ route('statutvalidation.index') }}">Statut Validation</a>
                  <a class="nav-link" href="{{ route('panneaupublicitaire.index') }}">Panneau Publicitaire</a>
             <a class="nav-link" href="{{ route('timesheet.index') }}">Timesheet</a>

            </div>

            <div class="navbar-nav">

                <span class="navbar-text">{{ auth()->user()->name }}</span>

                <form action="{{ route('logout') }}" method="post">
                    @csrf
                    <button type="submit" class="btn btn-link text-light text-decoration-none">Logout</button>
                </form>
            </div>

        </div>

    </div>
</nav>


@yield('content')

<div class="container-fluid mt-auto">
    <div class="row">
        <div class="col-12 py-3 bg-danger text-center"> Footer de la page Année {{ date('Y') }}
        </div>
    </div>
</div>

{{--<script src="{{ asset('') }}"></script>--}}
</body>
</html>
