<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
                {{ __('Itens de Locação') }}
            </h2>
            <!-- Cadastrar modal -->
            <button data-modal-target="register-item" data-modal-toggle="register-item"
                    class="block text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800"
                    type="button">
                Cadastrar Item de Locação
            </button>
        </div>
    </x-slot>

    <!--------Pesquisar---------->
    <form class="max-w-lg mx-auto mt-10" method="GET" action="{{ route('rental-items.index') }}">
        <div class="relative w-full">
            <label for="search"
                   class="mb-2 text-sm font-medium text-gray-900 sr-only dark:text-white">Pesquisar</label>
            <input type="search" id="search" name="search"
                   class="block p-2.5 w-full z-20 text-sm text-gray-900 bg-gray-50 rounded-lg border border-gray-300 focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:border-blue-500"
                   placeholder="Pesquisar por Nome, Preço, Status..." value="{{ request('search') }}" required/>
            <button type="submit"
                    class="absolute inset-y-0 right-0 p-2 text-sm font-medium text-white bg-blue-700 rounded-r-lg border border-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">
                <svg class="w-4 h-4" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none"
                     viewBox="0 0 20 20">
                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                          d="m19 19-4-4m0-7A7 7 0 1 1 1 8a7 7 0 0 1 14 0Z"/>
                </svg>
                <span class="sr-only">Pesquisar</span>
            </button>
            <button type="button"
                    onclick="document.getElementById('search').value=''; this.form.submit();"
                    class="absolute inset-y-0 right-8 p-2 text-sm font-medium text-red-500 hover:text-red-700 focus:outline-none focus:ring-0">
                <svg class="w-6 h-6 text-gray-800 dark:text-white" aria-hidden="true"
                     xmlns="http://www.w3.org/2000/svg"
                     width="24" height="24" fill="none" viewBox="0 0 24 24">
                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                          d="M17.651 7.65a7.131 7.131 0 0 0-12.68 3.15M18.001 4v4h-4m-7.652 8.35a7.13 7.13 0 0 0 12.68-3.15M6 20v-4h4"/>
                </svg>
                <span class="sr-only">Limpar</span>
            </button>

        </div>
    </form>

    <!--------Tabela---------->
    <div class="relative overflow-x-auto shadow-md sm:rounded-lg p-8">
        <table class="w-full text-sm text-left rtl:text-right text-gray-500 dark:text-gray-400">
            <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
            <tr>
                <th scope="col" class="px-6 py-3">
                    Nome
                </th>
                <th scope="col" class="px-6 py-3">
                    Proprietário
                </th>
                <th scope="col" class="px-6 py-3">
                    Preço por hora
                </th>
                <th scope="col" class="px-6 py-3">
                    Ações
                </th>
            </tr>
            </thead>
            <tbody>
            @foreach($rentalItems as $rentalItem)
                <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700 hover:bg-gray-50 dark:hover:bg-gray-600">
                    <th scope="row" class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                        {{ $rentalItem->name }}
                    </th>
                    <td class="px-6 py-4">
                        {{ $rentalItem->user?->name ?? 'N/A' }}
                    </td>
                    <td class="px-6 py-4">
                        {{'R$ ' . $rentalItem->price_per_hour ?? 'N/A' }}
                    </td>

                    <td class="flex items-center px-6 py-4 space-x-2">
                        <!-- View Modal -->
                        <button data-modal-target="view-modal" data-modal-toggle="view-modal"
                                class="cursor-pointer view-item-btn" data-id="{{ $rentalItem->id }}">
                            <x-icons.eye/>
                        </button>
                        <!-- Delete Modal -->
                        <button data-modal-target="delete-modal" data-modal-toggle="delete-modal"
                                class="delete-item-btn block text-red-500 rounded-lg text-sm px-5 py-2.5 text-center dark:focus:ring-blue-800"
                                data-id="{{ $rentalItem->id }}" type="button">
                            <x-icons.trash/>
                        </button>

                        <!-- Edit Modal -->
                        <button data-modal-target="edit-modal" data-modal-toggle="edit-modal"
                                class="edit-item-btn font-medium text-blue-600 dark:text-blue-500 hover:underline"
                                data-id="{{ $rentalItem->id }}" type="button">
                            <x-icons.edit/>
                        </button>

                    </td>
                </tr>
            @endforeach
            </tbody>
        </table>

        <div class="my-4">
            {{$rentalItems->links()}}
        </div>


        @include('rental-items.modal.register-modal')
        @include('rental-items.modal.delete-modal')
        @include('rental-items.modal.view-modal')
        @include('rental-items.modal.update-modal')
        @vite('resources/js/rental-items.js')
    </div>
</x-app-layout>
