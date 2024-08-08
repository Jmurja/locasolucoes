<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
                {{ __('Detalhes da Reserva') }}
            </h2>
            <a href="{{ route('reserves.index') }}"
               class="block text-white bg-blue-600 hover:bg-blue-700 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-blue-500 dark:hover:bg-blue-600 dark:focus:ring-blue-800">
                Voltar
            </a>
        </div>
    </x-slot>

    <div class="py-12">
        <div class="max-w-4xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-xl sm:rounded-lg p-8">
                <dl class="grid grid-cols-2 gap-6 text-gray-900 dark:text-white">
                    <div class="flex flex-col">
                        <dt class="mb-2 text-sm font-medium text-gray-500 dark:text-gray-400">Responsável</dt>
                        <dd class="text-lg font-semibold break-words">{{ $reserve->user->name }}</dd>
                    </div>
                    <div class="flex flex-col">
                        <dt class="mb-2 text-sm font-medium text-gray-500 dark:text-gray-400">Espaço</dt>
                        <dd class="text-lg font-semibold break-words">{{ $reserve->rentalitem->name }}</dd>
                    </div>
                    <div class="flex flex-col">
                        <dt class="mb-2 text-sm font-medium text-gray-500 dark:text-gray-400">Empresa</dt>
                        <dd class="text-lg font-semibold break-words">{{ $reserve->user->company }}</dd>
                    </div>
                    <div class="flex flex-col">
                        <dt class="mb-2 text-sm font-medium text-gray-500 dark:text-gray-400">Data de Início</dt>
                        <dd class="text-lg font-semibold break-words">{{ $reserve->start_date }}</dd>
                    </div>
                    <div class="flex flex-col">
                        <dt class="mb-2 text-sm font-medium text-gray-500 dark:text-gray-400">Data de Fim</dt>
                        <dd class="text-lg font-semibold break-words">{{ $reserve->end_date }}</dd>
                    </div>
                    <div class="flex flex-col">
                        <dt class="mb-2 text-sm font-medium text-gray-500 dark:text-gray-400">Hora de Início</dt>
                        <dd class="text-lg font-semibold break-words">{{ Carbon\Carbon::parse($reserve->start_date)->format('H:i') }}</dd>
                    </div>
                    <div class="flex flex-col">
                        <dt class="mb-2 text-sm font-medium text-gray-500 dark:text-gray-400">Hora do Fim</dt>
                        <dd class="text-lg font-semibold break-words">{{ Carbon\Carbon::parse($reserve->end_date)->format('H:i') }}</dd>
                    </div>
                    <div class="flex flex-col col-span-2">
                        <dt class="mb-2 text-sm font-medium text-gray-500 dark:text-gray-400">Observações</dt>
                        <dd class="text-lg font-semibold break-words">{{ $reserve->reserve_notes }}</dd>
                    </div>
                </dl>
            </div>
        </div>
    </div>
</x-app-layout>
