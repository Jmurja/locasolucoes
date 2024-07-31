<x-app-layout>
    <x-slot name="header">
        <div class="flex flex-col sm:flex-row justify-between items-center">
            <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
                {{ __('Detalhes do Usuário') }}
            </h2>
            <a href="{{ route('users.index') }}"
               class="mt-4 sm:mt-0 block text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">
                Voltar
            </a>
        </div>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-xl sm:rounded-lg p-6">
                <dl class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-x-6 gap-y-8 text-gray-900 dark:text-white">
                    <div class="flex flex-col">
                        <dt class="mb-1 text-gray-500 md:text-lg dark:text-gray-400">Nome</dt>
                        <dd class="text-lg font-semibold">{{ $user->name }}</dd>
                    </div>
                    <div class="flex flex-col">
                        <dt class="mb-1 text-gray-500 md:text-lg dark:text-gray-400">Email</dt>
                        <dd class="text-lg font-semibold">{{ $user->email }}</dd>
                    </div>
                    <div class="flex flex-col">
                        <dt class="mb-1 text-gray-500 md:text-lg dark:text-gray-400">Telefone</dt>
                        <dd class="text-lg font-semibold">{{ $user->formatted_phone }}</dd>
                    </div>
                    <div class="flex flex-col">
                        <dt class="mb-1 text-gray-500 md:text-lg dark:text-gray-400">CPF/CPNJ</dt>
                        <dd class="text-lg font-semibold">{{ $user->formatted_cpf_cnpj }}</dd>
                    </div>
                    <div class="flex flex-col">
                        <dt class="mb-1 text-gray-500 md:text-lg dark:text-gray-400">CEP</dt>
                        <dd class="text-lg font-semibold">{{ $user->formatted_cep}}</dd>
                    </div>
                    <div class="flex flex-col">
                        <dt class="mb-1 text-gray-500 md:text-lg dark:text-gray-400">Rua</dt>
                        <dd class="text-lg font-semibold">{{ $user->rua }}</dd>
                    </div>
                    <div class="flex flex-col">
                        <dt class="mb-1 text-gray-500 md:text-lg dark:text-gray-400">Bairro</dt>
                        <dd class="text-lg font-semibold">{{ $user->bairro }}</dd>
                    </div>
                    <div class="flex flex-col">
                        <dt class="mb-1 text-gray-500 md:text-lg dark:text-gray-400">Cidade</dt>
                        <dd class="text-lg font-semibold">{{ $user->cidade }}</dd>
                    </div>
                    <div class="flex flex-col">
                        <dt class="mb-1 text-gray-500 md:text-lg dark:text-gray-400">Categoria</dt>
                        <dd class="text-lg font-semibold">{{ $user->role }}</dd>
                    </div>
                    <div class="flex flex-col">
                        <dt class="mb-1 text-gray-500 md:text-lg dark:text-gray-400">Criado em</dt>
                        <dd class="text-lg font-semibold">{{ $user->created_at }}</dd>
                    </div>
                    <div class="flex flex-col">
                        <dt class="mb-1 text-gray-500 md:text-lg dark:text-gray-400">Atualizado em</dt>
                        <dd class="text-lg font-semibold">{{ $user->updated_at }}</dd>
                    </div>
                </dl>
            </div>
        </div>
    </div>
</x-app-layout>
