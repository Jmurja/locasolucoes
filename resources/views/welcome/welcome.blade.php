@php use function PHPUnit\Framework\isEmpty; @endphp
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

<div
    class="bg-gray-50 text-black/50 dark:bg-gray-900 dark:text-white/50 min-h-screen flex flex-col items-center justify-center relative">
    <div class="relative w-full max-w-2xl px-6 lg:max-w-7xl z-10">
        <header class="grid grid-cols-3 items-center gap-2 py-10">
            <img src="{!! asset('digiplace.png') !!}" alt="Logo" class="w-60 justify-self-start">
            <div class="flex lg:justify-center lg:col-start-2">
            </div>
            <button id="toggleDrawer" class="px-4 py-2 text-white bg-blue-600 rounded-lg justify-self-end">Mostrar
                Catálogo
            </button>
        </header>
        @if ($errors->any())
            <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded relative" role="alert">
                <strong class="font-bold">Erro!</strong>
                <span class="block sm:inline">
            @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
        </span>
                <span class="absolute top-0 bottom-0 right-0 px-4 py-3">
            <svg class="fill-current h-6 w-6 text-red-500" role="button" xmlns="http://www.w3.org/2000/svg"
                 viewBox="0 0 20 20"><title>Close</title><path
                    d="M14.348 5.652a.5.5 0 00-.706 0L10 9.293 6.354 5.647a.5.5 0 10-.708.708L9.293 10l-3.647 3.646a.5.5 0 10.708.708L10 10.707l3.646 3.647a.5.5 0 00.708-.708L10.707 10l3.647-3.646a.5.5 0 000-.702z"/></svg>
        </span>
            </div>
        @endif


        @if(session('success'))
            <div id="alert-additional-content-3"
                 class="p-4 mb-4 absolute z-50 text-green-800 border border-green-300 rounded-lg bg-green-50 dark:bg-gray-800 dark:text-green-400 dark:border-green-800"
                 role="alert" style="background-color: rgba(34, 40, 49, 0.8);">
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
    </div>

    <main class="mt-10 w-full">
        <div id='calendar'></div>
    </main>
</div>


@vite('resources/js/visitor-fullcalendar.js')
@vite('resources/js/reserves-request.js')
@vite('resources/js/visitor-mask.js')
@vite('resources/js/datepicker.js')
@vite('resources/js/drawer.js')
@vite('resources/js/welcome.js')
@include('welcome.modal.visitor-reserve-modal')

</body>
</html>
