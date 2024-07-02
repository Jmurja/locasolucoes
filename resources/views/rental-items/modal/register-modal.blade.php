<!-- Main modal -->
<div id="register-item" tabindex="-1" aria-hidden="true"
     class="hidden overflow-y-auto overflow-x-hidden fixed top-0 right-0 left-0 z-50 flex justify-center items-center w-full md:inset-0 h-[calc(100%-1rem)] max-h-full">
    <div class="relative p-4 w-full max-w-md max-h-full">
        <!-- Modal content -->
        <div class="relative bg-white rounded-lg shadow dark:bg-gray-700">
            <!-- Modal header -->
            <div class="flex items-center justify-between p-4 md:p-5 border-b rounded-t dark:border-gray-600">
                <h3 class="text-lg font-semibold text-gray-900 dark:text-white">Criar Novo Produto</h3>
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
            <div class="p-6 bg-slate-800 rounded-b-lg">
                <form action="{{route('rental-items.store')}}" method="post" class="space-y-5" id="rental-form">
                    @csrf
                    <div class="relative z-0 w-full group">
                        <select id="user_id" name="user_id"
                                class="block py-2.5 px-0 w-full text-sm text-gray-500 bg-transparent border-0 border-b-2 border-gray-200 appearance-none dark:text-gray-400 dark:border-gray-700 focus:outline-none focus:ring-0 focus:border-blue-600 peer">
                            <option disabled selected>Selecione o Responsável</option>
                            @foreach($landLordUsers as $landLordUser)
                                <option value="{{$landLordUser->id}}">{{$landLordUser->name}}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="relative z-0 w-full group">
                        <input type="text" name="name" id="name"
                               class="block py-2.5 px-0 w-full text-sm text-gray-900 bg-transparent border-0 border-b-2 border-gray-300 appearance-none dark:text-white dark:border-gray-600 focus:outline-none focus:ring-0 focus:border-blue-600 peer"
                               placeholder=" " required/>
                        <label for="name"
                               class="absolute text-sm text-gray-500 dark:text-gray-400 duration-300 transform -translate-y-6 scale-75 top-3 -z-10 origin-[0] peer-focus:left-0 peer-focus:text-blue-600 peer-focus:dark:text-blue-500 peer-placeholder-shown:scale-100 peer-placeholder-shown:translate-y-0 peer-focus:scale-75 peer-focus:-translate-y-6">
                            Nome
                        </label>
                        <span id="name-error" class="text-red-500 text-sm hidden">Nome é obrigatório e deve ter pelo menos 3 caracteres.</span>
                    </div>
                    <div class="relative z-0 w-full group">
                        <textarea name="description" id="description"
                                  class="block py-2.5 px-0 w-full text-sm text-gray-900 bg-transparent border-0 border-b-2 border-gray-300 appearance-none dark:text-white dark:border-gray-600 focus:outline-none focus:ring-0 focus:border-blue-600 peer"
                                  placeholder=" " required></textarea>
                        <label for="description"
                               class="absolute text-sm text-gray-500 dark:text-gray-400 duration-300 transform -translate-y-6 scale-75 top-3 -z-10 origin-[0] peer-focus:left-0 peer-focus:text-blue-600 peer-focus:dark:text-blue-500 peer-placeholder-shown:scale-100 peer-placeholder-shown:translate-y-0 peer-focus:scale-75 peer-focus:-translate-y-6">
                            Descrição
                        </label>
                        <span id="description-error" class="text-red-500 text-sm hidden">Descrição é obrigatória e deve ter pelo menos 5 caracteres.</span>
                    </div>
                    <div class="relative z-0 w-full group">
                        <input type="text" name="price_per_hour" id="price_per_hour"
                               class="block py-2.5 px-0 w-full text-sm text-gray-900 bg-transparent border-0 border-b-2 border-gray-300 appearance-none dark:text-white dark:border-gray-600 focus:outline-none focus:ring-0 focus:border-blue-600 peer"
                               placeholder=" " required/>
                        <label for="price_per_hour"
                               class="absolute text-sm text-gray-500 dark:text-gray-400 duration-300 transform -translate-y-6 scale-75 top-3 -z-10 origin-[0] peer-focus:left-0 peer-focus:text-blue-600 peer-focus:dark:text-blue-500 peer-placeholder-shown:scale-100 peer-placeholder-shown:translate-y-0 peer-focus:scale-75 peer-focus:-translate-y-6">
                            Valor por hora
                        </label>
                        <span id="price_per_hour-error" class="text-red-500 text-sm hidden">Valor por hora deve ser um número.</span>
                    </div>
                    <div class="relative z-0 w-full group">
                        <input type="text" name="price_per_day" id="price_per_day"
                               class="block py-2.5 px-0 w-full text-sm text-gray-900 bg-transparent border-0 border-b-2 border-gray-300 appearance-none dark:text-white dark:border-gray-600 focus:outline-none focus:ring-0 focus:border-blue-600 peer"
                               placeholder=" " required/>
                        <label for="price_per_day"
                               class="absolute text-sm text-gray-500 dark:text-gray-400 duration-300 transform -translate-y-6 scale-75 top-3 -z-10 origin-[0] peer-focus:left-0 peer-focus:text-blue-600 peer-focus:dark:text-blue-500 peer-placeholder-shown:scale-100 peer-placeholder-shown:translate-y-0 peer-focus:scale-75 peer-focus:-translate-y-6">
                            Valor por dia
                        </label>
                        <span id="price_per_day-error" class="text-red-500 text-sm hidden">Valor por dia deve ser um número.</span>
                    </div>
                    <div class="relative z-0 w-full group">
                        <input type="text" name="price_per_month" id="price_per_month"
                               class="block py-2.5 px-0 w-full text-sm text-gray-900 bg-transparent border-0 border-b-2 border-gray-300 appearance-none dark:text-white dark:border-gray-600 focus:outline-none focus:ring-0 focus:border-blue-600 peer"
                               placeholder=" " required/>
                        <label for="price_per_month"
                               class="absolute text-sm text-gray-500 dark:text-gray-400 duration-300 transform -translate-y-6 scale-75 top-3 -z-10 origin-[0] peer-focus:left-0 peer-focus:text-blue-600 peer-focus:dark:text-blue-500 peer-placeholder-shown:scale-100 peer-placeholder-shown:translate-y-0 peer-focus:scale-75 peer-focus:-translate-y-6">
                            Valor por mês
                        </label>
                        <span id="price_per_month-error" class="text-red-500 text-sm hidden">Valor por mês deve ser um número.</span>
                    </div>
                    <div class="relative z-0 w-full group">
                        <select id="status" name="status"
                                class="block py-2.5 px-0 w-full text-sm text-gray-500 bg-transparent border-0 border-b-2 border-gray-200 appearance-none dark:text-gray-400 dark:border-gray-700 focus:outline-none focus:ring-0 focus:border-blue-600 peer">
                            <option disabled selected>Status</option>
                            <option value="1">Disponível</option>
                            <option value="2">Reservado</option>
                            <option value="3">Manutenção</option>
                        </select>
                    </div>
                    <div class="relative z-0 w-full group">
                        <textarea name="rental_item_notes" id="rental_item_notes"
                                  class="block py-2.5 px-0 w-full text-sm text-gray-900 bg-transparent border-0 border-b-2 border-gray-300 appearance-none dark:text-white dark:border-gray-600 focus:outline-none focus:ring-0 focus:border-blue-600 peer"
                                  placeholder=" "></textarea>
                        <label for="rental_item_notes"
                               class="absolute text-sm text-gray-500 dark:text-gray-400 duration-300 transform -translate-y-6 scale-75 top-3 -z-10 origin-[0] peer-focus:left-0 peer-focus:text-blue-600 peer-focus:dark:text-blue-500 peer-placeholder-shown:scale-100 peer-placeholder-shown:translate-y-0 peer-focus:scale-75 peer-focus:-translate-y-6">
                            Observações
                        </label>
                    </div>
                    <span id="value-error" class="text-red-500 text-sm hidden block mb-4">Pelo menos um valor deve ser preenchido.</span>
                    <button type="submit"
                            class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm w-full sm:w-auto px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800 transition ease-in-out duration-150">
                        Salvar
                    </button>
                </form>
            </div>
        </div>
    </div>
</div>
