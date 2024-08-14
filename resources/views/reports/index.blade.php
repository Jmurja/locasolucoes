<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Digiplace</title>
</head>

<body class="min-h-screen flex flex-col bg-gray-100 dark:bg-gray-900">
<x-app-layout class="flex flex-col flex-1">
    <x-slot name="header">
        <h2 class="font-semibold text-2xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Relatórios') }}
        </h2>
    </x-slot>

    <div class="p-4 max-w-4xl mx-auto mt-10 bg-white dark:bg-gray-800 rounded-3xl shadow-xl">
        <form action="{{ route('reports.index') }}" method="get">
            @csrf

            <div class="space-y-8">
                <div>
                    <h3 class="text-lg font-medium text-gray-900 dark:text-white">
                        Filtros de Pesquisa
                    </h3>
                    <p class="text-sm text-gray-500 dark:text-gray-400">
                        Utilize os filtros abaixo para refinar os resultados.
                    </p>
                </div>

                <div class="grid grid-cols-1 sm:grid-cols-2 gap-6">
                    <div class="col-span-1">
                        <label for="start_date" class="block text-sm font-semibold text-gray-700 dark:text-white">
                            Data de Início
                        </label>
                        <div class="relative mt-2">
                            <div class="absolute inset-y-0 left-0 flex items-center pl-3 pointer-events-none">
                                <svg class="w-5 h-5 text-gray-400 dark:text-gray-500" aria-hidden="true"
                                     xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 20 20">
                                    <path
                                        d="M20 4a2 2 0 0 0-2-2h-2V1a1 1 0 0 0-2 0v1h-3V1a1 1 0 0 0-2 0v1H6V1a1 1 0 0 0-2 0v1H2a2 2 0 0 0-2 2v2h20V4ZM0 18a2 2 0 0 0 2 2h16a2 2 0 0 0 2-2V8H0v10Zm5-8h10a1 1 0 0 1 0 2H5a1 1 0 0 1 0-2Z"/>
                                </svg>
                            </div>
                            <input id="start_date" name="start_date" type="text" autocomplete="off"
                                   class="datepicker-custom bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-600 focus:border-blue-600 block w-full pl-10 p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-500 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                                   placeholder="Selecione a data de início">
                        </div>
                    </div>

                    <div class="col-span-1">
                        <label for="end_date" class="block text-sm font-semibold text-gray-700 dark:text-white">
                            Data de Término
                        </label>
                        <div class="relative mt-2">
                            <div class="absolute inset-y-0 left-0 flex items-center pl-3 pointer-events-none">
                                <svg class="w-5 h-5 text-gray-400 dark:text-gray-500" aria-hidden="true"
                                     xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 20 20">
                                    <path
                                        d="M20 4a2 2 0 0 0-2-2h-2V1a1 1 0 0 0-2 0v1h-3V1a1 1 0 0 0-2 0v1H6V1a1 1 0 0 0-2 0v1H2a2 2 0 0 0-2 2v2h20V4ZM0 18a2 2 0 0 0 2 2h16a2 2 0 0 0 2-2V8H0v10Zm5-8h10a1 1 0 0 1 0 2H5a1 1 0 0 1 0-2Z"/>
                                </svg>
                            </div>
                            <input id="end_date" name="end_date" type="text" autocomplete="off"
                                   class="datepicker-custom bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-600 focus:border-blue-600 block w-full pl-10 p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-500 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                                   placeholder="Selecione a data de término">
                        </div>
                    </div>

                    <div class="col-span-1">
                        <label for="user_id" class="block text-sm font-semibold text-gray-700 dark:text-white">
                            Responsável
                        </label>
                        <select name="user_id" id="user_id"
                                class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-600 focus:border-blue-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-500 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500 mt-2">
                            <option value="" selected>Selecione o Responsável</option>
                            @foreach($users as $user)
                                <option value="{{ $user->id }}">{{ $user->name }}</option>
                            @endforeach
                        </select>
                    </div>

                    <div class="col-span-1">
                        <label for="rental_item_id" class="block text-sm font-semibold text-gray-700 dark:text-white">
                            Sala
                        </label>
                        <select name="rental_item_id" id="rental_item_id"
                                class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-600 focus:border-blue-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-500 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500 mt-2">
                            <option value="" selected>Selecione a Sala</option>
                            @foreach($rentalItems as $rentalItem)
                                <option value="{{ $rentalItem->id }}">{{ $rentalItem->name }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>

                <div class="grid grid-cols-2 gap-6 mt-8">
                    <button type="submit"
                            class="inline-flex items-center justify-center w-full text-white bg-blue-300 hover:bg-blue-400 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-6 py-2.5 dark:bg-blue-500 dark:hover:bg-blue-800 dark:focus:ring-blue-800 transition ease-in-out duration-150">
                        Aplicar Filtros
                    </button>
                    <a href="{{ route('pdf.reports', ['start_date' => request('start_date'), 'end_date' => request('end_date'), 'user_id' => request('user_id'), 'rental_item_id' => request('rental_item_id')]) }}"
                       class="inline-flex items-center justify-center w-full text-white bg-gray-600 hover:bg-gray-700 focus:ring-4 focus:outline-none focus:ring-gray-300 font-medium rounded-lg text-sm px-6 py-2.5 dark:bg-gray-500 dark:hover:bg-gray-600 dark:focus:ring-gray-800 transition ease-in-out duration-150">
                        Gerar PDF
                        <svg class="w-6 h-6 ml-2 text-gray-800 dark:text-white" aria-hidden="true"
                             xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="none" viewBox="0 0 24 24">
                            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                  d="M5 17v-5h1.5a1.5 1.5 0 1 1 0 3H5m12 2v-5h2m-2 3h2M5 10V7.914a1 1 0 0 1 .293-.707l3.914-3.914A1 1 0 0 1 9.914 3H18a1 1 0 0 1 1 1v6M5 19v1a1 1 0 0 0 1 1h12a1 1 0 0 0 1-1v-1M10 3v4a1 1 0 0 1-1 1H5m6 4v5h1.375A1.627 1.627 0 0 0 14 15.375v-1.75A1.627 1.627 0 0 0 12.375 12H11Z"/>
                        </svg>
                    </a>
                </div>
            </div>
        </form>
    </div>

    <div class="relative overflow-x-auto shadow-md sm:rounded-lg mt-10 p-6 bg-white dark:bg-gray-800">
        <table class="w-full text-sm text-left text-gray-600 dark:text-gray-400">
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
            </tr>
            </thead>
            <tbody>
            @forelse($reserves as $reserve)
                <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700 hover:bg-gray-50 dark:hover:bg-gray-600">
                    <td class="px-6 py-4 font-medium text-gray-900 dark:text-white">
                        {{ $reserve->user->name ?? 'N/A'}}
                    </td>
                    <td class="px-6 py-4">
                        {{ $reserve->rentalitem->name ?? 'N/A'}}
                    </td>
                    <td class="px-6 py-4">
                        {{ \Carbon\Carbon::parse($reserve->start_date)->format('d/m/Y - H:i') }}
                    </td>
                    <td class="px-6 py-4">
                        {{ \Carbon\Carbon::parse($reserve->end_date)->format('d/m/Y - H:i') }}
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="4" class="text-center py-4 text-gray-500 dark:text-gray-400">Nenhuma Reserva
                        Cadastrada
                    </td>
                </tr>
            @endforelse
            </tbody>
        </table>
    </div>
</x-app-layout>
@vite('resources/js/datepicker.js')

</body>
</html>
