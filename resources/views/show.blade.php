@extends('layouts.master')

@section('title', $book->title)

@section('content')
<div class="container mt-5">
    <div class="row">
        <div class="col-md-4">
            <div class="card h-100 shadow">
                @if($book->image)
                    <img 
                        src="{{ asset('storage/'.$book->image) }}" 
                        class="card-img-top"
                        alt="Portada de {{ $book->title }}" 
                        style="height: 400px; object-fit: cover;"
                    >
                @else
                    <img 
                        src="{{ asset('images/no-cover.jpg') }}" 
                        class="card-img-top" 
                        alt="Sense imatge"
                        style="height: 400px; object-fit: cover;"
                    >
                @endif
                <div class="card-body">
                    <div class="mb-3">
                        <h6 class="mb-2">Autor</h6>
                        <p class="text-muted">{{ $book->author }}</p>
                    </div>
                    <div class="mb-3">
                        <h6 class="mb-2">Preu</h6>
                        <p class="text-muted">{{ number_format($book->price, 2) }}€</p>
                    </div>
                    <div class="mb-3">
                        <h6 class="mb-2">Data de publicació</h6>
                        <p class="text-muted">{{ $book->published_at ? \Carbon\Carbon::parse($book->published_at)->format('d/m/Y') : '-' }}</p>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-md-8">
            <div class="card shadow">
                <div class="card-body">
                    <div class="d-flex justify-content-between align-items-center border-bottom pb-4 mb-4">
                        <div>
                            <h1 class="h2 mb-2">{{ $book->title }}</h1>
                            <div class="text-muted">
                                <div class="mb-1">
                                    <i class="bi bi-tag"></i>
                                    {{ $book->category->name ?? 'Sense categoria' }}
                                </div>
                                <div>
                                    <i class="bi bi-person"></i>
                                    Edat recomanada: {{ $book->recomended_age ?? '-' }}+
                                </div>
                            </div>
                        </div>
                        <div class="text-end">
                            @php $avg = $book->users()->avg('rating'); @endphp
                            @if($avg)
                                <div class="h3 text-primary">{{ number_format($avg,1) }}</div>
                                <div class="text-warning fs-4">
                                    @for($i=1;$i<=5;$i++)
                                        {{ $i <= round($avg) ? '★' : '☆' }}
                                    @endfor
                                </div>
                                <div class="text-muted small mt-1">
                                    {{ $book->users()->count() }} valoracions
                                </div>
                            @else
                                <div class="text-muted">Sense valoracions</div>
                            @endif
                        </div>
                    </div>

                    <div class="mb-5">
                        {!! nl2br(e($book->sumary)) !!}
                    </div>

                    @php $reviews = $book->users()->wherePivotNotNull('review')->get(); @endphp
                    @if($reviews->count())
                        <div class="border-top pt-4">
                            <h4 class="mb-4">
                                Comentaris dels lectors
                                <span class="text-muted ms-2">({{ $reviews->count() }})</span>
                            </h4>
                            <div class="list-group list-group-flush">
                                @foreach($reviews as $user)
                                    @if($user->pivot->review)
                                        <div class="list-group-item bg-light rounded mb-3">
                                            <div class="d-flex justify-content-between align-items-center mb-2">
                                                <div class="d-flex align-items-center">
                                                    <div class="bg-primary rounded-circle d-flex align-items-center justify-content-center text-white" style="width: 40px; height: 40px;">
                                                        <span class="font-weight-bold">
                                                            {{ strtoupper(substr($user->name, 0, 1)) }}
                                                        </span>
                                                    </div>
                                                    <div class="ms-3">
                                                        <span class="fw-semibold text-dark">{{ $user->name }}</span>
                                                        <span class="text-muted ms-2 small">
                                                            {{ $user->pivot->created_at ? $user->pivot->created_at->diffForHumans() : '' }}
                                                        </span>
                                                    </div>
                                                </div>
                                                <div class="d-flex align-items-center">
                                                    <div class="text-warning me-1">{{ str_repeat('★', $user->pivot->rating) }}</div>
                                                    <div class="text-muted">{{ str_repeat('☆', 5 - $user->pivot->rating) }}</div>
                                                </div>
                                            </div>
                                            <p class="text-muted mb-0">{{ $user->pivot->review }}</p>
                                        </div>
                                    @endif
                                @endforeach
                            </div>
                        </div>
                    @endif

                    <div class="mt-4">
                        <a href="{{ route('books.rate', $book->id) }}" 
                           class="btn btn-primary me-2">
                            <i class="bi bi-star me-2"></i>
                            Valora aquest llibre
                        </a>
                                <a href="{{ url()->previous() }}" 
                                    class="btn btn-outline-secondary">
                            <i class="bi bi-arrow-left me-2"></i>
                            Torna
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
