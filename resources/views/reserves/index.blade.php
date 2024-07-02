<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Reservas') }}
        </h2>
    </x-slot>

    <div class="relative overflow-x-auto shadow-md sm:rounded-lg p-8">
        <table class="w-full text-sm text-left rtl:text-right text-gray-500 dark:text-gray-400">
            <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
            <tr>
                <th scope="col" class="px-6 py-3">
                    Responsável
                </th>
                <th scope="col" class="px-6 py-3">
                    Espaço
                </th>
                <th scope="col" class="px-6 py-3">
                    Hora de Início
                </th>
                <th scope="col" class="px-6 py-3">
                    Hora do Fim
                </th>
                <th scope="col" class="px-6 py-3">
                    Ações
                </th>
            </tr>
            </thead>
            <tbody>
            @forelse($reserves as $reserve)
                <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700 hover:bg-gray-50 dark:hover:bg-gray-600">
                    <td class="px-6 py-4">
                        {{ $reserve->user->name ?? 'N/A'}}
                    </td>
                    <td class="px-6 py-4">
                        {{ $reserve->rentalitem->name ?? 'N/A'}}
                    </td>
                    <td class="px-6 py-4">
                        {{ $reserve->start_date}}
                    </td>
                    <td class="px-6 py-4">
                        {{ $reserve->end_date}}
                    </td>
                    <td class="flex items-center px-6 py-4 space-x-2">

                        <!-- View Modal -->
                        <button data-reserve-id="{{ $reserve->id }}"
                                data-modal-target="view-modal" data-modal-toggle="view-modal"
                                class="cursor-pointer view-reserve-button">
                            <x-icons.eye/>
                        </button>

                        <!-- Delete Modal -->
                        <button data-reserve-id="{{ $reserve->id }}"
                                class="delete-button block text-red-500 rounded-lg text-sm px-5 py-2.5 text-center dark:focus:ring-blue-800"
                                data-modal-target="delete-modal" data-modal-toggle="delete-modal" type="button">
                            <x-icons.trash/>
                        </button>

                        <!-- Edit Modal -->
                        <button data-reserve-id="{{ $reserve->id }}"
                                data-modal-target="edit-modal" data-modal-toggle="edit-modal"
                                class="font-medium text-blue-600 dark:text-blue-500 hover:underline edit-reserve-button"
                                type="button">
                            <x-icons.edit/>
                        </button>
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

    <button data-modal-target="create-modal" data-modal-toggle="create-modal"
            class="ml-8 block text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800"
            type="button">
        Cadastrar Reserva
    </button>

    @include('reserves.modal.create-modal')
    @include('reserves.modal.update-modal')
    @include('reserves.modal.delete-modal')
    @include('reserves.modal.view-modal')
    @vite('resources/js/reserves.js')
</x-app-layout>
