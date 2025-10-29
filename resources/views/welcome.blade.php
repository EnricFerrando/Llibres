<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>RankIt - Benvingut</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

    <!-- Styles -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light text-dark">
    <div class="container mt-5">
        <!-- Header -->
        <div class="text-center mb-5">
            <img src="{{asset('LogoRankIt.png')}}" alt="RankIt Logo" class="img-fluid mb-3" style="max-width: 150px;">
            <h1 class="display-5">Benvingut a RankIt</h1>
            <p class="lead">Descobreix, valora i comparteix les teves opinions sobre llibres amb la nostra comunitat.</p>
        </div>

        <!-- Login Form -->
        <div class="row justify-content-center">
            <div class="col-md-6">
                <div class="card shadow-sm">
                    <div class="card-header bg-primary text-white text-center">
                        <h4>Inicia sessió</h4>
                    </div>
                    <div class="card-body">
                        <form method="POST" action="{{ route('login') }}">
                            @csrf

                            <!-- Email -->
                            <div class="mb-3">
                                <label for="email" class="form-label">Correu electrònic</label>
                                <input type="email" id="email" name="email" class="form-control" required autofocus>
                            </div>

                            <!-- Password -->
                            <div class="mb-3">
                                <label for="password" class="form-label">Contrasenya</label>
                                <input type="password" id="password" name="password" class="form-control" required>
                            </div>

                            <!-- Remember Me -->
                            <div class="form-check mb-3">
                                <input type="checkbox" id="remember" name="remember" class="form-check-input">
                                <label for="remember" class="form-check-label">Recorda’m</label>
                            </div>

                            <!-- Submit Button -->
                            <div class="d-flex justify-content-between align-items-center">
                                <button type="submit" class="btn btn-primary">Inicia sessió</button>
                                @if (Route::has('password.request'))
                                    <a href="{{ route('password.request') }}" class="text-decoration-none">Has oblidat la contrasenya?</a>
                                @endif
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>

        <!-- Register Link -->
        <div class="text-center mt-4">
            <p>Encara no tens un compte? <a href="{{ route('register') }}" class="text-primary">Registra't aquí</a></p>
        </div>
    </div>

    <!-- Footer -->
    <footer class="text-center py-4 mt-5 bg-white shadow-sm">
        <p class="mb-0">© {{ date('Y') }} RankIt. Tots els drets reservats.</p>
    </footer>

    <!-- Scripts -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
