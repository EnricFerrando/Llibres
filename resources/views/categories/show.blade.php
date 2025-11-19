@extends('layouts.master')

@section('title', optional($category)->name ?? '-')

@section('content')
<div class="container mt-5">
    <h1>{{ optional($category)->name ?? '-' }}</h1>
    <p>{{ optional($category)->description ?? '' }}</p>
    <a href="{{ route('categories.index') }}" class="btn btn-ghost">Torna</a>
</div>
@endsection
