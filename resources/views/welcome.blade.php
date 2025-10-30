@extends('layouts.master')

@section('title', 'RankIt - La teva comunitat de llibres')

@section('content')
<div class="container-fluid px-0">
    <!-- Hero Section -->
    <div class="position-relative overflow-hidden text-center bg-primary text-white mb-5" style="padding: 7rem 0;">
        <div class="col-md-8 p-lg-5 mx-auto my-5">
            <h1 class="display-4 fw-bold">Descobreix i valora els teus llibres preferits</h1>
            <p class="lead mb-4">Uneix-te a la comunitat de lectors més activa. Comparteix les teves opinions, descobreix noves lectures i connecta amb altres amants de la lectura.</p>
            <div class="d-flex gap-3 justify-content-center">
                @auth
                    <a href="{{ route('index.guests') }}" class="btn btn-light btn-lg px-4">
                        <i class="bi bi-book me-2"></i>Explora llibres
                    </a>
                @else
                    <a href="{{ route('register') }}" class="btn btn-light btn-lg px-4">
                        <i class="bi bi-person-plus me-2"></i>Registra't
                    </a>
                    <a href="{{ route('login') }}" class="btn btn-outline-light btn-lg px-4">
                        <i class="bi bi-box-arrow-in-right me-2"></i>Inicia sessió
                    </a>
                @endauth
            </div>
        </div>
    </div>

    <!-- Features Section -->
    <div class="container mb-5">
        <div class="row g-4">
            <div class="col-md-4">
                <div class="card h-100 shadow-sm border-0">
                    <div class="card-body text-center">
                        <div class="feature-icon bg-primary bg-gradient text-white rounded-circle mb-3" style="width: 64px; height: 64px; display: inline-flex; align-items: center; justify-content: center;">
                            <i class="bi bi-star-fill fs-4"></i>
                        </div>
                        <h3 class="fs-4">Valora llibres</h3>
                        <p class="text-muted">Comparteix la teva opinió sobre els llibres que has llegit i ajuda altres lectors a trobar la seva propera lectura.</p>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="card h-100 shadow-sm border-0">
                    <div class="card-body text-center">
                        <div class="feature-icon bg-primary bg-gradient text-white rounded-circle mb-3" style="width: 64px; height: 64px; display: inline-flex; align-items: center; justify-content: center;">
                            <i class="bi bi-people-fill fs-4"></i>
                        </div>
                        <h3 class="fs-4">Connecta amb lectors</h3>
                        <p class="text-muted">Forma part d'una comunitat activa de lectors, comparteix ressenyes i descobreix recomanacions personalitzades.</p>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="card h-100 shadow-sm border-0">
                    <div class="card-body text-center">
                        <div class="feature-icon bg-primary bg-gradient text-white rounded-circle mb-3" style="width: 64px; height: 64px; display: inline-flex; align-items: center; justify-content: center;">
                            <i class="bi bi-bookmark-heart-fill fs-4"></i>
                        </div>
                        <h3 class="fs-4">Descobreix novetats</h3>
                        <p class="text-muted">Mantén-te al dia de les últimes novetats literàries i troba llibres adaptats als teus interessos i edat.</p>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Call to Action -->
    <div class="container-fluid bg-light py-5">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-md-8">
                    <h2>Preparat per començar?</h2>
                    <p class="lead mb-0">Uneix-te ara a la nostra comunitat i comença a descobrir i valorar els teus llibres preferits.</p>
                </div>
                <div class="col-md-4 text-md-end mt-3 mt-md-0">
                    @auth
                        <a href="{{ route('index.guests') }}" class="btn btn-primary btn-lg">
                            <i class="bi bi-book me-2"></i>Explora ara
                        </a>
                    @else
                        <a href="{{ route('register') }}" class="btn btn-primary btn-lg">
                            <i class="bi bi-person-plus me-2"></i>Uneix-te ara
                        </a>
                    @endauth
                </div>
            </div>
        </div>
    </div>
</div>
@endsection