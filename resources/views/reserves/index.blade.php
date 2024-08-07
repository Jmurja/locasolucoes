<x-app-layout>
    <x-slot name="header">
        <div class="flex flex-col sm:flex-row justify-between items-center">
            <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight mb-4 sm:mb-0">
                {{ __('Reservas') }}
            </h2>
            @can('simple-user')
                <!-- Cadastrar modal -->
                <button data-modal-target="create-modal" data-modal-toggle="create-modal"
                        class="ml-8 block text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800"
                        type="button">
                    Cadastrar Reserva
                </button>
            @endcan
        </div>
    </x-slot>

    <script src="https://cdn.jsdelivr.net/npm/flowbite@2.4.1/dist/flowbite.min.js"></script>

    <!-- Search Form -->
    @can('simple-user')
        <form class="max-w-lg mx-auto mt-10" method="GET" action="{{ route('reserves.index') }}">
            <div class="relative w-full">
                <label for="search"
                       class="mb-2 text-sm font-medium text-gray-900 sr-only dark:text-white">Pesquisar</label>
                <input type="search" id="search" name="search"
                       class="block p-2.5 w-full z-20 text-sm text-gray-900 bg-gray-50 rounded-lg border border-gray-300 focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:border-blue-500"
                       placeholder="Pesquisar por Responsável, Usuário, Espaço, Data..." value="{{ request('search') }}"
                       required/>
                <div class="absolute inset-y-0 right-0 flex items-center space-x-1">
                    <button type="button"
                            onclick="document.getElementById('search').value=''; this.form.submit();"
                            class="p-2 text-sm font-medium hover:text-red-700 focus:outline-none focus:ring-0">
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
    @endcanany

    @if ($errors->any())
        <div
            class="max-w-lg mx-auto mt-4 p-4 mb-4 text-sm text-red-700 bg-red-100 rounded-lg dark:bg-red-200 dark:text-red-800"
            role="alert">
            @foreach ($errors->all() as $error)
                <p>{{ $error }}</p>
            @endforeach
        </div>
    @endif

    <div class="relative overflow-x-auto shadow-md sm:rounded-lg p-4 sm:p-8">
        <table class="w-full text-sm text-left rtl:text-right text-gray-500 dark:text-gray-400">
            <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
            <tr>
                <th scope="col" class="px-6 py-3">
                    Responsável
                </th>
                <th scope="col" class="px-6 py-3 hidden md:table-cell">
                    Título
                </th>
                <th scope="col" class="px-6 py-3">
                    Espaço
                </th>
                <th scope="col" class="px-6 py-3 hidden lg:table-cell">
                    Hora de Início
                </th>
                <th scope="col" class="px-6 py-3 hidden lg:table-cell">
                    Hora do Fim
                </th>
                <th scope="col" class="px-6 py-3 hidden xl:table-cell">
                    Status
                </th>
                @can('simple-user')
                    <th scope="col" class="px-6 py-3">
                        Ações
                    </th>
                @endcan
                @can('some-tenant')
                    <th scope="col" class="px-6 py-3">
                        Cancelar Reserva
                    </th>
                @endcan
            </tr>
            </thead>
            <tbody>
            @forelse($reserves as $reserve)
                <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700 hover:bg-gray-50 dark:hover:bg-gray-600">
                    <td class="px-6 py-4">
                        {{ $reserve->user->name ?? 'N/A'}}
                    </td>

                    <td class="px-6 py-4 hidden md:table-cell">
                        {{ $reserve->title ?? 'N/A'}}
                    </td>
                    <td class="px-6 py-4">
                        {{ $reserve->rentalitem->name ?? 'N/A'}}
                    </td>
                    <td class="px-6 py-4 hidden lg:table-cell">
                        {{ $reserve->start_date}}
                    </td>
                    <td class="px-6 py-4 hidden lg:table-cell">
                        {{ $reserve->end_date}}
                    </td>
                    <td class="px-6 py-4 hidden xl:table-cell">
                        {{ $reserve->reserve_status ?? 'N/A'}}
                    </td>
                    <td class="flex items-center px-6 py-4 space-x-2">
                        @can('simple-user')
                            <!-- View Button -->
                            <a href="{{ route('reserves.show', $reserve->id) }}"
                               class="cursor-pointer view-reserve-button">
                                <x-icons.eye/>
                            </a>

                        @endcan
                        <!-- Delete Modal -->
                        <button data-reserve-id="{{ $reserve->id }}"
                                class="delete-button block text-red-500 rounded-lg text-sm px-5 py-2.5 text-center dark:focus:ring-blue-800"
                                data-modal-target="delete-modal" data-modal-toggle="delete-modal" type="button">
                            <x-icons.trash/>
                        </button>
                        @can('simple-user')
                            <!-- Edit Modal -->
                            <button data-reserve-id="{{ $reserve->id }}"
                                    data-modal-target="edit-modal" data-modal-toggle="edit-modal"
                                    class="font-medium text-blue-600 dark:text-blue-500 hover:underline edit-reserve-button"
                                    type="button">
                                <x-icons.edit/>
                            </button>
                        @endcan
                    </td>
                </tr>
            @empty
                <div class="text-center text-white">Nenhuma Reserva Cadastrada</div>
            @endforelse

            </tbody>

        </table>

        <div class="my-4">
            {{ $reserves->links() }}
        </div>
    </div>
    @include('reserves.modal.create-modal')
    @include('reserves.modal.update-modal')
    @include('reserves.modal.delete-modal')
    @vite('resources/js/reserves.js')
    @vite('resources/js/datepicker.js')
</x-app-layout>
