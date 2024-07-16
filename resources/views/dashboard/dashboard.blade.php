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
                <span
                    class="underline underline-offset-3 decoration-8 decoration-blue-400 dark:decoration-blue-600">Locatário</span>
            @elseif (auth()->user()->role == 'visitor')
                <span
                    class="underline underline-offset-3 decoration-8 decoration-blue-400 dark:decoration-blue-600">Visitante</span>
            @elseif (auth()->user()->role == 'admin')
                <span class="underline underline-offset-3 decoration-8 decoration-blue-400 dark:decoration-blue-600">Administrador</span>
            @else
                <span class="underline underline-offset-3 decoration-8 decoration-blue-400 dark:decoration-blue-600">Proprietário</span>
            @endif

        </h1>
    </div>

    <div id='calendar'></div>

    @vite('resources/js/fullcalendar.js')
    @vite('resources/js/reserves-request.js')
    @include('welcome.modal.visitor-reserve-modal')
    @include('dashboard.modal.tenant-reserve-modal')
    @include('dashboard.modal.termo-service-modal')

    <!-- Modal Service -->
    @if (auth()->user()->role !== 'tenant')
        <button id="modalToggleButton" data-modal-target="visitor-reserve" data-modal-toggle="visitor-reserve"
                class="hidden">
            Solicitar Reserva
        </button>
    @elseif (auth()->user()->role !== 'visitor')
        <button id="modalToggleButton" data-modal-target="tenant-reserve" data-modal-toggle="tenant-reserve"
                class="hidden">
            Solicitar Reserva
        </button>
    @endif


</x-app-layout>
