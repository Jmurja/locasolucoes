<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
                {{ __('Detalhes da Reserva') }}
            </h2>
            <a href="{{ route('reserves.index') }}"
               class="block text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">
                Voltar
            </a>
        </div>
    </x-slot>

    <div class="py-12">
        <div class="max-w-4xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-xl sm:rounded-lg p-8">
                <dl class="max-w-md mx-auto space-y-6 text-gray-900 divide-y divide-gray-200 dark:text-white dark:divide-gray-700">
                    <div class="flex flex-col pt-6">
                        <dt class="mb-2 text-gray-500 md:text-lg dark:text-gray-400">Responsável</dt>
                        <dd class="text-lg font-semibold break-words">{{ $reserve->user->name }}</dd>
                    </div>
                    <div class="flex flex-col pt-6">
                        <dt class="mb-2 text-gray-500 md:text-lg dark:text-gray-400">Espaço</dt>
                        <dd class="text-lg font-semibold break-words">{{ $reserve->rentalitem->name }}</dd>
                    </div>
                    <div class="flex flex-col pt-6">
                        <dt class="mb-2 text-gray-500 md:text-lg dark:text-gray-400">Empresa</dt>
                        <dd class="text-lg font-semibold break-words">{{ $reserve->user->company }}</dd>
                    </div>
                    <div class="flex flex-col pt-6">
                        <dt class="mb-2 text-gray-500 md:text-lg dark:text-gray-400">Data de Início</dt>
                        <dd class="text-lg font-semibold break-words">{{ $reserve->start_date }}</dd>
                    </div>
                    <div class="flex flex-col pt-6">
                        <dt class="mb-2 text-gray-500 md:text-lg dark:text-gray-400">Data de Fim</dt>
                        <dd class="text-lg font-semibold break-words">{{ $reserve->end_date }}</dd>
                    </div>
                    <div class="flex flex-col pt-6">
                        <dt class="mb-2 text-gray-500 md:text-lg dark:text-gray-400">Hora de Início</dt>
                        <dd class="text-lg font-semibold break-words">{{ Carbon\Carbon::parse($reserve->start_date)->format('H:i') }}</dd>
                    </div>
                    <div class="flex flex-col pt-6">
                        <dt class="mb-2 text-gray-500 md:text-lg dark:text-gray-400">Hora do Fim</dt>
                        <dd class="text-lg font-semibold break-words">{{ Carbon\Carbon::parse($reserve->end_date)->format('H:i') }}</dd>
                    </div>
                    <div class="flex flex-col pt-6">
                        <dt class="mb-2 text-gray-500 md:text-lg dark:text-gray-400">Observações</dt>
                        <dd class="text-lg font-semibold break-words">{{ $reserve->reserve_notes }}</dd>
                    </div>
                </dl>
            </div>
        </div>
    </div>
</x-app-layout>
