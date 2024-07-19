<!-- Main modal -->
<div id="register-item" tabindex="-1" aria-hidden="true"
     class="hidden overflow-y-auto overflow-x-hidden fixed top-0 right-0 left-0 z-50 justify-center items-center w-full md:inset-0 h-[calc(100%-1rem)] max-h-full">
    <div class="relative p-4 w-full max-w-2xl max-h-full">
        <!-- Modal content -->
        <div class="relative bg-white rounded-lg shadow dark:bg-gray-700">
            <!-- Modal header -->
            <div class="flex items-center justify-between p-4 md:p-5 border-b rounded-t dark:border-gray-600">
                <h3 class="text-lg font-semibold text-gray-900 dark:text-white">Criar Novo Item de Locação</h3>
                <button type="button"
                        class="text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm w-8 h-8 ms-auto inline-flex justify-center items-center dark:hover:bg-gray-600 dark:hover:text-white"
                        data-modal-toggle="register-item">
                    <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none"
                         viewBox="0 0 14 14">
                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"
                              stroke-width="2" d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6"/>
                    </svg>
                    <span class="sr-only">Fechar Modal</span>
                </button>
            </div>

            <!-- Modal body -->
            <form action="{{route('rental-items.store')}}" method="post" class="p-4 md:p-5" id="rental-form">
                @csrf
                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                    <div class="mb-4">
                        <label for="user_id"
                               class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Selecione o
                            Responsável</label>
                        <select id="user_id" name="user_id"
                                class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500"
                                required>
                            <option disabled selected>Selecione o Responsável</option>
                            @foreach($landLordUsers as $landLordUser)
                                <option value="{{$landLordUser->id}}">{{$landLordUser->name}}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="mb-4">
                        <label for="name"
                               class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Nome</label>
                        <input type="text" name="name" id="name"
                               class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500"
                               placeholder="Digite o nome" required>
                        <small id="name-error" class="text-red-500 text-xs hidden">Nome é obrigatório e deve ter pelo
                            menos 3 caracteres.</small>
                    </div>
                    <div class="mb-4">
                        <label for="description"
                               class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Descrição</label>
                        <textarea name="description" id="description"
                                  class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500"
                                  placeholder="Digite a descrição" required></textarea>
                        <small id="description-error" class="text-red-500 text-xs hidden">Descrição é obrigatória e deve
                            ter pelo menos 5 caracteres.</small>
                    </div>
                    <div class="mb-4">
                        <label for="price_per_hour"
                               class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Valor por
                            hora</label>
                        <input type="text" name="price_per_hour" id="price_per_hour"
                               class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500"
                               placeholder="Digite o valor por hora" required>
                        <small id="price-error-hour" class="text-red-500 text-xs hidden">Preço por hora é obrigatório e
                            deve ser válido.</small>
                    </div>
                    <div class="mb-4">
                        <label for="price_per_day"
                               class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Valor por
                            dia</label>
                        <input type="text" name="price_per_day" id="price_per_day"
                               class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500"
                               placeholder="Digite o valor por dia" required>
                        <small id="price-error-day" class="text-red-500 text-xs hidden">Preço por dia é obrigatório e
                            deve ser válido.</small>
                    </div>
                    <div class="mb-4">
                        <label for="price_per_month"
                               class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Valor por
                            mês</label>
                        <input type="text" name="price_per_month" id="price_per_month"
                               class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500"
                               placeholder="Digite o valor por mês" required>
                        <small id="price-error-month" class="text-red-500 text-xs hidden">Preço por mês é obrigatório e
                            deve ser válido.</small>
                    </div>
                    <div class="mb-4">
                        <label for="status"
                               class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Status</label>
                        <select id="status" name="status"
                                class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500"
                                required>
                            @foreach($statuses as $key => $status)
                                <option value="{{$status['value']}}">{{$status['label']}}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="mb-4">
                        <label for="rental_item_notes"
                               class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Observações</label>
                        <textarea name="rental_item_notes" id="rental_item_notes"
                                  class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500"
                                  placeholder="Digite as observações"></textarea>
                    </div>
                </div>
                <button type="submit"
                        class="text-white inline-flex items-center bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">
                    Salvar
                </button>
            </form>
        </div>
    </div>
</div>
