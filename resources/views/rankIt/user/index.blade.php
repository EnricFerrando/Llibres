{{-- filepath: c:\xampp\htdocs\DWES\Laravel\puntuacioLlibre\rankIt\resources\views\rankIt\index.blade.php --}}
@extends('layouts.master')

@section('title', "Llibres recomanats per a tu")

@section('content')
<div class="container mt-5">
    <h1 class="text-center mb-4">Llibres recomanats per a tu</h1>

    <!-- Filtre per categoria -->
    <form method="GET" class="mb-4">
        <div class="row">
            <div class="col-md-4">
                <select name="categorie_id" class="form-select" onchange="this.form.submit()">
                    <option value="">Totes les categories</option>
                    @foreach($categories as $category)
                        <option value="{{ $category->id }}" {{ (isset($categoryId) && $categoryId == $category->id) ? 'selected' : '' }}>
                            {{ $category->name }}
                        </option>
                    @endforeach
                </select>
            </div>
        </div>
    </form>

    <div class="row">
        @php
            $userAge = \Carbon\Carbon::parse(Auth::user()->birth_date)->age;
        @endphp
        @forelse($books as $book)
            @if($book->recomended_age <= $userAge)
                <div class="col-md-4 mb-4">
                    <div class="card h-100 shadow bg-dark text-white">
                        @if($book->image)
                            <img src="{{ asset('storage/'.$book->image) }}" class="card-img-top" alt="Portada de {{ $book->title }}" style="height: 300px; object-fit: cover;">
                        @else
                            <img src="https://via.placeholder.com/300x400?text=Sense+imatge" class="card-img-top" alt="Sense imatge" style="height: 300px; object-fit: cover;">
                        @endif
                        <div class="card-body d-flex flex-column">
                            <h5 class="card-title">{{ $book->title }}</h5>
                            <div class="mb-2">
                                @php
                                    $avg = $book->users()->avg('rating');
                                @endphp
                                <span class="text-warning">
                                    @if($avg)
                                        @for($i = 1; $i <= 5; $i++)
                                            @if($i <= round($avg))
                                                ★
                                            @else
                                                ☆
                                            @endif
                                        @endfor
                                        <small>({{ number_format($avg, 1) }})</small>
                                    @else
                                        <span class="text-secondary">Sense valoracions</span>
                                    @endif
                                </span>
                            </div>
                            <a href="{{ route('books.show', $book->id) }}" class="btn btn-primary mt-auto">Veure detall</a>
                        </div>
                    </div>
                </div>
            @endif
        @empty
            <div class="col-12">
                <div class="alert alert-info text-center">No hi ha llibres per mostrar.</div>
            </div>
        @endforelse
    </div>
    <div class="d-flex justify-content-center mt-4">
        {{ $books->appends(request()->query())->links('pagination::bootstrap-5') }}
    </div>
</div>
@endsection