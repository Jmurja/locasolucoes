<!-- Main modal -->
<div id="create-modal" tabindex="-1" aria-hidden="true"
     class="hidden overflow-y-auto overflow-x-hidden fixed top-0 right-0 left-0 z-50 flex justify-center items-center w-full md:inset-0 h-full bg-black bg-opacity-50">
    <div class="relative p-4 w-full max-w-2xl max-h-full">
        <!-- Modal content -->
        <div class="relative bg-white rounded-lg shadow dark:bg-gray-700">
            <!-- Modal header -->
            <div class="flex items-center justify-between p-4 md:p-5 border-b rounded-t dark:border-gray-600">
                <h3 class="text-lg font-semibold text-gray-900 dark:text-white">
                    Criar Nova Reserva
                </h3>
                <button type="button"
                        class="text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm w-8 h-8 ms-auto inline-flex justify-center items-center dark:hover:bg-gray-600 dark:hover:text-white"
                        data-modal-toggle="create-modal">
                    <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none"
                         viewBox="0 0 14 14">
                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"
                              stroke-width="2" d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6"/>
                    </svg>
                    <span class="sr-only">Fechar modal</span>
                </button>
            </div>
            <!-- Modal body -->
            <form action="{{route('reserves.store')}}" method="post" class="p-4 md:p-5 space-y-6">
                @csrf
                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                    <div class="mb-4">
                        <label for="user_id" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Responsável</label>
                        <select id="user_id" name="user_id"
                                class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500">
                            @foreach($users as $user)
                                <option value="{{$user->id}}" data-name="{{$user->name}}">{{$user->name}}</option>
                            @endforeach
                        </select>
                        <!-- Campo oculto para o nome do usuário -->
                        <input type="hidden" name="name" id="name">
                    </div>
                    <div class="mb-4">
                        <label for="rental_item_id"
                               class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Espaço</label>
                        <select id="rental_item_id" name="rental_item_id"
                                class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500">
                            @foreach($RentalItems as $RentalItem)
                                <option value="{{$RentalItem->id}}">{{$RentalItem->name}}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="mb-4">
                        <label for="title" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Título
                            da Reserva</label>
                        <input type="text" name="title" id="title"
                               class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500"
                               required>
                    </div>
                    <div class="mb-4">
                        <label for="start_date" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Hora
                            de Início</label>
                        <input type="datetime-local" name="start_date" id="start_date"
                               class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500"
                               required>
                    </div>
                    <div class="mb-4">
                        <label for="end_date" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Hora
                            do Fim</label>
                        <input type="datetime-local" name="end_date" id="end_date"
                               class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500"
                               required>
                    </div>
                </div>
                <div class="mb-4">
                    <label for="reserve_notes"
                           class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Observações</label>
                    <textarea name="reserve_notes" id="reserve_notes"
                              class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500"
                              placeholder="Digite as observações"></textarea>
                </div>
                <button type="submit"
                        class="text-white inline-flex items-center bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">
                    Salvar
                </button>
            </form>
        </div>
    </div>
</div>
