<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <h2 class="font-bold text-2xl text-gray-800 dark:text-gray-200 leading-tight">
                {{ __('Detalhes do Usuário') }}
            </h2>
            <a href="{{ route('users.index') }}"
               class="block text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">
                Voltar
            </a>
        </div>
    </x-slot>

    <div class="py-12 bg-white dark:bg-gray-900">
        <div class="max-w-4xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-gray-100 dark:bg-gray-800 shadow-xl sm:rounded-lg p-8">
                <div class="flex flex-col items-center">
                    <div class="mb-6">
                        @if ($user->uploads->isNotEmpty())
                            <img class="w-32 h-32 rounded-full shadow-lg object-cover"
                                 src="{{ Storage::url($user->uploads->first()->file_path) }}" alt="User Avatar">
                        @else
                            <img class="w-32 h-32 rounded-full shadow-lg object-cover"
                                 src="{{ asset('default_image.png') }}"
                                 alt="Default Avatar">
                        @endif
                    </div>


                    <div class="text-center mb-6">
                        <h3 class="text-2xl font-semibold text-gray-800 dark:text-gray-200">{{ $user->name }}</h3>
                        <p class="text-gray-600 dark:text-gray-400">{{ $user->email }}</p>
                        <span
                            class="inline-block bg-blue-100 text-blue-800 text-sm px-2.5 py-0.5 rounded dark:bg-blue-200 dark:text-blue-900 mt-2">
                            {{ $user->role }}
                        </span>
                    </div>

                    <div class="grid grid-cols-1 sm:grid-cols-2 gap-6 w-full text-gray-700 dark:text-gray-300">
                        <div>
                            <h4 class="font-bold text-gray-800 dark:text-gray-200">Telefone</h4>
                            <p>{{ $user->formatted_phone }}</p>
                        </div>
                        <div>
                            <h4 class="font-bold text-gray-800 dark:text-gray-200">CPF/CNPJ</h4>
                            <p>{{ $user->formatted_cpf_cnpj }}</p>
                        </div>
                        <div>
                            <h4 class="font-bold text-gray-800 dark:text-gray-200">CEP</h4>
                            <p>{{ $user->formatted_cep }}</p>
                        </div>
                        <div>
                            <h4 class="font-bold text-gray-800 dark:text-gray-200">Rua</h4>
                            <p>{{ $user->rua }}</p>
                        </div>
                        <div>
                            <h4 class="font-bold text-gray-800 dark:text-gray-200">Bairro</h4>
                            <p>{{ $user->bairro }}</p>
                        </div>
                        <div>
                            <h4 class="font-bold text-gray-800 dark:text-gray-200">Cidade</h4>
                            <p>{{ $user->cidade }}</p>
                        </div>
                        <div>
                            <h4 class="font-bold text-gray-800 dark:text-gray-200">Criado em</h4>
                            <p>{{ $user->created_at->format('d/m/Y H:i') }}</p>
                        </div>
                        <div>
                            <h4 class="font-bold text-gray-800 dark:text-gray-200">Atualizado em</h4>
                            <p>{{ $user->updated_at->format('d/m/Y H:i') }}</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
