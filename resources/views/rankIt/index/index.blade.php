{{-- filepath: c:\xampp\htdocs\DWES\Laravel\puntuacioLlibre\rankIt\resources\views\index.blade.php --}}
@extends('layouts.master')

@section('title', "Panell d'Administració")

@section('content')
<div class="container mt-5">
    <h1 class="text-center mb-4">Panell d'Administració</h1>
    <p class="text-center text-muted">Benvingut al panell d'administració. Selecciona una de les opcions següents per gestionar les dades:</p>

    <div class="row text-center">
        <!-- Llibres -->
        <div class="col-md-4 mb-4">
            <div class="card bg-dark text-white shadow">
                <div class="card-body">
                    <h3 class="card-title">Llibres</h3>
                    <p class="card-text">Gestiona els llibres disponibles a la plataforma.</p>
                    <a href="{{ route('books.index') }}" class="btn btn-primary">Gestiona Llibres</a>
                </div>
            </div>
        </div>

        <!-- Usuaris -->
        <div class="col-md-4 mb-4">
            <div class="card bg-dark text-white shadow">
                <div class="card-body">
                    <h3 class="card-title">Usuaris</h3>
                    <p class="card-text">Gestiona els usuaris registrats a la plataforma.</p>
                    <a href="{{ route('users.index') }}" class="btn btn-primary">Gestiona Usuaris</a>
                </div>
            </div>
        </div>

        <!-- Categories -->
        <div class="col-md-4 mb-4">
            <div class="card bg-dark text-white shadow">
                <div class="card-body">
                    <h3 class="card-title">Categories</h3>
                    <p class="card-text">Gestiona les categories disponibles a la plataforma.</p>
                    <a href="{{ route('categories.index') }}" class="btn btn-primary">Gestiona Categories</a>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection