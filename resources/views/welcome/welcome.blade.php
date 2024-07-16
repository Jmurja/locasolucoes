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
<div class="bg-slate-700 w-full h-12 flex items-center justify-center shadow-lg">
    <form action="{{ route('dev.login') }}" method="GET" class="flex items-center space-x-1">
        @csrf
        <select name="user_id"
                class="px-2 py-1 bg-slate-200 border border-slate-400 rounded-lg shadow-sm text-slate-800 focus:outline-none focus:ring-2 focus:ring-slate-400 focus:border-transparent">
            @foreach($users as $user)
                <option value="{{ $user->id }}">{{ $user->name }}</option>
            @endforeach
        </select>
        <button type="submit"
                class="px-2 py-1 bg-slate-600 text-white rounded-lg shadow-sm hover:bg-slate-500 focus:outline-none focus:ring-2 focus:ring-slate-400 focus:ring-opacity-50">
            Login
        </button>
    </form>
</div>
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

@vite('resources/js/fullcalendar-visitor.js')
@vite('resources/js/reserves-request.js')
@include('welcome.modal.visitor-reserve-modal')
<script src='https://cdn.jsdelivr.net/npm/fullcalendar@5.11.0/main.min.js'></script>
<script src='{{ mix("js/calendar.js") }}'></script>
</body>
</html>
