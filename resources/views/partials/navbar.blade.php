{{-- filepath: c:\xampp\htdocs\DWES\Laravel\puntuacioLlibre\rankIt\resources\views\partials\navbar.blade.php --}}
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
<nav class="navbar navbar-expand-lg" style="background-color: #4ad400; margin-bottom: 50px;">
    <div class="container">
        <!-- Logo de l'app -->
        <a class="navbar-brand d-flex align-items-center" href="/">
            <img src="{{ asset('LogoRankIt.png') }}" alt="RankIt Logo" style="height:40px; margin-right:10px;">
            <span class="fw-bold text-white" style="font-size: 1.3rem;">RankIt</span>
        </a>

        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>

        @if(Auth::check())
            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav me-auto">
                    @if(Auth::user()->email === 'admin@admin.com' || Auth::user()->email === 'admin@admin.es')
                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle text-white" href="#" id="adminDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                                Administració
                            </a>
                            <ul class="dropdown-menu" aria-labelledby="adminDropdown">
                                <li><a class="dropdown-item" href="{{ route('books.index') }}">Llibres</a></li>
                                <li><a class="dropdown-item" href="{{ route('users.index') }}">Usuaris</a></li>
                                <li><a class="dropdown-item" href="{{ route('categories.index') }}">Categories</a></li>
                            </ul>
                        </li>
                    @endif
                </ul>

                <ul class="navbar-nav ms-auto">
                    <li class="nav-item">
                        <form action="{{ url('/logout') }}" method="POST" style="display:inline">
                            @csrf
                            <button type="submit" class="btn btn-link nav-link text-white" style="display:inline;cursor:pointer">
                                Tanca sessió
                            </button>
                        </form>
                    </li>
                    <li>
                        <div class="dropdown">
                            <button class="btn btn-link nav-link dropdown-toggle text-white" type="button" id="userDropdown" data-bs-toggle="dropdown" aria-expanded="false">
                                {{ Auth::user()->name }}
                            </button>
                            <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="userDropdown">
                                <li><a class="dropdown-item" href="{{ route('profile.edit') }}">{{ __('Perfil') }}</a></li>
                                <li><hr class="dropdown-divider"></li>
                                <li>
                                    <form method="POST" action="{{ route('logout') }}">
                                        @csrf
                                        <button class="dropdown-item" type="submit">{{ __('Tanca sessió') }}</button>
                                    </form>
                                </li>
                            </ul>
                        </div>
                    </li>
                </ul>
            </div>
        @endif
    </div>
</nav>