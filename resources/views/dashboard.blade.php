@extends('layouts.app')

@section('title', 'Dashboard')

@section('content')
    <div class="max-w-4xl mx-auto">
        <div class="card">
            <h1 class="text-2xl font-bold mb-6">Dashboard</h1>

            <div class="grid gap-6 md:grid-cols-2">
                <div class="p-6 bg-primary-50 rounded-xl">
                    <h3 class="font-semibold text-primary-700 mb-2">Els meus llibres valorats</h3>
                    <p class="text-sm text-primary-600">Accedeix a tots els llibres que has valorat i les teves ressenyes.</p>
                    <a href="{{ route('books.index') }}" class="mt-4 inline-flex items-center text-sm text-primary-600 hover:text-primary-700">
                        Veure llibres 
                        <svg class="w-4 h-4 ml-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/>
                        </svg>
                    </a>
                </div>

                <div class="p-6 bg-gray-50 rounded-xl">
                    <h3 class="font-semibold text-gray-700 mb-2">Perfil</h3>
                    <p class="text-sm text-gray-600">Gestiona el teu perfil i preferències.</p>
                    <a href="{{ route('profile.edit') }}" class="mt-4 inline-flex items-center text-sm text-gray-600 hover:text-gray-700">
                        Editar perfil
                        <svg class="w-4 h-4 ml-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/>
                        </svg>
                    </a>
                </div>
            </div>

            @if(session('status'))
                <div class="mt-6 p-4 bg-green-50 rounded-lg">
                    <p class="text-sm text-green-700">{{ session('status') }}</p>
                </div>
            @endif
        </div>
    </div>
@endsection
