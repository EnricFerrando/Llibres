@extends('layouts.master')

@section('title', 'Valora el llibre')

@section('content')
<div class="container mt-5">
    <h2>Valora: {{ optional($book)->title ?? '-' }}</h2>
    <form method="POST" action="{{ route('books.storeRate', $book->id) }}">
        @csrf
        <div class="mb-3">
            <label for="rating" class="form-label">Puntuació (1-5)</label>
            <input type="number" min="1" max="5" class="form-control" id="rating" name="rating" required>
        </div>
        <div class="mb-3">
            <label for="review" class="form-label">Comentari (opcional)</label>
            <textarea class="form-control" id="review" name="review" rows="3"></textarea>
        </div>
        <button type="submit" class="btn btn-primary">Envia valoració</button>
        <a href="{{ route('books.show', $book->id) }}" class="btn btn-secondary">Cancel·la</a>
    </form>
</div>
@endsection
