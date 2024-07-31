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

<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Calendário') }}
        </h2>
    </x-slot>
    <div class="flex flex-col items-center justify-center">
        <h1 class="mb-4 mt-6 text-xl font-extrabold leading-none tracking-tight text-gray-900 md:text-3xl lg:text-3xl dark:text-white ">
            Seja bem-vindo, Você está logado como
            @if (auth()->user()->role == 'tenant')
                <span class="underline underline-offset-3 decoration-8 decoration-blue-400 dark:decoration-blue-600">Locatário</span>
            @elseif (auth()->user()->role == 'admin')
                <span class="underline underline-offset-3 decoration-8 decoration-blue-400 dark:decoration-blue-600">Administrador</span>
            @else
                <span class="underline underline-offset-3 decoration-8 decoration-blue-400 dark:decoration-blue-600">Proprietário</span>
            @endif
        </h1>
        <button id="toggleDrawer" class="px-4 py-2 text-white bg-blue-600 rounded-lg justify-self-end">Mostrar
            Catálogo
        </button>
    </div>


    <style>
        #tooltip {
            z-index: 1000;
            pointer-events: none;
            background-color: #1e293b; /* slate-800 */
            color: #f8fafc; /* slate-50 */
            padding: 8px 12px; /* Espaçamento interno */
            border-radius: 4px; /* Bordas arredondadas */
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.3); /* Sombra */
            font-size: 14px; /* Tamanho da fonte */
            opacity: 0.9; /* Opacidade */
            transition: all 0.3s ease; /* Transição suave */
        }

        #overlay {
            transition: opacity 0.3s ease;
        }

        #w-full.max-w-md {
            margin-right: 20px; /* Espaço entre a div e o calendário */
        }

        .container {
            display: flex;
            justify-content: space-between;
            align-items: stretch; /* Garantir que ambos tenham a mesma altura */
            width: 100%;
            max-width: 1800px;
            margin: 0 auto;
            padding: 20px;
            background-color: inherit; /* Mesma cor do background */
        }

        .info-box {
            background-color: #2d3748; /* Cor de fundo desejada */
            flex: 0 0 30%; /* 30% da largura */
            display: flex;
            flex-direction: column;
            justify-content: space-between;
        }

        #calendar {
            flex: 0 0 70%; /* 70% da largura */
            background-color: #1e293b;
            border-radius: 10px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.3);
            overflow: hidden;
        }

        /* Manter as propriedades específicas do FullCalendar */
        .fc {
            height: 630px;
        }

        @media (max-width: 1200px) {
            .container {
                flex-direction: column;
            }

            .info-box, #calendar {
                flex: 0 0 auto;
                width: 100%;
                margin-bottom: 20px;
            }
        }

        @media (max-width: 1200px) {
            .container {
                flex-direction: column;
            }

            .info-box, #calendar {
                flex: 0 0 auto;
                width: 100%;
                margin-bottom: 20px;
            }
        }


    </style>

    <body>

    <div id="overlay" class="fixed inset-0 bg-black opacity-50 z-30 hidden"></div>

    <div id="drawer-bottom-example"
         class="fixed bottom-0 left-0 right-0 z-40 w-full p-4 overflow-y-auto transition-transform bg-white dark:bg-gray-800 translate-y-full"
         tabindex="-1" aria-labelledby="drawer-bottom-label">

        <button type="button" data-drawer-hide="drawer-bottom-example" aria-controls="drawer-bottom-example"
                class="text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm w-8 h-8 absolute top-2.5 end-2.5 inline-flex items-center justify-center dark:hover:bg-gray-600 dark:hover:text-white">
            <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none"
                 viewBox="0 0 14 14">
                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                      d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6"/>
            </svg>
            <span class="sr-only">Close menu</span>
        </button>

        <div class="flex flex-wrap gap-4">
            @foreach($RentalItems as $RentalItem)
                @foreach($RentalItem->uploads as $upload)
                    <figure
                        class="relative max-w-xs transition-all duration-300 cursor-pointer filter grayscale hover:grayscale-0">
                        <a href="#">
                            <img class="rounded-lg w-full h-auto object-cover" src="{{asset($upload->file_path)}}"
                                 alt="Imagem do item de aluguel">
                        </a>
                        <figcaption
                            class="absolute bottom-0 left-0 right-0 bg-black bg-opacity-60 px-4 py-2 text-lg text-white">
                            <p>{{ $RentalItem->name }}: {{ $RentalItem->description }}</p>
                            <p>R${{ $RentalItem->price_per_hour }}</p>
                        </figcaption>
                    </figure>
                @endforeach
            @endforeach
        </div>
    </div>


    <div id="tooltip" class="hidden absolute bg-white text-black p-2 border rounded shadow-lg"></div>


    <div class="container">
        <div
            class="info-box w-full max-w-md p-4 border border-gray-200 rounded-lg shadow sm:p-8 dark:bg-gray-800 dark:border-gray-700">
            <div class="flex items-center justify-between mb-4">
                <h5 class="text-xl font-bold leading-none text-gray-900 dark:text-white">Latest Customers</h5>
            </div>
        </div>
        <div id="calendar"></div>
    </div>


    @include('dashboard.modal.tenant-reserve-modal')
    @vite('resources/js/datepicker.js')
    @vite('resources/js/drawer.js')
    @vite('resources/js/tenant-fullcalendar.js')
</x-app-layout>

</body>
</html>
