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

    <div id="overlay" class="fixed inset-0 bg-black opacity-50 z-30 hidden"></div>
    @if ($errors->any())
        <div
            class="max-w-lg mx-auto mt-4 p-4 mb-4 text-sm text-red-700 bg-red-100 rounded-lg dark:bg-red-200 dark:text-red-800"
            role="alert">
            @foreach ($errors->all() as $error)
                <p>{{ $error }}</p>
            @endforeach
        </div>
    @endif
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
                @if(empty($RentalItem->uploads))
                    <figure
                        class="relative max-w-xs transition-all duration-300 cursor-pointer filter grayscale hover:grayscale-0">
                        <a href="#">
                            <img class="rounded-lg w-full h-auto object-cover"
                                 src="{{ asset('digiplace.png')}} "
                                 alt="Imagem do item de aluguel">
                        </a>
                        <figcaption
                            class="absolute bottom-0 left-0 right-0 bg-black bg-opacity-60 px-4 py-2 text-lg text-white">
                            <p>{{ $RentalItem->name }}: {{ $RentalItem->description }}</p>
                            <p>R${{ $RentalItem->price_per_hour }}</p>
                        </figcaption>
                    </figure>
                @endif

                @foreach($RentalItem->uploads as $upload)
                    <figure
                        class="relative max-w-xs transition-all duration-300 cursor-pointer filter grayscale hover:grayscale-0">
                        <a href="#">
                            <img class="rounded-lg w-full h-auto object-cover"
                                 src="{{asset($upload->file_path) ?? asset('digiplace.png')}} "
                                 alt="Imagem do item de aluguel">
                        </a>
                        <figcaption
                            class="absolute bottom-0 left-0 right-0 bg-black bg-opacity-60 px-4 py-2 text-lg text-white">
                            <p>{{ $RentalItem->name }}: {{ $RentalItem->description }}</p>
                            <p>R${{ $RentalItem->price_per_hour }} Por hora</p>
                        </figcaption>
                    </figure>
                @endforeach
            @endforeach
        </div>
    </div>

    <div id="tooltip" class="hidden absolute bg-white text-black p-2 border rounded shadow-lg"></div>

    <div class="container">
        <div
            class=" w-full max-w-md p-4 border border-gray-200 rounded-lg shadow sm:p-8 dark:bg-gray-800 dark:border-gray-700">
            <div class="flex items-center justify-between mb-4">
                <div class="flex items-center space-x-2">
                    <svg class="w-6 h-6 text-gray-800 dark:text-white" aria-hidden="true"
                         xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="none" viewBox="0 0 24 24">
                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                              d="M10 11h2v5m-2 0h4m-2.592-8.5h.01M21 12a9 9 0 1 1-18 0 9 9 0 0 1 18 0Z"/>
                    </svg>

                    <h5 class="text-xl font-bold leading-none text-gray-900 dark:text-white">Observações</h5>
                </div>
            </div>
            <div class="text-xl leading-none text-gray-900 dark:text-white">
                <h2 class="mb-2 p-2">Reservas dos Próximos 7 Dias</h2>
                @foreach($upcomingReserves as $reserve)
                    <div class="p-3 mb-4 radius-2xl bg-gray-900 rounded-2xl z-20">
                        <h3>{{ $reserve->title }}</h3>
                        <h3>{{ $reserve->start_date }}</h3>
                    </div>
                @endforeach
            </div>
        </div>

        <div id="calendar"></div>
    </div>
    @include('dashboard.modal.tenant-reserve-modal')
    @vite('resources/css/dashboard.css')

    @vite('resources/js/datepicker.js')
    @vite('resources/js/drawer.js')
    @vite('resources/js/tenant-fullcalendar.js')
</x-app-layout>

</body>
</html>
