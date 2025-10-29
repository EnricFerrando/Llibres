@extends('layouts.app')

@section('title', 'Editar llibre')

@section('content')
<div class="max-w-3xl mx-auto">
    <div class="card">
        <h2 class="text-xl font-semibold mb-4">Editar llibre</h2>

        <form action="{{ route('books.update', $book->id) }}" method="POST" enctype="multipart/form-data" class="space-y-4">
            @csrf
            @method('PUT')

            <div>
                <label for="title" class="block text-sm font-medium text-gray-700">Títol</label>
                <input type="text" id="title" name="title" required value="{{ old('title', $book->title) }}" class="form-input mt-1">
            </div>

            <div>
                <label for="author" class="block text-sm font-medium text-gray-700">Autor</label>
                <input type="text" id="author" name="author" required value="{{ old('author', $book->author) }}" class="form-input mt-1">
            </div>

            <div>
                <label for="sumary" class="block text-sm font-medium text-gray-700">Resum</label>
                <textarea id="sumary" name="sumary" rows="4" class="form-input mt-1">{{ old('sumary', $book->sumary) }}</textarea>
            </div>

            <div class="grid md:grid-cols-2 gap-4">
                <div>
                    <label for="published_at" class="block text-sm font-medium text-gray-700">Data de publicació</label>
                    <input type="date" id="published_at" name="published_at" value="{{ old('published_at', $book->published_at) }}" class="form-input mt-1">
                </div>
                <div>
                    <label for="price" class="block text-sm font-medium text-gray-700">Preu</label>
                    <input type="number" step="0.01" id="price" name="price" value="{{ old('price', $book->price) }}" class="form-input mt-1">
                </div>
            </div>

            <div class="grid md:grid-cols-2 gap-4">
                <div>
                    <label for="recomended_age" class="block text-sm font-medium text-gray-700">Edat recomanada</label>
                    <input type="number" id="recomended_age" name="recomended_age" value="{{ old('recomended_age', $book->recomended_age) }}" class="form-input mt-1">
                </div>

                <div>
                    <label for="image" class="block text-sm font-medium text-gray-700">Imatge de portada</label>
                    <input type="file" id="image" name="image" accept="image/*" class="form-input mt-1 image-input" data-preview-target="#coverPreview">
                    <p class="text-xs text-gray-500 mt-1">Format: JPG, PNG. Mida màxima: 2MB</p>

                    @if($book->image)
                        <img id="coverPreview" class="mt-4 w-48 h-auto rounded-xl shadow" src="{{ asset('storage/'.$book->image) }}" data-default-src="{{ asset('storage/'.$book->image) }}" alt="Previsualització de la portada">
                    @else
                        <img id="coverPreview" class="mt-4 w-48 h-auto rounded-xl shadow hidden" src="" alt="Previsualització de la portada">
                    @endif
                </div>
            </div>

            <div class="flex gap-3 pt-2">
                <button type="submit" class="btn-primary">Desar canvis</button>
                <a href="{{ route('books.index') }}" class="btn-ghost">Cancel·la</a>
            </div>
        </form>
    </div>
</div>

@endsection
