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
                        <a href="{{route('reserves.show', $reserve->id ) }}" class="cursor-pointer">
                            <x-icons.eye/>
                        </a>

                        <form action="{{route('reserves.destroy', $reserve->id )}}" method="post"
                              class="flex items-center">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="cursor-pointer text-red-500">
                                <x-icons.trash/>
                            </button>
                        </form>

                        <a href="{{route('reserves.edit', $reserve->id)}}"
                           class="font-medium text-blue-600 dark:text-blue-500 hover:underline">
                            <x-icons.edit/>
                        </a>
                    </td>
                </tr>
            @empty
                <div class="text-center text-white">Nenhuma Reserva Cadastrada</div>
            @endforelse
            </tbody>
        </table>
        <div class="my-4">
            {{$reserves->links()}}
        </div>
        <a href="{{route('reserves.create', $reserves)}}"
           class="text-blue-700 hover:text-white border border-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center me-2 mb-2 dark:border-blue-500 dark:text-blue-500 dark:hover:text-white dark:hover:bg-blue-500 dark:focus:ring-blue-800">Fazer
            uma Reserva</a>
    </div>


</x-app-layout>
