<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name', 'InMatch') }}</title>

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=inter:400,500,600,700&display=swap" rel="stylesheet" />

        <!-- Scripts -->
        @vite(['resources/css/app.css', 'resources/js/app.js'])
        
        <style>
            .glassmorphism {
                background: rgba(255, 255, 255, 0.2);
                backdrop-filter: blur(12px);
                -webkit-backdrop-filter: blur(12px);
                border: 1px solid rgba(255, 255, 255, 0.3);
            }
            .floating-bg {
                position: fixed;
                top: 0; left: 0; width: 100%; height: 100%;
                z-index: -1;
                overflow: hidden;
                background: linear-gradient(135deg, #1e3a8a 0%, #4c1d95 100%);
            }
            .floating-item {
                position: absolute;
                display: block;
                animation: floatUp 25s linear infinite;
                bottom: -150px;
                display: flex;
                justify-content: center;
                align-items: center;
                font-size: 3rem; /* Memperbesar sedikit ukuran emoji/teks agar lebih jelas */
            }
            .glass-bg {
                background: rgba(255, 255, 255, 0.1);
                box-shadow: 0 8px 32px 0 rgba(31, 38, 135, 0.37);
                backdrop-filter: blur(4px);
                -webkit-backdrop-filter: blur(4px);
                border: 1px solid rgba(255, 255, 255, 0.18);
            }
            .shape-cube {
                clip-path: polygon(50% 0%, 100% 25%, 100% 75%, 50% 100%, 0% 75%, 0% 25%);
                border-radius: 0 !important;
            }
            .shape-cylinder {
                border-radius: 50% / 15% !important;
            }
            .shape-pyramid {
                clip-path: polygon(50% 0%, 0% 100%, 100% 100%);
                border-radius: 0 !important;
            }
            .shape-rhombus {
                clip-path: polygon(50% 0%, 100% 50%, 50% 100%, 0% 50%);
                border-radius: 0 !important;
            }
            .shape-sphere { border-radius: 50% !important; }
            .shape-capsule { border-radius: 9999px !important; }
            .shape-star { clip-path: polygon(50% 0%, 61% 35%, 98% 35%, 68% 57%, 79% 91%, 50% 70%, 21% 91%, 32% 57%, 2% 35%, 39% 35%); border-radius: 0 !important; }
            .shape-hexagon { clip-path: polygon(25% 0%, 75% 0%, 100% 50%, 75% 100%, 25% 100%, 0% 50%); border-radius: 0 !important; }
            .bg-shape-cube {
                clip-path: polygon(50% 0%, 100% 25%, 100% 75%, 50% 100%, 0% 75%, 0% 25%);
                background: linear-gradient(135deg, rgba(255,255,255,0.4) 0%, rgba(255,255,255,0.05) 100%);
                backdrop-filter: blur(10px);
            }
            .bg-shape-cylinder {
                border-radius: 50% / 15%;
                background: linear-gradient(90deg, rgba(255,255,255,0.4) 0%, rgba(255,255,255,0.05) 100%);
                backdrop-filter: blur(10px);
            }
            .bg-shape-pyramid {
                clip-path: polygon(50% 0%, 0% 100%, 100% 100%);
                background: linear-gradient(180deg, rgba(255,255,255,0.4) 0%, rgba(255,255,255,0.05) 100%);
                backdrop-filter: blur(10px);
            }
            .bg-shape-rhombus {
                clip-path: polygon(50% 0%, 100% 50%, 50% 100%, 0% 50%);
                background: linear-gradient(135deg, rgba(255,255,255,0.4) 0%, rgba(255,255,255,0.05) 100%);
                backdrop-filter: blur(10px);
            }
            .bg-shape-sphere {
                border-radius: 50%;
                background: radial-gradient(circle at 30% 30%, rgba(255,255,255,0.8), rgba(255,255,255,0.1));
                backdrop-filter: blur(10px);
            }
            .bg-shape-capsule {
                border-radius: 9999px;
                background: linear-gradient(135deg, rgba(255,255,255,0.4) 0%, rgba(255,255,255,0.05) 100%);
                backdrop-filter: blur(10px);
            }
            .bg-shape-star {
                clip-path: polygon(50% 0%, 61% 35%, 98% 35%, 68% 57%, 79% 91%, 50% 70%, 21% 91%, 32% 57%, 2% 35%, 39% 35%);
                background: linear-gradient(135deg, rgba(255,255,255,0.4) 0%, rgba(255,255,255,0.05) 100%);
                backdrop-filter: blur(10px);
            }
            .bg-shape-hexagon {
                clip-path: polygon(25% 0%, 75% 0%, 100% 50%, 75% 100%, 25% 100%, 0% 50%);
                background: linear-gradient(135deg, rgba(255,255,255,0.4) 0%, rgba(255,255,255,0.05) 100%);
                backdrop-filter: blur(10px);
            }
            @keyframes floatUp {
                0% {
                    transform: translateY(0) rotate(0deg);
                    opacity: 1;
                }
                100% {
                    transform: translateY(-1000px) rotate(720deg);
                    opacity: 0;
                }
            }
        </style>
    </head>
    <body class="font-sans text-gray-900 antialiased">
        <div class="floating-bg">
            @php
                $bgCount = isset($dynamicBackgrounds) ? $dynamicBackgrounds->count() : 0;
                $totalElements = isset($bgSettings['bg_element_count']) ? (int)$bgSettings['bg_element_count'] : 15;
                $speed = $bgSettings['bg_animation_speed'] ?? 'medium';
                $shape = $bgSettings['bg_element_shape'] ?? 'circle';
                $shapeClass = 'rounded-full';
                if ($shape == 'square') $shapeClass = 'rounded-2xl';
                elseif ($shape == 'cube') $shapeClass = 'shape-cube';
                elseif ($shape == 'cylinder') $shapeClass = 'shape-cylinder';
                elseif ($shape == 'pyramid') $shapeClass = 'shape-pyramid';
                elseif ($shape == 'rhombus') $shapeClass = 'shape-rhombus';
                elseif ($shape == 'sphere') $shapeClass = 'shape-sphere';
                elseif ($shape == 'capsule') $shapeClass = 'shape-capsule';
                elseif ($shape == 'star') $shapeClass = 'shape-star';
                elseif ($shape == 'hexagon') $shapeClass = 'shape-hexagon';
                
                $minSpeed = 15; $maxSpeed = 35;
                if ($speed == 'fast') { $minSpeed = 8; $maxSpeed = 18; }
                elseif ($speed == 'slow') { $minSpeed = 30; $maxSpeed = 60; }
            @endphp

            @if($bgCount > 0)
                @for($i = 0; $i < $totalElements; $i++)
                    @php
                        $bg = $dynamicBackgrounds[$i % $bgCount];
                        $bgClass = '';
                        if ($bg->type == 'image') {
                            $bgClass = 'glass-bg ' . $shapeClass;
                        } elseif ($bg->type == 'shape') {
                            $bgClass = 'bg-shape-' . $bg->content;
                        }
                    @endphp
                    <div class="floating-item {{ $bgClass }}" style="
                        left: {{ rand(5, 95) }}%;
                        width: {{ rand(40, 100) }}px;
                        height: {{ rand(40, 100) }}px;
                        animation-delay: {{ rand(0, 15) }}s;
                        animation-duration: {{ rand($minSpeed, $maxSpeed) }}s;
                        {{ $bg->type == 'emoji' ? 'font-size: ' . rand(2, 4) . 'rem;' : '' }}
                    ">
                        @if($bg->type == 'emoji')
                            {{ $bg->content }}
                        @elseif($bg->type == 'image')
                            <img src="{{ $bg->content_url }}" alt="bg" class="w-full h-full object-cover {{ $shapeClass }} opacity-50">
                        @endif
                    </div>
                @endfor
            @else
                <!-- Default floating squares if no dynamic bg -->
                @for($i = 0; $i < $totalElements; $i++)
                    <div class="floating-item" style="left: {{ rand(5, 95) }}%; width: {{ rand(40, 100) }}px; height: {{ rand(40, 100) }}px; animation-delay: {{ rand(0, 15) }}s; animation-duration: {{ rand($minSpeed, $maxSpeed) }}s;"></div>
                @endfor
            @endif
        </div>

        <div class="min-h-screen flex flex-col sm:justify-center items-center pt-6 sm:pt-0">
            <div>
                <a href="/">
                    <x-application-logo class="w-20 h-20 fill-current text-white drop-shadow-lg" />
                </a>
            </div>

            <div class="w-full sm:max-w-md mt-6 px-6 py-8 glassmorphism shadow-2xl overflow-hidden sm:rounded-2xl">
                {{ $slot }}
            </div>
        </div>
    </body>
</html>
