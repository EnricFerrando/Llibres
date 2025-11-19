@extends('layouts.app')

@section('title', optional($book)->title ?? '-')

@section('content')
<div class="grid md:grid-cols-3 gap-8">
    <div class="md:col-span-1">
        <div class="card">
            @if(optional($book)->image)
                <img 
                    src="{{ asset('storage/'.optional($book)->image) }}" 
                    alt="Portada de {{ optional($book)->title ?? '' }}" 
                    class="w-full h-auto rounded-xl shadow-lg hover:shadow-xl transition-shadow duration-300"
                    loading="lazy"
                >
            @else
                <div class="w-full aspect-[3/4] rounded-xl bg-gradient-to-br from-gray-100 to-gray-200 flex items-center justify-center text-gray-400">
                    <svg class="w-16 h-16 opacity-50" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z" />
                    </svg>
                </div>
            @endif

            <div class="mt-4">
                    <h3 class="text-lg font-semibold">{{ optional($book)->title ?? '-' }}</h3>
                <p class="text-sm muted">{{ $book->author }}</p>
            </div>
        </div>
    </div>

    <div class="md:col-span-2">
        <div class="card">
            <div class="flex items-start justify-between">
                <div>
                    <h1 class="text-2xl font-bold mb-1">{{ optional($book)->title ?? '-' }}</h1>
                        <p class="text-sm muted">Categoria: {{ optional($book->category)->name ?? '-' }} · Edat mínima: {{ optional($book)->recomended_age ?? '-' }}</p>
                </div>
                <div class="text-right">
                    @php $avg = $book->users()->avg('rating'); @endphp
                    @if($avg)
                        <div class="text-primary-600 font-semibold">{{ number_format($avg,1) }} / 5</div>
                        <div class="text-yellow-400">@for($i=1;$i<=5;$i++){{ $i <= round($avg) ? '★' : '☆' }}@endfor</div>
                    @else
                        <div class="muted">Sense valoracions</div>
                    @endif
                </div>
            </div>

            <div class="mt-6 text-gray-700">
                {!! nl2br(e($book->description)) !!}
            </div>

            @php $reviews = $book->users()->wherePivotNotNull('review')->get(); @endphp
            @if($reviews->count())
                <div class="mt-6">
                    <h4 class="font-semibold">Comentaris dels lectors</h4>
                    <ul class="mt-3 space-y-3">
                        @foreach($reviews as $user)
                            @if($user->pivot->review)
                                <li class="p-3 border rounded-lg">
                                    <div class="flex items-center justify-between">
                                        <div class="font-medium">{{ optional($user)->name ?? '-' }}</div>
                                        <div class="text-yellow-400">{{ $user->pivot->rating }}★</div>
                                    </div>
                                    <div class="mt-2 text-sm text-gray-700">{{ $user->pivot->review }}</div>
                                </li>
                            @endif
                        @endforeach
                    </ul>
                </div>
            @endif

            <div class="mt-6 flex gap-3">
                <a href="{{ route('books.rate', $book->id) }}" class="btn-primary">Valora aquest llibre</a>
                <a href="{{ route('books.index') }}" class="btn-ghost">Torna</a>
            </div>
        </div>
    </div>
</div>

@endsection
