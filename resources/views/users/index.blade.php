<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Usuários') }}
        </h2>
    </x-slot>

    <div class="relative overflow-x-auto shadow-md sm:rounded-lg p-8">
        <table class="w-full text-sm text-left rtl:text-right text-gray-500 dark:text-gray-400">
            <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
            <tr>
                <th scope="col" class="px-6 py-3">
                    ID
                </th>
                <th scope="col" class="px-6 py-3">
                    Nome
                </th>
                <th scope="col" class="px-6 py-3">
                    CPF/CPNJ
                </th>
                <th scope="col" class="px-6 py-3">
                    Criado em
                </th>
                <th scope="col" class="px-6 py-3">
                    Ações
                </th>
            </tr>
            </thead>
            <tbody>
            @foreach($users as $user)
                <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700 hover:bg-gray-50 dark:hover:bg-gray-600">
                    <th scope="row" class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                        {{ $user->id }}
                    </th>
                    <td class="px-6 py-4">
                        {{ $user->name }}
                    </td>
                    <td class="px-6 py-4">
                        {{ $user->cpf_cnpj }}
                    </td>
                    <td class="px-6 py-4">
                        {{ $user->created_at }}
                    </td>
                    <td class="flex items-center px-6 py-4 space-x-2">

                        <!-- View Modal -->
                        <button data-user-id="{{ $user->id }}"
                                data-user-name="{{ $user->name }}"
                                data-user-email="{{ $user->email }}"
                                data-user-phone="{{ $user->phone }}"
                                data-user-cpf_cnpj="{{ $user->cpf_cnpj }}"
                                data-user-cep="{{ $user->cep }}"
                                data-user-rua="{{ $user->rua }}"
                                data-user-bairro="{{ $user->bairro }}"
                                data-user-cidade="{{ $user->cidade }}"
                                data-user-role="{{ $user->role }}"
                                data-user-created_at="{{ $user->created_at }}"
                                data-user-updated_at="{{ $user->updated_at }}"
                                data-modal-target="view-modal"
                                data-modal-toggle="view-modal"
                                class="cursor-pointer view-user-button">
                            <x-icons.eye/>
                        </button>


                        <!-- Delete Modal -->
                        <button data-reserve-id="{{ $user->id }}"
                                class="delete-button block text-red-500 rounded-lg text-sm px-5 py-2.5 text-center dark:focus:ring-blue-800"
                                data-modal-target="delete-modal" data-modal-toggle="delete-modal" type="button">
                            <x-icons.trash/>
                        </button>

                        <!-- Edit Modal -->
                        <button data-modal-target="edit-modal" data-modal-toggle="edit-modal"
                                data-user-id="{{ $user->id }}" data-user-name="{{ $user->name }}"
                                data-user-email="{{ $user->email }}" data-user-phone="{{ $user->phone }}"
                                data-user-cpf_cnpj="{{ $user->cpf_cnpj }}" data-user-cep="{{ $user->cep }}"
                                data-user-rua="{{ $user->rua }}" data-user-bairro="{{ $user->bairro }}"
                                data-user-cidade="{{ $user->cidade }}" data-user-role="{{ $user->role }}"
                                class="font-medium text-blue-600 dark:text-blue-500 hover:underline" type="button">
                            <x-icons.edit/>
                        </button>
                    </td>
                </tr>
            @endforeach
            </tbody>
        </table>

        <div class="my-4">
            {{$users->links()}}
        </div>

        <!-- Modal Create -->
        <button data-modal-target="create-user" data-modal-toggle="create-user"
                class="block text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800"
                type="button">Criar Novo Usuário
        </button>

        @vite('resources/js/user.js')
        @include('users/modal/create-user')
        @include('users/modal/delete-modal')
        @include('users/modal/update-modal')
        @include('users/modal/view-modal')

        <!-- Script Modal -->
        <script>
            document.addEventListener('DOMContentLoaded', function () {
                const modal = document.getElementById('delete-modal');
                const deleteForm = document.getElementById('delete-form');
                const buttons = document.querySelectorAll('[data-modal-toggle="delete-modal"]');

                buttons.forEach(button => {
                    button.addEventListener('click', function () {
                        const userId = this.getAttribute('data-user-id');
                        deleteForm.setAttribute('action', `/users/${userId}`);
                    });
                });
            });
        </script>
    </div>

</x-app-layout>
