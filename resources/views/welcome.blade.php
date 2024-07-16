<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>DigiPlace</title>

    <!-- Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;600;700&display=swap" rel="stylesheet">
    @vite('resources/css/app.css')
    <link href='https://cdn.jsdelivr.net/npm/fullcalendar@5.11.0/main.min.css' rel='stylesheet'/>
</head>
<body class="font-sans antialiased dark:bg-gray-900 dark:text-white/50">
<div
    class="bg-gray-50 text-black/50 dark:bg-gray-900 dark:text-white/50 min-h-screen flex flex-col items-center justify-center relative">

    <div class="relative w-full max-w-2xl px-6 lg:max-w-7xl z-10">
        <header class="grid grid-cols-2 items-center gap-2 py-10 lg:grid-cols-3">
            <img src="{!! asset('digiplace.png') !!}" alt="Logo">
            <div class="flex lg:justify-center lg:col-start-2">
                <!-- Add any additional header content here -->
            </div>
            @if (Route::has('login'))
                <nav class="-mx-3 flex flex-1 justify-end">
                    @auth
                        <a href="{{ url('/dashboard') }}"
                           class="rounded-md px-3 py-2 text-black ring-1 ring-transparent transition hover:text-black/70 focus:outline-none focus-visible:ring-[#FF2D20] dark:text-white dark:hover:text-white/80 dark:focus-visible:ring-white">
                            Dashboard
                        </a>
                    @else
                        <a href="{{ route('login') }}"
                           class="rounded-md px-3 py-2 text-black ring-1 ring-transparent transition hover:text-black/70 focus:outline-none focus-visible:ring-[#FF2D20] dark:text-white dark:hover:text-white/80 dark:focus-visible:ring-white">
                            Log in
                        </a>
                        @if (Route::has('register'))
                            <a href="{{ route('register') }}"
                               class="ml-4 rounded-md px-3 py-2 text-black ring-1 ring-transparent transition hover:text-black/70 focus:outline-none focus-visible:ring-[#FF2D20] dark:text-white dark:hover:text-white/80 dark:focus-visible:ring-white">
                                Register
                            </a>
                        @endif
                    @endauth
                </nav>
            @endif
        </header>

        <main class="mt-10 w-full">
            <div id='calendar'></div>
        </main>
    </div>
</div>

@vite('resources/js/app.js')
@vite('resources/js/welcomeCalendar.js')
@vite('resources/js/fullcalendar.js')
@vite('resources/js/solicitar-reserva.js')
@include('dashboard.modal.visitor-reserve-modal')
<script src='https://cdn.jsdelivr.net/npm/fullcalendar@5.11.0/main.min.js'></script>
</body>
</html>
