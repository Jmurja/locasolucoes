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
                    ID
                </th>
                <th scope="col" class="px-6 py-3">
                    Nome
                </th>
                <th scope="col" class="px-6 py-3">
                    Email
                </th>
                <th scope="col" class="px-6 py-3">
                    Telefone
                </th>
                <th scope="col" class="px-6 py-3">
                    CPF/CNPJ
                </th>
                <th scope="col" class="px-6 py-3">
                    Criado em
                </th>
                <th scope="col" class="px-6 py-3">
                    Atualizado em
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
                        {{ $user-> name }}
                    </td>
                    <td class="px-6 py-4">
                        {{ $user-> email }}
                    </td>
                    <td class="px-6 py-4">
                        {{ $user-> phone }}
                    </td>
                    <td class="px-6 py-4">
                        {{ $user->cpf_cnpj }}
                    </td>
                    <td class="px-6 py-4">
                        {{ $user->created_at }}
                    </td>
                    <td class="px-6 py-4">
                        {{ $user->updated_at }}
                    </td>

                    <td class="flex items-center px-6 py-4 space-x-2">
                        <a href="{{route('users.show', $user->id ) }}" class="cursor-pointer">
                            <x-icons.eye/>
                        </a>

                        <form action="{{route('users.destroy', $user->id )}}" method="post"
                              class="flex items-center">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="cursor-pointer text-red-500">
                                <x-icons.trash/>
                            </button>
                        </form>

                        <a href="{{route('users.edit', $user->id)}}"
                           class="font-medium text-blue-600 dark:text-blue-500 hover:underline">
                            <x-icons.edit/>
                        </a>
                    </td>
                </tr>
            @endforeach
            </tbody>
        </table>
        <div class="my-4">
            {{$users->links()}}
        </div>
        <a href="{{route('users.create', $user->id)}}" class="text-blue-700 hover:text-white border border-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center me-2 mb-2 dark:border-blue-500 dark:text-blue-500 dark:hover:text-white dark:hover:bg-blue-500 dark:focus:ring-blue-800">Cadastrar Novo Usuário</a>

    </div>



</x-app-layout>
