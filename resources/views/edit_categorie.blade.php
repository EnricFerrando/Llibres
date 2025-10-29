{{-- filepath: resources/views/rankIt/index/edit_category.blade.php --}}
@extends('layouts.master')

@section('title', 'Editar categoria')

@section('content')
<div class="container mt-5">
    <h2>Editar categoria</h2>
    <form action="{{ route('categories.update', $category->id) }}" method="POST">
        @csrf
        @method('PUT')
        <div class="mb-3">
            <label for="name" class="form-label">Nom</label>
            <input type="text" class="form-control" id="name" name="name" value="{{ old('name', $category->name) }}" required>
        </div>
        <button type="submit" class="btn btn-primary">Desar canvis</button>
        <a href="{{ route('categories.index') }}" class="btn btn-secondary">Cancel·la</a>
    </form>
</div>
@endsection
