<!-- Main modal -->
<div id="tenant-reserve" tabindex="-1" aria-hidden="true"
     class="hidden overflow-y-auto overflow-x-hidden fixed inset-0 z-50 flex justify-center items-center">
    <div class="relative p-4 w-full max-w-2xl max-h-full">
        <!-- Modal content -->
        <div class="relative bg-white rounded-lg shadow dark:bg-gray-700">
            <!-- Modal header -->
            <div class="flex items-center justify-between p-4 border-b rounded-t dark:border-gray-600">
                <h3 id="modalTitle" class="text-lg font-semibold text-gray-900 dark:text-white">
                    Solicitar Reserva
                </h3>

                <button type="button"
                        class="text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm w-8 h-8 ml-auto inline-flex justify-center items-center dark:hover:bg-gray-600 dark:hover:text-white"
                        data-modal-toggle="tenant-reserve">
                    <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none"
                         viewBox="0 0 14 14">
                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                              d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6"/>
                    </svg>
                    <span class="sr-only">Fechar modal</span>
                </button>
            </div>
            <!-- Modal body -->
            <form action="{{ route('reserves.store') }}" method="post" class="p-6 space-y-6">
                @csrf
                <input type="hidden" name="cpf_cnpj" value="{{auth()->user()->cpf_cnpj}}">

                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                    <div>
                        <label for="eventTitle"
                               class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Título do
                            Evento</label>
                        <input type="text" name="title" id="eventTitle"
                               class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500"
                               placeholder="Digite o Título do seu Evento" required>
                        <small class="text-red-500 text-xs"></small>
                    </div>
                    <div>
                        <label for="eventResponsible"
                               class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Responsável</label>
                        <input type="text" name="name" id="eventResponsible" value="{{auth()->user()->name}}" readonly
                               class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500"
                               placeholder="Digite o Responsável pela locação" required>
                        <small class="text-red-500 text-xs"></small>
                    </div>
                    <div>
                        <label for="eventCompany"
                               class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Empresa</label>
                        <input type="text" name="company" id="eventCompany" value="{{auth()->user()->company}}"
                               class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500"
                               placeholder="Digite o nome da Empresa" required>
                        <small class="text-red-500 text-xs"></small>
                    </div>
                    <div>
                        <label for="eventRoom"
                               class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Sala
                            Disponível</label>
                        <select name="rental_item_id" id="eventRoom"
                                class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500">
                            @foreach($RentalItems as $rentalItem)
                                <option value="{{ $rentalItem->id }}">{{ $rentalItem->name }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div>
                        <label for="eventStart"
                               class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Início</label>
                        <input type="datetime-local" name="start_date" id="eventStart"
                               class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500"
                               required>
                    </div>
                    <div>
                        <label for="eventEnd"
                               class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Fim</label>
                        <input type="datetime-local" name="end_date" id="eventEnd"
                               class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500"
                               required>
                    </div>

                    <div class="col-span-1 md:col-span-2">
                        <label for="eventObservations"
                               class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Observações</label>
                        <textarea name="reserve_notes" id="eventObservations"
                                  class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500"
                                  placeholder="Adicione observações adicionais"></textarea>
                    </div>
                    <div class="flex items-center col-span-1 md:col-span-2">
                        <input id="termsCheckbox" type="checkbox" value=""
                               class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 rounded focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-800 focus:ring-2 dark:bg-gray-700 dark:border-gray-600">
                        <label for="termsCheckbox"
                               class="ml-2 text-sm font-medium text-gray-900 dark:text-gray-300">Eu
                            li e concordo com <a href="#" class="text-blue-600 dark:text-blue-500 hover:underline">Termos
                                de
                                uso</a>.</label>
                        <small class="text-red-500 text-xs"></small>
                    </div>
                </div>
                <button type="submit"
                        class="text-white w-full bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">
                    Solicitar Reserva
                </button>
            </form>
        </div>
    </div>
</div>
