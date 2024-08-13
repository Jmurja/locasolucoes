<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <h2 class="font-bold text-2xl text-white leading-tight">
                {{ __('Detalhes da Sala') }}
            </h2>
            <a href="{{ route('rental-items.index') }}"
               class="block text-white bg-blue-600 hover:bg-blue-700 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center">
                Voltar
            </a>
        </div>
    </x-slot>

    <div class="py-12 bg-gray-100 dark:bg-gray-900">
        <div class="max-w-5xl mx-auto sm:px-6 lg:px-8">
            @if ($rentalItem->uploads->isNotEmpty())
                <div class="relative overflow-hidden rounded-lg shadow-lg">
                    <img class="w-full h-96 object-cover"
                         src="{{ Storage::url($rentalItem->uploads->first()->file_path) }}"
                         alt="{{ $rentalItem->name }}">
                    <div class="absolute inset-0 bg-black bg-opacity-50 flex items-center justify-center">
                        <h1 class="text-4xl font-bold text-white">{{ $rentalItem->name }}</h1>
                    </div>
                </div>
            @else
                <div class="relative overflow-hidden rounded-lg shadow-lg">
                    <div class="w-full h-96 bg-gray-400 flex items-center justify-center">
                        <img class="w-full h-96 object-cover"
                             src="{{asset('default_rentalitem.png')}}"
                             alt="{{ $rentalItem->name }}">
                    </div>
                </div>
            @endif

            <div class="bg-white dark:bg-gray-800 shadow-lg rounded-lg mt-8 p-8">
                <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-8 text-gray-900 dark:text-white">
                    <div>
                        <h3 class="text-xl font-semibold mb-2">Status</h3>
                        <p class="text-lg font-medium">{{ $rentalItem->status }}</p>
                    </div>
                    <div>
                        <h3 class="text-xl font-semibold mb-2">Preço por Hora</h3>
                        <p class="text-lg font-medium">{{ $rentalItem->price_per_hour }}</p>
                    </div>
                    <div>
                        <h3 class="text-xl font-semibold mb-2">Preço por Dia</h3>
                        <p class="text-lg font-medium">{{ $rentalItem->price_per_day }}</p>
                    </div>
                    <div>
                        <h3 class="text-xl font-semibold mb-2">Preço por Mês</h3>
                        <p class="text-lg font-medium">{{ $rentalItem->price_per_month }}</p>
                    </div>
                    <div class="lg:col-span-2">
                        <h3 class="text-xl font-semibold mb-2">Descrição</h3>
                        <p class="text-lg font-medium">{{ $rentalItem->description }}</p>
                    </div>
                    <div class="lg:col-span-3">
                        <h3 class="text-xl font-semibold mb-2">Observações</h3>
                        <p class="text-lg font-medium">{{ $rentalItem->rental_item_notes }}</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
