<!---Navbar--->
<x-app-layout>
    <x-slot name="header">
        <div class="flex flex-col sm:flex-row justify-between items-center">
            <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight mb-4 sm:mb-0">
                {{ __('Itens de Locação') }}
            </h2>
            <button data-modal-target="create-user" data-modal-toggle="create-user"
                    class="block text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800"
                    type="button">Criar Novo Usuário
            </button>
        </div>
    </x-slot>
    <!----Tela de Erro--->
    @error('errors')
    <div id="toast-danger"
         class="flex items-center w-full max-w-xs p-4 mb-4 text-gray-500 bg-white rounded-lg shadow dark:text-gray-400 dark:bg-gray-800"
         role="alert">
        <div
            class="inline-flex items-center justify-center flex-shrink-0 w-8 h-8 text-red-500 bg-red-100 rounded-lg dark:bg-red-800 dark:text-red-200">
            <svg class="w-5 h-5" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor"
                 viewBox="0 0 20 20">
                <path
                    d="M10 .5a9.5 9.5 0 1 0 9.5 9.5A9.51 9.51 0 0 0 10 .5Zm3.707 11.793a1 1 0 1 1-1.414 1.414L10 11.414l-2.293 2.293a1 1 0 0 1-1.414-1.414L8.586 10 6.293 7.707a1 1 0 0 1 1.414-1.414L10 8.586l2.293-2.293a1 1 0 0 1 1.414 1.414L11.414 10l2.293 2.293Z"/>
            </svg>
            <span class="sr-only">{{$messages}}</span>
        </div>
    </div>
    @enderror

    <!--------Barra de Pesquisa---------->
    <form class="max-w-lg mx-auto mt-10" method="GET" action="{{ route('users.index') }}">
        <div class="relative w-full">
            <label for="search"
                   class="mb-2 text-sm font-medium text-gray-900 sr-only dark:text-white">Pesquisar</label>
            <input type="search" id="search" name="search"
                   class="block p-2.5 w-full z-20 text-sm text-gray-900 bg-gray-50 rounded-lg border border-gray-300 focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:border-blue-500"
                   placeholder="Pesquisar por Nome, Email, CPF/CNPJ, Criado em..." value="{{ request('search') }}"
                   required/>
            <div class="absolute inset-y-0 right-0 flex items-center space-x-1">
                <button type="button"
                        onclick="document.getElementById('search').value=''; this.form.submit();"
                        class="p-2 text-sm font-medium text-red-500 hover:text-red-700 focus:outline-none focus:ring-0">
                    <svg class="w-6 h-6 text-gray-800 dark:text-white" aria-hidden="true"
                         xmlns="http://www.w3.org/2000/svg"
                         width="24" height="24" fill="none" viewBox="0 0 24 24">
                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                              d="M17.651 7.65a7.131 7.131 0 0 0-12.68 3.15M18.001 4v4h-4m-7.652 8.35a7.13 7.13 0 0 0 12.68-3.15M6 20v-4h4"/>
                    </svg>
                    <span class="sr-only">Limpar</span>
                </button>
                <button type="submit"
                        class="p-2 text-sm font-medium text-white bg-blue-700 rounded-r-lg border border-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">
                    <svg class="w-4 h-4" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none"
                         viewBox="0 0 20 20">
                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                              d="m19 19-4-4m0-7A7 7 0 1 1 1 8a7 7 0 0 1 14 0Z"/>
                    </svg>
                    <span class="sr-only">Pesquisar</span>
                </button>
            </div>
        </div>
    </form>
    <!--------Fim da Barra de Pesquisa---------->


    <!--------Tabela de Usários--------->
    <div class="relative overflow-x-auto shadow-md sm:rounded-lg p-4 sm:p-8">
        <table class="w-full text-sm text-left rtl:text-right text-gray-500 dark:text-gray-400">
            <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
            <tr>
                <th scope="col" class="px-6 py-3">
                    ID
                </th>
                <th scope="col" class="px-6 py-3">
                    Avatar
                </th>
                <th scope="col" class="px-6 py-3">
                    Nome
                </th>
                <th scope="col" class="px-6 py-3">
                    Categoria
                </th>
                <th scope="col" class="px-6 py-3 hidden lg:table-cell">
                    CPF/CNPJ
                </th>
                <th scope="col" class="px-6 py-3 hidden md:table-cell">
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
                    <th scope="col" class="px-6 py-3">
                        @if ($user->uploads->isNotEmpty())
                            <img class="w-10 h-10 rounded-full object-cover"
                                 src="{{ Storage::url($user->uploads->first()->file_path) }}" alt="Rounded avatar">
                        @else
                            <img class="w-10 h-10 rounded-full shadow-lg object-cover"
                                 src="{{ asset('default_image.png') }}"
                                 alt="Default avatar">
                        @endif
                    </th>

                    <td class="px-6 py-4">
                        {{ $user->name }}
                    </td>
                    <td class="px-6 py-4">
                        {{ $user->role }}
                    </td>
                    <td class="px-6 py-4 hidden lg:table-cell">
                        {{ $user->formatted_cpf_cnpj }}
                    </td>
                    <td class="px-6 py-4 hidden md:table-cell">
                        {{ $user->created_at }}
                    </td>
                    <td class="flex flex-col sm:flex-row items-center space-y-2 sm:space-y-0 sm:space-x-2 px-6 py-4">
                        <!-- Botao de View -->
                        <a href="{{ route('users.show', $user->id) }}" class="cursor-pointer view-user-button">
                            <x-icons.eye/>
                        </a>

                        <!-- Delete Modal -->
                        <button data-user-id="{{ $user->id }}"
                                class="delete-button block text-red-500 rounded-lg text-sm px-5 py-2.5 text-center dark:focus:ring-blue-800"
                                data-modal-target="delete-modal" data-modal-toggle="delete-modal" type="button">
                            <x-icons.trash/>
                        </button>

                        <!-- Modal Edicao -->
                        <button data-modal-target="edit-modal" data-modal-toggle="edit-modal"
                                data-user-id="{{ $user->id }}" data-user-name="{{ $user->name }}"
                                data-user-email="{{ $user->email }}" data-user-phone="{{ $user->phone }}"
                                data-user-cpf_cnpj="{{ $user->cpf_cnpj }}" data-user-cep="{{ $user->cep }}"
                                data-user-rua="{{ $user->rua }}" data-user-bairro="{{ $user->bairro }}"
                                data-user-cidade="{{ $user->cidade }}" data-user-role="{{ $user->role }}"
                                class="font-medium text-blue-600 dark:text-blue-500 hover:underline edit-user-button"
                                type="button">
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
    </div>

    <!----Fim da tabela de Usuario --->

    <!---links-->
    @vite('resources/js/user.js')
    @vite('resources/js/user-mask.js')
    @include('users/modal/create-user')
    @include('users/modal/delete-modal')
    @include('users/modal/update-modal')
</x-app-layout>
