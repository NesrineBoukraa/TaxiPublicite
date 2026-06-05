<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>PubliciteTaxi | @yield('title')</title>
    @vite(['resources/js/app.js'])
</head>
<body class="min-vh-100 d-flex flex-column">

<nav class="navbar navbar-expand-lg bg-danger navbar-dark shadow-sm">
    <div class="container-fluid">
        <a class="navbar-brand fw-bold" href="{{ route('dashboard') }}">🚕 Dashboard </a>

        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNavAltMarkup"
                aria-controls="navbarNavAltMarkup" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse justify-content-between" id="navbarNavAltMarkup">
            <div class="navbar-nav">
                <a class="nav-link {{ request()->routeIs('dashboard') ? 'active' : '' }}" href="{{ route('dashboard') }}">Home</a>

                
                @if(auth()->user()->role === 'admin')
                    <a class="nav-link {{ request()->routeIs('annonceur.*') ? 'active' : '' }}" href="{{ route('annonceur.index') }}">Annonceurs</a>
                @endif

               
                <a class="nav-link {{ request()->routeIs('dossierannonce.*') ? 'active' : '' }}" href="{{ route('dossierannonce.index') }}">Dossiers</a>

               
                @if(auth()->user()->role === 'admin')
                    <a class="nav-link {{ request()->routeIs('servicepublicitaire.*') ? 'active' : '' }}" href="{{ route('servicepublicitaire.index') }}">Services</a>
                @else
                    <a class="nav-link {{ request()->routeIs('mesServices') ? 'active' : '' }}" href="{{ route('mesServices') }}">Mes Services</a>
                @endif

               
               
                    <a class="nav-link {{ request()->routeIs('publication.*') ? 'active' : '' }}" href="{{ route('publication.index') }}">Publications</a>
          

               
                @if(auth()->user()->role === 'admin')
                    <a class="nav-link {{ request()->routeIs('panneaupublicitaire.*') ? 'active' : '' }}" href="{{ route('panneaupublicitaire.index') }}">Panneaux</a>
                @endif

               
                <a class="nav-link {{ request()->routeIs('timesheet.*') ? 'active' : '' }}" href="{{ route('timesheet.index') }}">Timesheet</a>

              
                @if(auth()->user()->role === 'admin')
                    <a class="nav-link {{ request()->routeIs('statutvalidation.*') ? 'active' : '' }}" href="{{ route('statutvalidation.index') }}">Statuts</a>
                @endif
            </div>

            <div class="navbar-nav align-items-center">
                <div class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle text-white" href="#" role="button" data-bs-toggle="dropdown">
                        <i class="fas fa-user-circle"></i> {{ auth()->user()->name }} 
                        <span class="badge bg-white text-danger ms-1 text-uppercase" style="font-size: 0.7rem;">{{ auth()->user()->role }}</span>
                    </a>
                    <ul class="dropdown-menu dropdown-menu-end">
                        <li><a class="dropdown-item px-3 text-dark text-decoration-none" href="{{ route('profile.edit') }}">Mon Profil</a></li>
                        <li><hr class="dropdown-divider"></li>
                        <li>
                            <form action="{{ route('logout') }}" method="post" class="px-3">
                                @csrf
                                <button type="submit" class="btn btn-sm btn-outline-danger w-100">Déconnexion</button>
                            </form>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</nav>

<main class="py-4">
    @yield('content')
</main>

<footer class="container-fluid mt-auto">
    <div class="row">
        <div class="col-12 py-3 bg-danger text-white text-center"> 
            &copy; {{ date('Y') }} PubliciteTaxi - Tous droits réservés.
        </div>
    </div>
</footer>

</body>
</html>