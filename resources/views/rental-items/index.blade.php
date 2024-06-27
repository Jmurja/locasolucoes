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
                        <a href="{{route('rental-items.show', $rentalItem->id ) }}" class="cursor-pointer">
                            <x-icons.eye/>
                        </a>

                        <button data-modal-target="popup-modal" data-modal-toggle="popup-modal"
                                class="block text-red-500 rounded-lg text-sm px-5 py-2.5 text-center dark:focus:ring-blue-800"
                                type="button">
                            <x-icons.trash/>
                        </button>

                        <div id="popup-modal" tabindex="-1"
                             class="hidden overflow-y-auto overflow-x-hidden fixed top-0 right-0 left-0 z-50 justify-center items-center w-full md:inset-0 h-[calc(100%-1rem)] max-h-full">
                            <div class="relative p-4 w-full max-w-md max-h-full">
                                <div class="relative bg-white rounded-lg shadow dark:bg-gray-700">
                                    <button type="button"
                                            class="absolute top-3 end-2.5 text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm w-8 h-8 ms-auto inline-flex justify-center items-center dark:hover:bg-gray-600 dark:hover:text-white"
                                            data-modal-hide="popup-modal">
                                        <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg"
                                             fill="none" viewBox="0 0 14 14">
                                            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"
                                                  stroke-width="2" d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6"/>
                                        </svg>
                                        <span class="sr-only">Close modal</span>
                                    </button>
                                    <div class="p-4 md:p-5 text-center">
                                        <svg class="mx-auto mb-4 text-gray-400 w-12 h-12 dark:text-gray-200"
                                             aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none"
                                             viewBox="0 0 20 20">
                                            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"
                                                  stroke-width="2"
                                                  d="M10 11V6m0 8h.01M19 10a9 9 0 1 1-18 0 9 9 0 0 1 18 0Z"/>
                                        </svg>
                                        <h3 class="mb-5 text-lg font-normal text-gray-500 dark:text-gray-400">Você
                                            deseja
                                            deletar este item?</h3>
                                        <form action="{{route('rental-items.destroy', $rentalItem->id )}}" method="post"
                                              class="flex items-center justify-center space-x-3">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit"
                                                    class="text-white bg-red-600 hover:bg-red-800 focus:ring-4 focus:outline-none focus:ring-red-300 dark:focus:ring-red-800 font-medium rounded-lg text-sm inline-flex items-center px-5 py-2.5 text-center">
                                                Sim, Desejo
                                            </button>
                                            <button data-modal-hide="popup-modal" type="button"
                                                    class="py-2.5 px-5 text-sm font-medium text-gray-900 focus:outline-none bg-white rounded-lg border border-gray-200 hover:bg-gray-100 hover:text-blue-700 focus:z-10 focus:ring-4 focus:ring-gray-100 dark:focus:ring-gray-700 dark:bg-gray-800 dark:text-gray-400 dark:border-gray-600 dark:hover:text-white dark:hover:bg-gray-700">
                                                Cancelar
                                            </button>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>


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
        </div>


        <button data-modal-target="crud-modal" data-modal-toggle="crud-modal"
                class="block text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800"
                type="button">
            Cadastrar Item de Locação
        </button>


        <!-- Main modal -->
        <div id="crud-modal" tabindex="-1" aria-hidden="true"
             class="hidden overflow-y-auto overflow-x-hidden fixed top-0 right-0 left-0 z-50 justify-center items-center w-full md:inset-0 h-[calc(100%-1rem)] max-h-full">
            <div class="relative p-4 w-full max-w-md max-h-full">
                <!-- Modal content -->
                <div class="relative bg-white rounded-lg shadow dark:bg-gray-700">
                    <!-- Modal header -->
                    <div class="flex items-center justify-between p-4 md:p-5 border-b rounded-t dark:border-gray-600">
                        <h3 class="text-lg font-semibold text-gray-900 dark:text-white">Criar Novo Produto</h3>
                        <button type="button"
                                class="text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm w-8 h-8 ms-auto inline-flex justify-center items-center dark:hover:bg-gray-600 dark:hover:text-white"
                                data-modal-toggle="crud-modal">
                            <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none"
                                 viewBox="0 0 14 14">
                                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"
                                      stroke-width="2" d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6"/>
                            </svg>
                            <span class="sr-only">Fechar Modal</span>
                        </button>
                    </div>


                    <!-- Modal body -->
                    <div class="max-w-md mx-auto sm:px-6 lg:p-8 mt-8 bg-slate-800">
                        <form action="{{route('rental-items.store')}}" method="post" class="max-w-md mx-auto"
                              id="rental-form">
                            @csrf
                            <div class="relative z-0 w-full mb-5 group">
                                <label for="user_id" class="sr-only">Underline select</label>
                                <select id="user_id" name="user_id"
                                        class="block py-2.5 px-0 w-full text-sm text-gray-500 bg-transparent border-0 border-b-2 border-gray-200 appearance-none dark:text-gray-400 dark:border-gray-700 focus:outline-none focus:ring-0 focus:border-gray-200 peer">
                                    @foreach($landLordUsers as $landLordUser)
                                        <option value="{{$landLordUser->id}}">{{$landLordUser->name}}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="relative z-0 w-full mb-5 group">
                                <input type="text" name="name" id="name"
                                       class="block py-2.5 px-0 w-full text-sm text-gray-900 bg-transparent border-0 border-b-2 border-gray-300 appearance-none dark:text-white dark:border-gray-600 dark:focus:border-blue-500 focus:outline-none focus:ring-0 focus:border-blue-600 peer"
                                       placeholder=" "/>
                                <label for="name"
                                       class="peer-focus:font-medium absolute text-sm text-gray-500 dark:text-gray-400 duration-300 transform -translate-y-6 scale-75 top-3 -z-10 origin-[0] peer-focus:start-0 rtl:peer-focus:translate-x-1/4 peer-focus:left-auto peer-focus:text-blue-600 peer-focus:dark:text-blue-500 peer-placeholder-shown:scale-100 peer-placeholder-shown:translate-y-0 peer-focus:scale-75 peer-focus:-translate-y-6">
                                    Nome
                                </label>
                                <span id="name-error" class="text-red-500 text-sm hidden">Nome é obrigatório e deve ter pelo menos 3 caracteres.</span>
                            </div>
                            <div class="relative z-0 w-full mb-5 group">
            <textarea name="description" id="description"
                      class="block py-2.5 px-0 w-full text-sm text-gray-900 bg-transparent border-0 border-b-2 border-gray-300 appearance-none dark:text-white dark:border-gray-600 dark:focus:border-blue-500 focus:outline-none focus:ring-0 focus:border-blue-600 peer"
                      placeholder=" "></textarea>
                                <label for="description"
                                       class="peer-focus:font-medium absolute text-sm text-gray-500 dark:text-gray-400 duration-300 transform -translate-y-6 scale-75 top-3 -z-10 origin-[0] peer-focus:start-0 rtl:peer-focus:translate-x-1/4 peer-focus:left-auto peer-focus:text-blue-600 peer-focus:dark:text-blue-500 peer-placeholder-shown:scale-100 peer-placeholder-shown:translate-y-0 peer-focus:scale-75 peer-focus:-translate-y-6">
                                    Descrição
                                </label>
                                <span id="description-error" class="text-red-500 text-sm hidden">Descrição é obrigatória e deve ter pelo menos 5 caracteres.</span>
                            </div>
                            <div class="relative z-0 w-full mb-5 group">
                                <input type="text" name="price_per_hour" id="price_per_hour"
                                       class="block py-2.5 px-0 w-full text-sm text-gray-900 bg-transparent border-0 border-b-2 border-gray-300 appearance-none dark:text-white dark:border-gray-600 dark:focus:border-blue-500 focus:outline-none focus:ring-0 focus:border-blue-600 peer"
                                       placeholder=" "/>
                                <label for="price_per_hour"
                                       class="peer-focus:font-medium absolute text-sm text-gray-500 dark:text-gray-400 duration-300 transform -translate-y-6 scale-75 top-3 -z-10 origin-[0] peer-focus:start-0 rtl:peer-focus:translate-x-1/4 peer-focus:left-auto peer-focus:text-blue-600 peer-focus:dark:text-blue-500 peer-placeholder-shown:scale-100 peer-placeholder-shown:translate-y-0 peer-focus:scale-75 peer-focus:-translate-y-6">
                                    Valor por hora
                                </label>
                                <span id="price_per_hour-error" class="text-red-500 text-sm hidden">Valor por hora deve ser um número.</span>
                            </div>
                            <div class="relative z-0 w-full mb-5 group">
                                <input type="text" name="price_per_day" id="price_per_day"
                                       class="block py-2.5 px-0 w-full text-sm text-gray-900 bg-transparent border-0 border-b-2 border-gray-300 appearance-none dark:text-white dark:border-gray-600 dark:focus:border-blue-500 focus:outline-none focus:ring-0 focus:border-blue-600 peer"
                                       placeholder=" "/>
                                <label for="price_per_day"
                                       class="peer-focus:font-medium absolute text-sm text-gray-500 dark:text-gray-400 duration-300 transform -translate-y-6 scale-75 top-3 -z-10 origin-[0] peer-focus:start-0 rtl:peer-focus:translate-x-1/4 peer-focus:left-auto peer-focus:text-blue-600 peer-focus:dark:text-blue-500 peer-placeholder-shown:scale-100 peer-placeholder-shown:translate-y-0 peer-focus:scale-75 peer-focus:-translate-y-6">
                                    Valor por dia
                                </label>
                                <span id="price_per_day-error" class="text-red-500 text-sm hidden">Valor por dia deve ser um número.</span>
                            </div>
                            <div class="relative z-0 w-full mb-5 group">
                                <input type="text" name="price_per_month" id="price_per_month"
                                       class="block py-2.5 px-0 w-full text-sm text-gray-900 bg-transparent border-0 border-b-2 border-gray-300 appearance-none dark:text-white dark:border-gray-600 dark:focus:border-blue-500 focus:outline-none focus:ring-0 focus:border-blue-600 peer"
                                       placeholder=" "/>
                                <label for="price_per_month"
                                       class="peer-focus:font-medium absolute text-sm text-gray-500 dark:text-gray-400 duration-300 transform -translate-y-6 scale-75 top-3 -z-10 origin-[0] peer-focus:start-0 rtl:peer-focus:translate-x-1/4 peer-focus:left-auto peer-focus:text-blue-600 peer-focus:dark:text-blue-500 peer-placeholder-shown:scale-100 peer-placeholder-shown:translate-y-0 peer-focus:scale-75 peer-focus:-translate-y-6">
                                    Valor por mês
                                </label>
                                <span id="price_per_month-error" class="text-red-500 text-sm hidden">Valor por mês deve ser um número.</span>
                            </div>
                            <div class="relative z-0 w-full mb-5 group">
                                <label for="status" class="sr-only">Underline select</label>
                                <select id="status" name="status"
                                        class="block py-2.5 px-0 w-full text-sm text-gray-500 bg-transparent border-0 border-b-2 border-gray-200 appearance-none dark:text-gray-400 dark:border-gray-700 focus:outline-none focus:ring-0 focus:border-gray-200 peer">
                                    <option selected>Status</option>
                                    <option value="1">Disponível</option>
                                    <option value="2">Reservado</option>
                                    <option value="3">Manutenção</option>
                                </select>
                            </div>
                            <div class="relative z-0 w-full mb-5 group">
            <textarea name="rental_item_notes" id="rental_item_notes"
                      class="block py-2.5 px-0 w-full text-sm text-gray-900 bg-transparent border-0 border-b-2 border-gray-300 appearance-none dark:text-white dark:border-gray-600 dark:focus:border-blue-500 focus:outline-none focus:ring-0 focus:border-blue-600 peer"
                      placeholder=" "></textarea>
                                <label for="rental_item_notes"
                                       class="peer-focus:font-medium absolute text-sm text-gray-500 dark:text-gray-400 duration-300 transform -translate-y-6 scale-75 top-3 -z-10 origin-[0] peer-focus:start-0 rtl:peer-focus:translate-x-1/4 peer-focus:left-auto peer-focus:text-blue-600 peer-focus:dark:text-blue-500 peer-placeholder-shown:scale-100 peer-placeholder-shown:translate-y-0 peer-focus:scale-75 peer-focus:-translate-y-6">
                                    Observações
                                </label>
                            </div>
                            <span id="value-error" class="text-red-500 text-sm hidden block mb-4">Pelo menos um valor deve ser preenchido.</span>
                            <button type="submit"
                                    class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm w-full sm:w-auto px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">
                                Salvar
                            </button>
                        </form>
                    </div>

                    <script>
                        function validateName() {
                            const name = document.getElementById('name').value;
                            const nameError = document.getElementById('name-error');
                            if (name.trim() === '' || name.length < 3) {
                                nameError.classList.remove('hidden');
                            } else {
                                nameError.classList.add('hidden');
                            }
                        }

                        function validateDescription() {
                            const description = document.getElementById('description').value;
                            const descriptionError = document.getElementById('description-error');
                            if (description.trim() === '' || description.length < 5) {
                                descriptionError.classList.remove('hidden');
                            } else {
                                descriptionError.classList.add('hidden');
                            }
                        }

                        function validatePrice(field) {
                            const price = document.getElementById(field).value;
                            const priceError = document.getElementById(`${field}-error`);
                            if (price.trim() !== '' && isNaN(price)) {
                                priceError.classList.remove('hidden');
                            } else {
                                priceError.classList.add('hidden');
                            }
                        }

                        function validateValues() {
                            const pricePerHour = document.getElementById('price_per_hour').value;
                            const pricePerDay = document.getElementById('price_per_day').value;
                            const pricePerMonth = document.getElementById('price_per_month').value;
                            const valueError = document.getElementById('value-error');

                            if (pricePerHour.trim() === '' && pricePerDay.trim() === '' && pricePerMonth.trim() === '') {
                                valueError.classList.remove('hidden');
                            } else {
                                valueError.classList.add('hidden');
                            }
                        }

                        document.getElementById('name').addEventListener('input', validateName);
                        document.getElementById('name').addEventListener('blur', validateName);

                        document.getElementById('description').addEventListener('input', validateDescription);
                        document.getElementById('description').addEventListener('blur', validateDescription);

                        document.getElementById('price_per_hour').addEventListener('input', () => {
                            validatePrice('price_per_hour');
                            validateValues();
                        });
                        document.getElementById('price_per_hour').addEventListener('blur', () => {
                            validatePrice('price_per_hour');
                            validateValues();
                        });

                        document.getElementById('price_per_day').addEventListener('input', () => {
                            validatePrice('price_per_day');
                            validateValues();
                        });
                        document.getElementById('price_per_day').addEventListener('blur', () => {
                            validatePrice('price_per_day');
                            validateValues();
                        });

                        document.getElementById('price_per_month').addEventListener('input', () => {
                            validatePrice('price_per_month');
                            validateValues();
                        });
                        document.getElementById('price_per_month').addEventListener('blur', () => {
                            validatePrice('price_per_month');
                            validateValues();
                        });

                        document.getElementById('rental-form').addEventListener('submit', function (event) {
                            validateValues();
                            const valueError = document.getElementById('value-error');
                            if (!valueError.classList.contains('hidden')) {
                                event.preventDefault();
                            }
                        });
                    </script>


                </div>
</x-app-layout>
