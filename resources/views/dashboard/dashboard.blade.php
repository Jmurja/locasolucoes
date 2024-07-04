<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Calendário') }}
        </h2>
    </x-slot>
    <div class="flex flex-col items-center justify-center">
        <h1 class="mb-4 text-2xl font-extrabold leading-none tracking-tight text-gray-900 md:text-3xl lg:text-4xl dark:text-white ">
            Bem vindo, Você está logado como <span
                class="underline underline-offset-3 decoration-8 decoration-blue-400 dark:decoration-blue-600">Administrador</span>
        </h1>
    </div>

    <div id='calendar'></div>

    @vite('resources/js/fullcalendar.js')
    @vite('resources/js/solicitar-reserva.js')
    @include('dashboard.modal.visitor-reserve-modal')
    @include('dashboard.modal.tenant-reserve-modal')
    @include('dashboard.modal.termo-service-modal')

    <!-- Modal Service -->
    @if (auth()->user()->role == 'visitor')
        <button id="modalToggleButton" data-modal-target="solicitar-reserva" data-modal-toggle="solicitar-reserva"
                class="hidden">
            Solicitar Reserva
        </button>
    @elseif (auth()->user()->role == 'tenant')
        <button id="modalToggleButton" data-modal-target="tenant-reserve" data-modal-toggle="tenant-reserve"
                class="hidden">
            Solicitar Reserva
        </button>
    @endif


</x-app-layout>
