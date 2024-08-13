<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <h2 class="font-bold text-2xl text-gray-200 leading-tight">
                {{ __('Detalhes da Reserva') }}
            </h2>
            <a href="{{ route('reserves.index') }}"
               class="block text-white bg-blue-600 hover:bg-blue-700 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-blue-500 dark:hover:bg-blue-600 dark:focus:ring-blue-800">
                Voltar
            </a>
        </div>
    </x-slot>

    <div class="py-12">
        <div class="max-w-6xl mx-auto sm:px-6 lg:px-8">
            <div class="grid grid-cols-1 md:grid-cols-2 gap-12">

                {{-- Seção de Detalhes da Reserva --}}
                <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-xl sm:rounded-lg p-8">
                    <h3 class="text-2xl font-bold text-white mb-4">{{ $reserve->title }}</h3>

                    @if($reserve->rentalitem->uploads->isNotEmpty())
                        <div class="flex justify-center mb-6">
                            <img src="{{ Storage::url($reserve->rentalitem->uploads->first()->file_path) }}"
                                 alt="Imagem da Sala"
                                 class="w-full h-64 object-cover rounded-lg shadow-md">
                        </div>
                    @else
                        <div class="flex justify-center mb-6">
                            <img src="{{ asset('default_rentalitem.png') }}"
                                 alt="Imagem da Sala" class="w-full h-64 object-cover rounded-lg shadow-md">
                        </div>
                    @endif

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6 text-gray-200">
                        <div>
                            <h4 class="text-lg font-semibold mb-2">Espaço</h4>
                            <p class="text-xl">{{ $reserve->rentalitem->name }}</p>
                        </div>

                        <div>
                            <h4 class="text-lg font-semibold mb-2">Status</h4>
                            <p class="text-xl">{{ $reserve->reserve_status }}</p>
                        </div>

                        <div>
                            <h4 class="text-lg font-semibold mb-2">Data de Início</h4>
                            <p class="text-xl">{{ $reserve->start_date }}</p>
                        </div>
                        <div>
                            <h4 class="text-lg font-semibold mb-2">Hora de Início</h4>
                            <p class="text-xl">{{ Carbon\Carbon::parse($reserve->start_date)->format('H:i') }}</p>
                        </div>

                        <div>
                            <h4 class="text-lg font-semibold mb-2">Data de Fim</h4>
                            <p class="text-xl">{{ $reserve->end_date }}</p>
                        </div>
                        <div>
                            <h4 class="text-lg font-semibold mb-2">Hora do Fim</h4>
                            <p class="text-xl">{{ Carbon\Carbon::parse($reserve->end_date)->format('H:i') }}</p>
                        </div>

                        <div class="md:col-span-2">
                            <h4 class="text-lg font-semibold mb-2">Observações</h4>
                            <p class="text-xl">{{ $reserve->reserve_notes }}</p>
                        </div>
                    </div>
                </div>

                {{-- Seção de Detalhes do Usuário --}}
                <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-xl sm:rounded-lg p-8">
                    <div class="flex flex-col items-center mb-6">
                        <div class="flex-shrink-0">
                            @if ($reserve->user->uploads->isNotEmpty())
                                <img class="w-32 h-32 rounded-full shadow-lg object-cover"
                                     src="{{ Storage::url($reserve->user->uploads->first()->file_path) }}"
                                     alt="User Avatar">
                            @else
                                <img class="w-32 h-32 rounded-full shadow-lg object-cover"
                                     src="{{ asset('default_image.png') }}"
                                     alt="Default Avatar">
                            @endif
                        </div>
                        <div class="mt-4 text-center">
                            <h4 class="text-lg font-semibold text-gray-200 mb-2 ">Responsável</h4>
                            <p class="text-xl text-gray-200">{{ $reserve->user->name }}</p>
                            <h4 class="text-lg text-gray-200 font-semibold mt-4 mb-2">Empresa</h4>
                            <p class="text-xl text-gray-200">{{ $reserve->user->company }}</p>

                            <h4 class="text-lg text-gray-200 font-semibold mt-4 mb-2">Telefone</h4>
                            <p class="text-xl text-gray-200">{{ $reserve->user->getFormattedPhoneAttribute() }}</p>

                            <h4 class="text-lg text-gray-200 font-semibold mt-4 mb-2">CPF/CNPJ</h4>
                            <p class="text-xl text-gray-200">{{ $reserve->user->getFormattedCpfCnpjAttribute() }}</p>

                            <h4 class="text-lg text-gray-200 font-semibold mt-4 mb-2">Email</h4>
                            <p class="text-xl text-gray-200">{{ $reserve->user->email }}</p>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>
</x-app-layout>
