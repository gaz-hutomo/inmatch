<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name', 'InMatch') }}</title>

        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=inter:400,500,600,700&display=swap" rel="stylesheet" />

        @vite(['resources/css/app.css', 'resources/js/app.js'])
    </head>
    <body class="font-sans antialiased bg-gray-50 text-gray-900 flex h-screen overflow-hidden">
        @php
            $rawRole = Auth::user()->roles->first()->name ?? 'client';
            $role = in_array($rawRole, ['creator', 'influencer']) ? 'creator' : 'client';
            $roleLabel = ($role === 'creator') ? 'Penyedia Jasa' : 'Client';
        @endphp
        <!-- Sidebar -->
        <aside class="w-72 bg-white border-r border-gray-200 flex flex-col shadow-sm flex-shrink-0 relative z-10">
            <!-- Logo -->
            <div class="h-20 flex items-center px-8 border-b border-gray-100">
                <a href="{{ route($role.'.dashboard') }}" class="text-2xl font-extrabold tracking-tight text-gray-900 flex items-center gap-2">
                    <span class="text-pink-500">In</span>Match <span class="text-xs font-semibold bg-pink-100 text-pink-700 px-2.5 py-1 rounded-full ml-1">{{ $roleLabel }}</span>
                </a>
            </div>
            
            <!-- Nav Links -->
            <nav class="flex-1 py-6 px-4 space-y-2 overflow-y-auto">
                <a href="{{ route($role.'.dashboard') }}" class="flex items-center gap-3 px-4 py-3 rounded-xl {{ request()->routeIs($role.'.dashboard') ? 'bg-pink-50 text-pink-700 font-bold' : 'text-gray-600 hover:bg-gray-50 font-semibold' }} transition-colors">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"></path></svg>
                    Dashboard Utama
                </a>
                <a href="{{ route($role.'.profile') }}" class="flex items-center gap-3 px-4 py-3 rounded-xl {{ request()->routeIs($role.'.profile') ? 'bg-pink-50 text-pink-700 font-bold' : 'text-gray-600 hover:bg-gray-50 font-semibold' }} transition-colors">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path></svg>
                    Profil Saya
                </a>
                <a href="{{ route($role.'.collaborations') }}" class="flex items-center gap-3 px-4 py-3 rounded-xl {{ request()->routeIs($role.'.collaborations') ? 'bg-pink-50 text-pink-700 font-bold' : 'text-gray-600 hover:bg-gray-50 font-semibold' }} transition-colors">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 13.255A23.931 23.931 0 0112 15c-3.183 0-6.22-.62-9-1.745M16 6V4a2 2 0 00-2-2h-4a2 2 0 00-2 2v2m4 6h.01M5 20h14a2 2 0 002-2V8a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"></path></svg>
                    Tawaran Proyek
                </a>
            </nav>

            <!-- User Info & Logout -->
            <div class="p-6 border-t border-gray-100 bg-gray-50/50">
                <div class="flex items-center gap-3 mb-5">
                    @if(Auth::user()->profile && Auth::user()->profile->avatar)
                        <img src="{{ Auth::user()->profile->avatar_url }}" class="w-10 h-10 rounded-full object-cover shadow-sm border border-gray-200">
                    @else
                        <div class="w-10 h-10 rounded-full bg-gradient-to-tr from-pink-500 to-orange-400 flex items-center justify-center text-white font-bold shadow-sm">
                            {{ strtoupper(substr(Auth::user()->name, 0, 1)) }}
                        </div>
                    @endif
                    <div class="overflow-hidden">
                        <p class="text-sm font-bold text-gray-900 truncate">{{ Auth::user()->name }}</p>
                        <p class="text-xs text-gray-500 truncate">{{ Auth::user()->email }}</p>
                    </div>
                </div>
                <form method="POST" action="{{ route('logout') }}" class="m-0">
                    @csrf
                    <button type="submit" class="w-full flex items-center justify-center gap-2 text-sm text-red-600 hover:text-red-700 font-bold bg-white hover:bg-red-50 border border-red-200 px-4 py-2.5 rounded-xl transition-all shadow-sm">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1"></path></svg>
                        Keluar
                    </button>
                </form>
            </div>
        </aside>

        <!-- Main Content Wrapper -->
        <div class="flex-1 flex flex-col relative overflow-hidden">
            <!-- Header -->
            @isset($header)
                <header class="bg-white/80 backdrop-blur-md border-b border-gray-200 sticky top-0 z-10">
                    <div class="px-8 py-6">
                        {{ $header }}
                    </div>
                </header>
            @endisset

            <!-- Content -->
            <main class="flex-1 overflow-y-auto">
                {{ $slot }}
            </main>
        </div>
    </body>
</html>
