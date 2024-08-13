<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <h2 class="font-bold text-2xl text-gray-800 dark:text-gray-200 leading-tight">
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
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6 text-gray-900 dark:text-white">

                    @if($reserve->rentalitem->uploads->isNotEmpty())
                        <div class="md:col-span-2 flex justify-center mb-6">
                            <img src="{{ Storage::url($reserve->rentalitem->uploads->first()->file_path) }}"
                                 alt="Imagem da Sala"
                                 class="w-full h-64 object-cover rounded-lg shadow-md">
                        </div>
                    @else
                        <div class="md:col-span-2 flex justify-center mb-6">
                            <img src="{{ asset('default_rentalitem.png') }}"
                                 alt="Imagem da Sala" class="w-full h-64 object-cover rounded-lg shadow-md">
                        </div>
                    @endif

                    <div>
                        <h3 class="text-lg font-semibold mb-2">Responsável</h3>
                        <p class="text-xl font-medium">{{ $reserve->user->name }}</p>
                    </div>

                    <div>
                        <h3 class="text-lg font-semibold mb-2">Empresa</h3>
                        <p class="text-xl font-medium">{{ $reserve->user->company }}</p>
                    </div>

                    <div class="md:col-span-2">
                        <h3 class="text-lg font-semibold mb-2">Espaço</h3>
                        <p class="text-xl font-medium">{{ $reserve->rentalitem->name }}</p>
                    </div>

                    <div>
                        <h3 class="text-lg font-semibold mb-2">Data de Início</h3>
                        <p class="text-xl font-medium">{{ $reserve->start_date }}</p>
                    </div>
                    <div>
                        <h3 class="text-lg font-semibold mb-2">Hora de Início</h3>
                        <p class="text-xl font-medium">{{ Carbon\Carbon::parse($reserve->start_date)->format('H:i') }}</p>
                    </div>
                    <div>
                        <h3 class="text-lg font-semibold mb-2">Data de Fim</h3>
                        <p class="text-xl font-medium">{{ $reserve->end_date }}</p>
                    </div>
                    <div>
                        <h3 class="text-lg font-semibold mb-2">Hora do Fim</h3>
                        <p class="text-xl font-medium">{{ Carbon\Carbon::parse($reserve->end_date)->format('H:i') }}</p>
                    </div>

                    <div class="md:col-span-2">
                        <h3 class="text-lg font-semibold mb-2">Observações</h3>
                        <p class="text-xl font-medium">{{ $reserve->reserve_notes }}</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
