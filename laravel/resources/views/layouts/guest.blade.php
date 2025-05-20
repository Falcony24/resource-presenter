<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Manrope:wght@400;500;600;700&display=swap" rel="stylesheet">

    <!-- Tailwind + JS -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="font-sans antialiased bg-[#efe7d8]" style="font-family: 'Manrope', sans-serif">
    <div class="min-h-screen flex flex-col items-center justify-center p-6">
        <div class="mb-12 group">
            <a href="/" class="
                block p-3 rounded-full
                bg-white/90 backdrop-blur-sm
                border border-[#5e5437]/10
                shadow-sm
                transition-all duration-300 ease-[cubic-bezier(0.34,1.56,0.64,1)]
                hover:shadow-md hover:border-[#80734e]/20 hover:scale-105
                active:scale-95 active:bg-white/80
                ">
                <div class="
                    transition-transform duration-500 ease-[cubic-bezier(0.34,1.56,0.64,1)]
                    group-hover:rotate-12 group-hover:scale-110
                    group-active:rotate-0 group-active:scale-100
                    ">
                    <x-application-logo class="w-12 h-12 text-[#5e5437] transition-colors duration-300 group-hover:text-[#80734e]" />
                </div>
            </a>
        </div>

        <div class="w-full max-w-md bg-white rounded-lg overflow-hidden shadow-sm hover:shadow-md transition-shadow duration-300">

            <div class="h-1.5 bg-gradient-to-r from-[#80734e] to-[#5e5437] group-hover:bg-gradient-to-l transition-all duration-500"></div>
            
            <div class="p-8 bg-white relative overflow-hidden">
                <div class="absolute inset-0 opacity-5 bg-[url('data:image/svg+xml;base64,PHN2ZyB3aWR0aD0iMTYiIGhlaWdodD0iMTYiIHZpZXdCb3g9IjAgMCAxNiAxNiIgeG1sbnM9Imh0dHA6Ly93d3cudzMub3JnLzIwMDAvc3ZnIiBmaWxsPSIjNWU1NDM3Ij48Y2lyY2xlIGN4PSI4IiBjeT0iOCIgcj0iMSIvPjwvc3ZnPg==')] 
                    group-hover:opacity-10 transition-opacity duration-1000"></div>

                <div class="absolute -right-10 -top-10 w-40 h-40 rounded-full bg-[#80734e]/5 group-hover:bg-[#5e5437]/10 blur-xl transition-all duration-1000"></div>
                
                <div class="relative">
                    {{ $slot }}
                </div>
            </div>
        </div>

        <div class="mt-12">
            <a href="#" class="
                text-xs text-[#5e5437]/50 hover:text-[#5e5437]/70 tracking-wide
                transition-all duration-300
                relative
                after:content-[''] after:absolute after:bottom-0 after:left-0
                after:w-0 after:h-px after:bg-[#80734e]/30
                hover:after:w-full hover:after:transition-all hover:after:duration-300
                ">
                © {{ now()->year }} · All rights reserved
            </a>
        </div>
    </div>
</body>
</html>