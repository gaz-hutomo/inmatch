<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>{{ config('app.name', 'InMatch') }}</title>
        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=inter:400,500,600,700,800&display=swap" rel="stylesheet" />
        <!-- Scripts -->
        @vite(['resources/css/app.css', 'resources/js/app.js'])
        <style>
            .glass {
                background: rgba(255, 255, 255, 0.1);
                backdrop-filter: blur(16px);
                -webkit-backdrop-filter: blur(16px);
                border: 1px solid rgba(255, 255, 255, 0.2);
            }
            .hero-bg {
                background: linear-gradient(135deg, #1e3a8a 0%, #4c1d95 50%, #9d174d 100%);
                background-size: 200% 200%;
                animation: gradient 15s ease infinite;
            }
            @keyframes gradient {
                0% { background-position: 0% 50%; }
                50% { background-position: 100% 50%; }
                100% { background-position: 0% 50%; }
            }
        </style>
    </head>
    <body class="antialiased hero-bg min-h-screen text-white font-sans selection:bg-pink-500 selection:text-white">
        <div class="relative min-h-screen flex flex-col">
            <!-- Navigation -->
            <nav class="glass px-6 py-4 flex justify-between items-center sticky top-0 z-50">
                <div class="text-2xl font-bold tracking-tighter flex items-center gap-2">
                    <span class="text-pink-400">In</span>Match
                </div>
                <div class="flex gap-4 items-center">
                    @auth
                        <a href="{{ url('/dashboard') }}" class="font-semibold hover:text-pink-300 transition-colors">Dashboard</a>
                        <form method="POST" action="{{ route('logout') }}" class="inline m-0 p-0">
                            @csrf
                            <button type="submit" class="font-semibold hover:text-pink-300 transition-colors bg-transparent border-none cursor-pointer text-white">
                                Log Out
                            </button>
                        </form>
                    @endauth
                </div>
            </nav>

            <!-- Hero Section -->
            <main class="flex-grow flex items-center justify-center px-6 py-20 relative overflow-hidden">
                <!-- Decorative blurred circles -->
                <div class="absolute top-1/4 left-1/4 w-96 h-96 bg-blue-500 rounded-full mix-blend-multiply filter blur-3xl opacity-50 animate-blob"></div>
                <div class="absolute top-1/3 right-1/4 w-96 h-96 bg-pink-500 rounded-full mix-blend-multiply filter blur-3xl opacity-50 animate-blob animation-delay-2000"></div>
                <div class="absolute -bottom-32 left-1/2 w-96 h-96 bg-purple-500 rounded-full mix-blend-multiply filter blur-3xl opacity-50 animate-blob animation-delay-4000"></div>

                <div class="relative z-10 max-w-5xl mx-auto text-center">
                    <h1 class="text-5xl md:text-7xl font-extrabold tracking-tight mb-8 leading-tight drop-shadow-md">
                        Temukan <span class="text-transparent bg-clip-text bg-gradient-to-r from-pink-400 to-orange-400">Penyedia Jasa Digital</span> Terbaik untuk Anda
                    </h1>
                    <p class="text-lg md:text-2xl text-gray-200 mb-12 max-w-3xl mx-auto font-light drop-shadow-sm">
                        Platform cerdas berbasis<span class="font-semibold text-white"> Algoritma</span> yang mencocokkan Client dan Creator (Video Editor, Foto Editor, Graphic Designer) berdasarkan Keahlian, Budget, dan Lokasi.
                    </p>
                    <div class="flex flex-col sm:flex-row gap-6 justify-center mb-6">
                        <a href="{{ route('register') }}" class="px-8 py-4 bg-gradient-to-r from-pink-500 to-purple-600 rounded-full font-bold text-lg shadow-lg shadow-pink-500/30 hover:scale-105 transition-transform border border-pink-400/50">
                            Mulai sebagai Client
                        </a>
                        <a href="{{ route('register') }}" class="px-8 py-4 glass rounded-full font-bold text-lg hover:bg-white/20 transition-all">
                            Gabung sebagai Creator
                        </a>
                    </div>
                    <div class="text-center">
                        <a href="{{ route('login') }}" class="text-pink-300 hover:text-white underline font-medium">
                            Sudah punya akun? Login di sini
                        </a>
                    </div>
                </div>
            </main>

            <!-- Features Section -->
            <section class="py-20 px-6 glass mt-auto relative z-10 border-b-0 border-x-0">
                <div class="max-w-6xl mx-auto grid grid-cols-1 md:grid-cols-3 gap-8">
                    <div class="p-8 rounded-2xl bg-white/5 border border-white/10 hover:bg-white/10 transition-colors shadow-xl">
                        <div class="text-4xl mb-4">🎯</div>
                        <h3 class="text-2xl font-bold mb-3">Pencocokan Cerdas</h3>
                        <p class="text-gray-300">Sistem algoritma kami memastikan Anda menemukan kreator (Video Editor, Foto Editor, Graphic Designer) yang paling relevan dengan budget proyek Anda.</p>
                    </div>
                    <div class="p-8 rounded-2xl bg-white/5 border border-white/10 hover:bg-white/10 transition-colors shadow-xl">
                        <div class="text-4xl mb-4">💼</div>
                        <h3 class="text-2xl font-bold mb-3">Tawaran Proyek Mudah</h3>
                        <p class="text-gray-300">Tawarkan pekerjaan proyek digital, negosiasi harga, kirim lampiran file/media, dan pantau status proyek secara real-time dalam satu dashboard.</p>
                    </div>
                    <div class="p-8 rounded-2xl bg-white/5 border border-white/10 hover:bg-white/10 transition-colors shadow-xl">
                        <div class="text-4xl mb-4">⭐</div>
                        <h3 class="text-2xl font-bold mb-3">Sistem Rating Valid</h3>
                        <p class="text-gray-300">Ulasan transparan dua arah antara Client dan Creator membangun ekosistem kerja sama kreatif yang dapat dipercaya dan aman.</p>
                    </div>
                </div>
            </section>
        </div>
    </body>
</html>
