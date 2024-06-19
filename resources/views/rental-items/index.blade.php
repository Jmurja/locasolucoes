<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Items de Locação') }}
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
                        {{ $rentalItem->price_per_hour ?? 'N/A' }}
                    </td>
                    <td class="px-6 py-4">
                        {{ $rentalItem->price_per_day ?? 'N/A' }}
                    </td>
                    <td class="px-6 py-4">
                        {{ $rentalItem->price_per_month ?? 'N/A' }}
                    </td>
                    <td class="px-6 py-4">
                        {{ $rentalItem->status }}
                    </td>
                    <td class="flex items-center px-6 py-4 space-x-2">
                        <a href="{{route('rental-items.show', $rentalItem->id ) }}" class="cursor-pointer">
                            <x-icons.eye/>
                        </a>

                        <form action="{{route('rental-items.destroy', $rentalItem->id )}}" method="post"
                              class="flex items-center">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="cursor-pointer text-red-500">
                                <x-icons.trash/>
                            </button>
                        </form>

                        <a href="{{route('rental-items.edit', $rentalItem->id)}}"
                           class="font-medium text-blue-600 dark:text-blue-500 hover:underline">
                            <x-icons.edit/>
                        </a>
                    </td>
                </tr>
            @endforeach
            </tbody>
        </table>
        <div class="my-4">
            {{$rentalItems->links()}}
            <a href="{{route('rental-items.create', $rentalItems)}}"
               class="text-blue-700 hover:text-white border border-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center me-2 mb-2 dark:border-blue-500 dark:text-blue-500 dark:hover:text-white dark:hover:bg-blue-500 dark:focus:ring-blue-800">Cadastrar
                Novo Usuário</a>
        </div>


</x-app-layout>
