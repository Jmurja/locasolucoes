<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Digiplace</title>

    <!-- Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;600;700&display=swap" rel="stylesheet">
    @vite('resources/css/app.css')
    <link href='https://cdn.jsdelivr.net/npm/fullcalendar@5.11.0/main.min.css' rel='stylesheet'/>
    <script src='https://cdn.jsdelivr.net/npm/fullcalendar@5.11.0/main.min.js'></script>
</head>
<body class="font-sans antialiased dark:bg-gray-900 dark:text-white/50">

<div class="bg-slate-800 w-full h-16 flex items-center justify-center shadow-md">
    <form action="{{ route('dev.login') }}" method="GET" class="flex items-center space-x-3">
        @csrf
        <select name="user_id"
                class="px-3 py-2 bg-slate-300 border border-slate-500 rounded-lg shadow-md text-slate-800 focus:outline-none focus:ring-2 focus:ring-slate-500 focus:border-transparent">
            @foreach($users as $user)
                <option value="{{ $user->id }}">{{ $user->name }}</option>
            @endforeach
        </select>
        <button type="submit"
                class="px-4 py-2 bg-slate-600 text-white rounded-lg shadow-md hover:bg-slate-500 focus:outline-none focus:ring-2 focus:ring-slate-500 focus:ring-opacity-75 transition duration-200">
            Login
        </button>
    </form>
</div>

<!-- Mensagens de Erro -->
@if ($errors->any())
    <div
        class="max-w-lg mx-auto mt-4 p-4 mb-4 text-sm text-red-700 bg-red-100 rounded-lg dark:bg-red-200 dark:text-red-800"
        role="alert">
        @foreach ($errors->all() as $error)
            <p>{{ $error }}</p>
        @endforeach
    </div>
@endif

@if(session('success'))
    <div
        class="flex items-center p-4 mb-4 text-sm text-yellow-800 rounded-lg bg-yellow-50 dark:bg-gray-800 dark:text-yellow-300"
        role="alert">
        <svg class="flex-shrink-0 inline w-4 h-4 me-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg"
             fill="currentColor" viewBox="0 0 20 20">
            <path
                d="M10 .5a9.5 9.5 0 1 0 9.5 9.5A9.51 9.51 0 0 0 10 .5ZM9.5 4a1.5 1.5 0 1 1 0 3 1.5 1.5 0 0 1 0-3ZM12 15H8a1 1 0 0 1 0-2h1v-3H8a1 1 0 0 1 0-2h2a1 1 0 0 1 1 1v4h1a1 1 0 0 1 0 2Z"/>
        </svg>
        <span class="sr-only">Info</span>
        <div>
            <span class="font-medium">{{ session('success') }}</span>
            @if(session('warning'))
                <div class="mt-2">{{ session('warning') }}</div>
            @endif
        </div>
    </div>
@endif


<div
    class="bg-gray-50 text-black/50 dark:bg-gray-900 dark:text-white/50 min-h-screen flex flex-col items-center justify-center relative">
    <div class="relative w-full max-w-2xl px-6 lg:max-w-7xl z-10">
        <header class="grid grid-cols-2 items-center gap-2 py-10 lg:grid-cols-3">
            <img src="{!! asset('digiplace.png') !!}" alt="Logo" class="w-60 justify-center flex">
            <div class="flex lg:justify-center lg:col-start-2">
                <!-- Add any additional header content here -->
            </div>
        </header>

        <main class="mt-10 w-full">
            <div id='calendar'></div>
        </main>
    </div>
</div>

@vite('resources/js/visitor-fullcalendar.js')
@vite('resources/js/reserves-request.js')
@vite('resources/js/visitor-mask.js')
@vite('resources/js/datepicker.js')
@include('welcome.modal.visitor-reserve-modal')

</body>
</html>
