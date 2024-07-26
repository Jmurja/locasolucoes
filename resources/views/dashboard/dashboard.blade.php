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

        /* Para garantir que o tooltip fique escondido inicialmente */
        .hidden {
            display: none;
        }
    </style>


    <div id="tooltip" class="hidden absolute bg-white text-black p-2 border rounded shadow-lg"></div>


    <div id='calendar'></div>

    @include('dashboard.modal.tenant-reserve-modal')
    @vite('resources/js/datepicker.js')
    @vite('resources/js/tenant-fullcalendar.js')
</x-app-layout>
