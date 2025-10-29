{{-- filepath: c:\xampp\htdocs\DWES\Laravel\puntuacioLlibre\rankIt\resources\views\rankIt\index\edit_user.blade.php --}}
@extends('layouts.master')

@section('title', 'Editar usuari')

@section('content')
<div class="container mt-5">
    <h2 class="mb-4">Editar usuari</h2>
    <form action="{{ route('users.edit', $user->id) }}" method="POST">
        @csrf
        @method('PUT')
        <div class="mb-3">
            <label for="name" class="form-label">Nom</label>
            <input type="text" class="form-control" id="name" name="name" value="{{ old('name', $user->name) }}" required>
        </div>
        <div class="mb-3">
            <label for="email" class="form-label">Correu electrònic</label>
            <input type="email" class="form-control" id="email" name="email" value="{{ old('email', $user->email) }}" required>
        </div>

        <button type="submit" class="btn btn-primary">Desar canvis</button>
        <a href="{{ route('users.index') }}" class="btn btn-secondary">Cancel·la</a>
    </form>
</div>
@endsection
