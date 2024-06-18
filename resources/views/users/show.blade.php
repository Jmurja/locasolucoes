<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Usuários ') . $user->name }}
        </h2>
    </x-slot>

    <div
        class="m-4 max-w-sm p-6 bg-white border border-gray-200 rounded-lg shadow dark:bg-gray-800 dark:border-gray-700">
        <dl class="max-w-md text-gray-900 divide-y divide-gray-200 dark:text-white dark:divide-gray-700">
            <div class="flex flex-col pb-3">
                <dt class="mb-1 text-gray-500 md:text-lg dark:text-gray-400">Nome</dt>
                <dd class="text-lg font-semibold">{{$user->name }}</dd>
            </div>
            <div class="flex flex-col py-3">
                <dt class="mb-1 text-gray-500 md:text-lg dark:text-gray-400">Email</dt>
                <dd class="text-lg font-semibold">{{ $user->email }}</dd>
            </div>
            <div class="flex flex-col pt-3">
                <dt class="mb-1 text-gray-500 md:text-lg dark:text-gray-400">Telefone</dt>
                <dd class="text-lg font-semibold">{{$user->phone }}</dd>
            </div>
            <div class="flex flex-col pt-3">
                <dt class="mb-1 text-gray-500 md:text-lg dark:text-gray-400">CPF/CPNJ</dt>
                <dd class="text-lg font-semibold">{{$user->cpf_cnpj }}</dd>
            </div>
            <div class="flex flex-col pt-3">
                <dt class="mb-1 text-gray-500 md:text-lg dark:text-gray-400">Categoria</dt>
                <dd class="text-lg font-semibold">{{$user->role}}</dd>
            </div>
            <div class="flex flex-col pt-3">
                <dt class="mb-1 text-gray-500 md:text-lg dark:text-gray-400">Criado em</dt>
                <dd class="text-lg font-semibold">{{$user->created_at }}</dd>
            </div>
            <div class="flex flex-col pt-3">
                <dt class="mb-1 text-gray-500 md:text-lg dark:text-gray-400">Atualizado em</dt>
                <dd class="text-lg font-semibold">{{$user->updated_at }}</dd>
            </div>
        </dl>
    </div>
</x-app-layout>
