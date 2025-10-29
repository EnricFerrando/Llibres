{{-- filepath: c:\xampp\htdocs\DWES\Laravel\puntuacioLlibre\rankIt\resources\views\rankIt\index\create_category.blade.php --}}
@extends('layouts.master')

@section('title', 'Afegir categoria')

@section('content')
<div class="container mt-5">
    <h2 class="mb-4">Afegir nova categoria</h2>
    <form action="{{ route('categories.store') }}" method="POST">
        @csrf
        <div class="mb-3">
            <label for="name" class="form-label">Nom de la categoria</label>
            <input type="text" class="form-control" id="name" name="name" required value="{{ old('name') }}">
        </div>
        <button type="submit" class="btn btn-success">Desar categoria</button>
        <a href="{{ route('categories.index') }}" class="btn btn-secondary">Cancel·la</a>
    </form>
</div>
@endsection
