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

<script>
    document.addEventListener('DOMContentLoaded', function () {
        const successAlert = document.getElementById('success-alert');
        if (successAlert) {
            successAlert.style.display = 'block';
            setTimeout(() => {
                successAlert.style.display = 'none';
            }, 5000); // Esconde o alerta após 5 segundos
        }
    });
</script>


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


<div
    class="bg-gray-50 text-black/50 dark:bg-gray-900 dark:text-white/50 min-h-screen flex flex-col items-center justify-center relative">
    <div class="relative w-full max-w-2xl px-6 lg:max-w-7xl z-10">
        <header class="grid grid-cols-2 items-center gap-2 py-10 lg:grid-cols-3">
            <img src="{!! asset('digiplace.png') !!}" alt="Logo" class="w-60 justify-center flex">
            <div class="flex lg:justify-center lg:col-start-2">
                <!-- Add any additional header content here -->
            </div>
        </header>

        @if(session('success'))
            <div id="alert-additional-content-3"
                 class="p-4 mb-4 absolute z-50 text-green-800 border border-green-300 rounded-lg bg-green-50 dark:bg-gray-800 dark:text-green-400 dark:border-green-800"
                 role="alert" style="background-color: rgba(34, 40, 49, 0.8);"> <!-- Ajuste aqui para o fundo escuro -->
                <div class="flex items-center">
                    <svg class="flex-shrink-0 w-4 h-4 me-2" aria-hidden="true" xmlns="http://www.w3.org/2000/svg"
                         fill="currentColor" viewBox="0 0 20 20">
                        <path
                            d="M10 .5a9.5 9.5 0 1 0 9.5 9.5A9.51 9.51 0 0 0 10 .5ZM9.5 4a1.5 1.5 0 1 1 0 3 1.5 1.5 0 0 1 0-3ZM12 15H8a1 1 0 0 1 0-2h1v-3H8a1 1 0 0 1 0-2h2a1 1 0 1 1 1 1v4h1a1 1 0 0 1 0 2Z"/>
                    </svg>
                    <span class="sr-only">Info</span>
                    <h3 class="text-lg font-medium">Reserva Solicitada!</h3>
                </div>
                <div class="mt-2 mb-4 text-sm">
                    Sua reserva foi solicitada com sucesso! Agradecemos pela sua preferência. Em breve, entraremos em
                    contato com você pelo WhatsApp, para confirmar os detalhes. Se precisar de qualquer assistência
                    adicional, não hesite em nos procurar. Estamos à disposição para ajudar!
                </div>
                <div class="flex">
                    <button type="button"
                            class="text-green-800 bg-transparent border border-green-800 hover:bg-green-900 hover:text-white focus:ring-4 focus:outline-none focus:ring-green-300 font-medium rounded-lg text-xs px-3 py-1.5 text-center dark:hover:bg-green-600 dark:border-green-600 dark:text-green-400 dark:hover:text-white dark:focus:ring-green-800"
                            data-dismiss-target="#alert-additional-content-3" aria-label="Close">
                        Ok
                    </button>
                </div>
            </div>
        @endif

        <script>
            document.addEventListener('DOMContentLoaded', function () {
                const alert = document.querySelector('#alert-additional-content-3');
                const closeButton = alert.querySelector('[data-dismiss-target]');

                closeButton.addEventListener('click', function () {
                    alert.style.display = 'none';
                });
            });
        </script>

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
