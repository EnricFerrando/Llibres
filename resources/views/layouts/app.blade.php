<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="h-full">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'RankIt') }} - @yield('title', '')</title>

    {{-- Vite assets --}}
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="antialiased bg-[var(--bg)] h-full flex flex-col" x-data="layout">
    <header class="bg-white/60 glass border-b sticky top-0 z-50">
        <div class="container flex items-center justify-between py-4">
            <a href="{{ url('/') }}" class="flex items-center gap-3">
                <div class="w-10 h-10 bg-primary-500 rounded-lg flex items-center justify-center text-white font-bold">R</div>
                <div class="leading-tight">
                    <div class="font-semibold">{{ config('app.name', 'RankIt') }}</div>
                    <div class="text-xs muted">Llibres i valoracions</div>
                </div>
            </a>

            <nav class="hidden md:flex items-center gap-4">
                <a href="{{ route('books.index') }}" class="text-sm text-muted hover:text-primary-600">Llibres</a>
                <a href="{{ route('categories.index') }}" class="text-sm text-muted hover:text-primary-600">Categories</a>
                @auth
                    <a href="{{ route('dashboard') }}" class="text-sm btn-ghost">Dashboard</a>
                @else
                    <a href="{{ route('login') }}" class="text-sm btn-ghost">Inicia sessió</a>
                @endauth
            </nav>

            <div class="md:hidden">
                <button @click="open = !open" class="p-2 rounded-md hover:bg-gray-100">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"/></svg>
                </button>
            </div>
        </div>

        <!-- Mobile menu -->
        <div class="md:hidden" x-show="open" x-transition:enter="transition ease-out duration-200" x-transition:enter-start="opacity-0 -translate-y-1" x-transition:enter-end="opacity-100 translate-y-0">
            <nav class="container py-4 space-y-2 border-t">
                <a href="{{ route('books.index') }}" class="block py-2 text-sm text-muted hover:text-primary-600">Llibres</a>
                <a href="{{ route('categories.index') }}" class="block py-2 text-sm text-muted hover:text-primary-600">Categories</a>
                @auth
                    <a href="{{ route('dashboard') }}" class="block py-2 text-sm text-muted hover:text-primary-600">Dashboard</a>
                @else
                    <a href="{{ route('login') }}" class="block py-2 text-sm text-muted hover:text-primary-600">Inicia sessió</a>
                @endauth
            </nav>
        </div>
    </header>

    <main class="py-10 flex-1">
        <div class="container">
            @if(session('status'))
                <div class="mb-6 card">
                    <div class="text-sm text-primary-600">{{ session('status') }}</div>
                </div>
            @endif

            @yield('content')
        </div>
    </main>

    <footer class="border-t mt-auto">
        <div class="container py-6 text-sm muted">&copy; {{ date('Y') }} {{ config('app.name', 'RankIt') }} — fet amb ❤️</div>
    </footer>

    {{-- Alpine.js initialization --}}
    <script>
        document.addEventListener('alpine:init', () => {
            Alpine.data('layout', () => ({
                open: false
            }))
        })
    </script>
</body>
</html>
</html>
