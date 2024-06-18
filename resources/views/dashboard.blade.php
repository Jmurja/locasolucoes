<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Calendário') }}
        </h2>
    </x-slot>
    <div class="flex flex-col items-center justify-center">
    <h1 class="mb-4 text-4xl font-extrabold leading-none tracking-tight text-gray-900 md:text-5xl lg:text-6xl dark:text-white ">Bem vindo, Você está logado como <span class="underline underline-offset-3 decoration-8 decoration-blue-400 dark:decoration-blue-600">Administrador</span></h1>
    </div>

    <div class="calendar_full">
    <div  id='calendar'></div>
    </div>
    <link href='{{ asset("css/fullcalendar.css") }}' rel='stylesheet' />
</x-app-layout>
