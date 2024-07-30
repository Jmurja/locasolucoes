<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
                {{ __('Detalhes da Sala') }}
            </h2>
            <a href="{{ route('rental-items.index') }}"
               class="block text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">
                Voltar
            </a>
        </div>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-xl sm:rounded-lg p-6">
                <dl class="max-w-md mx-auto space-y-4 text-gray-900 divide-y divide-gray-200 dark:text-white dark:divide-gray-700">
                    <div class="flex flex-col pt-3">
                        <dt class="mb-1 text-gray-500 md:text-lg dark:text-gray-400">Nome</dt>
                        <dd class="text-lg font-semibold break-words">{{ $rentalItem->name }}</dd>
                    </div>
                    <div class="flex flex-col pt-3">
                        <dt class="mb-1 text-gray-500 md:text-lg dark:text-gray-400">Status</dt>
                        <dd class="text-lg font-semibold break-words">{{ $rentalItem->status }}</dd>
                    </div>
                    <div class="flex flex-col pt-3">
                        <dt class="mb-1 text-gray-500 md:text-lg dark:text-gray-400">Descrição</dt>
                        <dd class="text-lg font-semibold break-words">{{ $rentalItem->description }}</dd>
                    </div>
                    <div class="flex flex-col pt-3">
                        <dt class="mb-1 text-gray-500 md:text-lg dark:text-gray-400">Preço por hora</dt>
                        <dd class="text-lg font-semibold break-words">{{ $rentalItem->price_per_hour }}</dd>
                    </div>
                    <div class="flex flex-col pt-3">
                        <dt class="mb-1 text-gray-500 md:text-lg dark:text-gray-400">Preço por dia</dt>
                        <dd class="text-lg font-semibold break-words">{{ $rentalItem->price_per_day }}</dd>
                    </div>
                    <div class="flex flex-col pt-3">
                        <dt class="mb-1 text-gray-500 md:text-lg dark:text-gray-400">Preço por mês</dt>
                        <dd class="text-lg font-semibold break-words">{{ $rentalItem->price_per_month }}</dd>
                    </div>
                    <div class="flex flex-col pt-3">
                        <dt class="mb-1 text-gray-500 md:text-lg dark:text-gray-400">Observações</dt>
                        <dd class="text-lg font-semibold break-words">{{ $rentalItem->rental_item_notes }}</dd>
                    </div>
                </dl>
            </div>
        </div>
    </div>
</x-app-layout>
