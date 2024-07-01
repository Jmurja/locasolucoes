<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Itens de Locação') }}
        </h2>

    </x-slot>


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
                    Preço por dia
                </th>
                <th scope="col" class="px-6 py-3">
                    Preço por mês
                </th>
                <th scope="col" class="px-6 py-3">
                    Status
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
                    <td class="px-6 py-4">
                        {{'R$ ' . $rentalItem->price_per_day ?? 'N/A' }}
                    </td>
                    <td class="px-6 py-4">
                        {{'R$ ' . $rentalItem->price_per_month ?? 'N/A' }}
                    </td>
                    <td class="px-6 py-4">
                        {{ $rentalItem->status }}
                    </td>

                    <td class="flex items-center px-6 py-4 space-x-2">
                        <!-- View Modal -->
                        <button data-modal-target="view-modal" data-modal-toggle="view-modal"
                                class="cursor-pointer view-item-btn" data-id="{{ $rentalItem->id }}">
                            <x-icons.eye/>
                        </button>
                        <!-- Delete Modal -->
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


        <!-- Cadastrar modal -->
        <button data-modal-target="register-item" data-modal-toggle="register-item"
                class="block text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800"
                type="button">
            Cadastrar Item de Locação
        </button>

    @include('rental-items.modal.register-modal')
    @include('rental-items.modal.delete-modal')
    @include('rental-items.modal.view-modal')
    @include('rental-items.modal.update-modal')
    @vite('resources/js/rental-items.js')

</x-app-layout>
