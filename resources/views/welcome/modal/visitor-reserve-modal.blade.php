<div id="visitor-reserve" tabindex="-1" aria-hidden="true"
     class="hidden overflow-y-auto overflow-x-hidden fixed top-0 right-0 left-0 z-50 justify-center items-center w-full md:inset-0 h-[calc(100%-1rem)] max-h-full">
    <div class="relative p-4 w-full max-w-7xl max-h-full">
        <!-- Modal content -->
        <div class="relative bg-white rounded-lg shadow dark:bg-gray-700">
            <!-- Modal header -->
            <div class="flex items-center justify-between p-4 border-b rounded-t dark:border-gray-600">
                <h3 id="modalTitle" class="text-lg font-semibold text-gray-900 dark:text-white">
                    Solicitar Reserva
                </h3>
                <button type="button"
                        class="text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm w-8 h-8 ms-auto inline-flex justify-center items-center dark:hover:bg-gray-600 dark:hover:text-white"
                        data-modal-toggle="visitor-reserve" aria-label="Fechar modal">
                    <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none"
                         viewBox="0 0 14 14">
                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                              d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6"/>
                    </svg>
                </button>
            </div>
            <!-- Modal body -->
            <form id="reserveForm" action="{{ route('reserves.store') }}" method="post" class="p-4 space-y-4">
                @csrf
                <input type="hidden" name="role" value="visitor">
                <input type="hidden" name="reserve_status" value="reservado">
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <!-- Left side (Dados do Visitante + Empresa) -->
                    <div class="space-y-6">
                        <!-- Dados do Visitante Section -->
                        <div class="space-y-3">
                            <div class="grid grid-cols-1 md:grid-cols-2 gap-3">
                                <div class="input-field hidden">
                                    <label for="visitorName"
                                           class="block mb-1 text-sm font-medium text-gray-900 dark:text-white">Nome</label>
                                    <input type="text" name="name" id="visitorName" autocomplete="name"
                                           class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500"
                                           placeholder="Digite o nome do visitante" required
                                           value="{{ old('name') }}">
                                    <p id="visitorNameError" class="text-red-500 text-xs mt-1 hidden">Nome é
                                        obrigatório.</p>
                                </div>
                                <div class="space-y-2">
                                    <label for="visitorEmail"
                                           class="block text-sm font-medium text-gray-900 dark:text-white">Email</label>
                                    <div class="relative">
                                        <input type="email" name="email" id="visitorEmail" autocomplete="email"
                                               class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2 pr-10 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500"
                                               placeholder="Digite seu email" required
                                               value="{{ old('email') }}">
                                        <button type="button" id="emailSearchIcon"
                                                class="absolute right-2 top-1/2 transform -translate-y-1/2">
                                            <svg class="w-6 h-6 text-gray-800 dark:text-white" aria-hidden="true"
                                                 xmlns="http://www.w3.org/2000/svg"
                                                 width="24" height="24" fill="none" viewBox="0 0 24 24">
                                                <path stroke="currentColor" stroke-linecap="round" stroke-width="2"
                                                      d="m21 21-3.5-3.5M17 10a7 7 0 1 1-14 0 7 7 0 0 1 14 0Z"/>
                                            </svg>
                                        </button>
                                    </div>
                                    <p id="visitorEmailError" class="text-red-500 text-xs mt-1 hidden">Email é
                                        obrigatório.</p>
                                </div>

                                <div class="input-field hidden">
                                    <label for="visitorPhone"
                                           class="block mb-1 text-sm font-medium text-gray-900 dark:text-white">Telefone</label>
                                    <input type="tel" name="phone" id="visitorPhone" autocomplete="tel"
                                           class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500"
                                           placeholder="Digite o telefone do visitante" required
                                           value="{{ old('phone') }}">
                                    <p id="visitorPhoneError" class="text-red-500 text-xs mt-1 hidden">Telefone é
                                        obrigatório.</p>
                                </div>
                            </div>
                        </div>

                        <!-- Dados da Empresa Section -->
                        <div class="space-y-3">
                            <div class="grid grid-cols-1 md:grid-cols-2 gap-3">
                                <div class="input-field hidden">
                                    <label for="eventCompany"
                                           class="block mb-1 text-sm font-medium text-gray-900 dark:text-white">Empresa</label>
                                    <input type="text" name="company" id="eventCompany" autocomplete="organization"
                                           class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500"
                                           placeholder="Digite o nome da Empresa" required value="{{ old('company') }}">
                                    <p id="eventCompanyError" class="text-red-500 text-xs mt-1 hidden">Empresa é
                                        obrigatório.</p>
                                </div>
                                <div class="input-field hidden">
                                    <label for="eventCpfCnpj"
                                           class="block mb-1 text-sm font-medium text-gray-900 dark:text-white">CPF/CNPJ</label>
                                    <input type="text" name="cpf_cnpj" id="eventCpfCnpj" autocomplete="off"
                                           onblur="pesquisacnpj(this.value)"
                                           class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500"
                                           placeholder="Digite o CPF/CNPJ" required value="{{ old('cpf_cnpj') }}">
                                    <p id="eventCpfCnpjError" class="text-red-500 text-xs mt-1 hidden">CPF/CNPJ é
                                        obrigatório.</p>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Right side (Endereço) -->
                    <div class="space-y-6">
                        <div class="space-y-3">
                            <div class="grid grid-cols-1 md:grid-cols-2 gap-3">
                                <div class="input-field hidden">
                                    <label for="eventCep"
                                           class="block mb-1 text-sm font-medium text-gray-900 dark:text-white">CEP</label>
                                    <input type="text" name="cep" id="eventCep" autocomplete="postal-code"
                                           onblur="pesquisacep(this.value)"
                                           class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500"
                                           placeholder="Digite o CEP da Empresa" required value="{{ old('cep') }}">
                                    <p id="eventCepError" class="text-red-500 text-xs mt-1 hidden">CEP é
                                        obrigatório.</p>
                                </div>
                                <div class="input-field hidden">
                                    <label for="eventCity"
                                           class="block mb-1 text-sm font-medium text-gray-900 dark:text-white">Cidade</label>
                                    <input type="text" name="city" id="eventCity" autocomplete="address-level2"
                                           class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500"
                                           placeholder="Digite a cidade" required value="{{ old('city') }}">
                                    <p id="eventCityError" class="text-red-500 text-xs mt-1 hidden">Cidade é
                                        obrigatório.</p>
                                </div>
                                <div class="input-field hidden">
                                    <label for="eventStreet"
                                           class="block mb-1 text-sm font-medium text-gray-900 dark:text-white">Rua</label>
                                    <input type="text" name="street" id="eventStreet" autocomplete="address-line1"
                                           class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500"
                                           placeholder="Digite a Rua" required value="{{ old('street') }}">
                                    <p id="eventStreetError" class="text-red-500 text-xs mt-1 hidden">Rua é
                                        obrigatório.</p>
                                </div>
                                <div class="input-field hidden">
                                    <label for="eventNeighborhood"
                                           class="block mb-1 text-sm font-medium text-gray-900 dark:text-white">Bairro</label>
                                    <input type="text" name="neighborhood" id="eventNeighborhood"
                                           autocomplete="address-level3"
                                           class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500"
                                           placeholder="Digite o Bairro" required value="{{ old('neighborhood') }}">
                                    <p id="eventNeighborhoodError" class="text-red-500 text-xs mt-1 hidden">Bairro é
                                        obrigatório.</p>
                                </div>
                                <div class="input-field hidden">
                                    <label for="eventNumber"
                                           class="block mb-1 text-sm font-medium text-gray-900 dark:text-white">Número</label>
                                    <input type="text" name="number" id="eventNumber"
                                           autocomplete="address-level3"
                                           class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500"
                                           placeholder="Digite o Número" required value="{{ old('number') }}">
                                    <p id="eventNumberError" class="text-red-500 text-xs mt-1 hidden">Número é
                                        obrigatório.</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Bottom (Dados da Locação) -->
                <div class="space-y-6">

                    <div class="grid grid-cols-1 md:grid-cols-4 gap-3">
                        <div class="input-field hidden">
                            <label for="datepicker-range-start"
                                   class="block mb-1 text-sm font-medium text-gray-900 dark:text-white">Data de
                                Início</label>
                            <input id="datepicker-range-start" name="start_date" type="text" autocomplete="off"
                                   class="datepicker-custom bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500"
                                   placeholder="dd/mm/yyyy" value="{{ old('start_date') }}">
                            <p id="startDateError" class="text-red-500 text-xs mt-1 hidden">Data de Início é
                                obrigatório.</p>
                        </div>
                        <div class="input-field hidden">
                            <label for="datepicker-range-end"
                                   class="block mb-1 text-sm font-medium text-gray-900 dark:text-white">Data de
                                Término</label>
                            <input id="datepicker-range-end" name="end_date" type="text" autocomplete="off"
                                   class="datepicker-custom bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500"
                                   placeholder="dd/mm/yyyy" value="{{ old('end_date') }}">
                            <p id="endDateError" class="text-red-500 text-xs mt-1 hidden">Data de Término é
                                obrigatório.</p>
                        </div>
                        <div class="input-field hidden">
                            <label for="start_time"
                                   class="block mb-1 text-sm font-medium text-gray-900 dark:text-white">Hora de
                                Início</label>
                            <select id="start_time" name="start_time"
                                    class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500"
                                    required>
                                <option value="08:00">08:00</option>
                                <option value="09:00">09:00</option>
                                <option value="10:00">10:00</option>
                                <option value="11:00">11:00</option>
                                <option value="12:00">12:00</option>
                                <option value="13:00">13:00</option>
                                <option value="14:00">14:00</option>
                                <option value="15:00">15:00</option>
                                <option value="16:00">16:00</option>
                                <option value="17:00">17:00</option>
                                <option value="18:00">18:00</option>
                            </select>
                            <p id="startTimeError" class="text-red-500 text-xs mt-1 hidden">Hora de Início é
                                obrigatório.</p>
                        </div>

                        <div class="input-field hidden">
                            <label for="end_time" class="block mb-1 text-sm font-medium text-gray-900 dark:text-white">Hora
                                de Término</label>
                            <select id="end_time" name="end_time"
                                    class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500"
                                    required>
                                <option value="09:00">09:00</option>
                                <option value="10:00">10:00</option>
                                <option value="11:00">11:00</option>
                                <option value="12:00">12:00</option>
                                <option value="13:00">13:00</option>
                                <option value="14:00">14:00</option>
                                <option value="15:00">15:00</option>
                                <option value="16:00">16:00</option>
                                <option value="17:00">17:00</option>
                                <option value="18:00">18:00</option>
                                <option value="19:00">19:00</option>
                            </select>
                            <p id="endTimeError" class="text-red-500 text-xs mt-1 hidden">Hora de Término é
                                obrigatório.</p>
                        </div>

                    </div>

                    <div class="grid grid-cols-1 md:grid-cols-3 gap-3">
                        <div class="input-field hidden">
                            <label for="eventTitle"
                                   class="block mb-1 text-sm font-medium text-gray-900 dark:text-white">Título do
                                Evento</label>
                            <input type="text" name="title" id="eventTitle" autocomplete="off"
                                   class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500"
                                   placeholder="Digite o Título do seu Evento" required value="{{ old('title') }}">
                            <p id="eventTitleError" class="text-red-500 text-xs mt-1 hidden">Título do Evento é
                                obrigatório.</p>
                        </div>
                        <div class="input-field hidden">
                            <label for="rental_item_id"
                                   class="block mb-1 text-sm font-medium text-gray-900 dark:text-white">Espaço</label>
                            <select id="rental_item_id" name="rental_item_id" autocomplete="off"
                                    class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500">
                                @foreach($RentalItems as $RentalItem)
                                    <option
                                        value="{{$RentalItem->id}}" {{ old('rental_item_id') == $RentalItem->id ? 'selected' : '' }}>{{$RentalItem->name}}</option>
                                @endforeach
                            </select>
                            <p id="rentalItemError" class="text-red-500 text-xs mt-1 hidden">Espaço é obrigatório.</p>
                        </div>
                        <div class="col-span-3 input-field hidden">
                            <label for="eventDescription"
                                   class="block mb-1 text-sm font-medium text-gray-900 dark:text-white">Descrição</label>
                            <textarea name="description" id="eventDescription" autocomplete="off"
                                      class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500"
                                      placeholder="Digite a descrição do evento"
                                      required>{{ old('description') }}</textarea>
                            <p id="eventDescriptionError" class="text-red-500 text-xs mt-1 hidden">Descrição é
                                obrigatória.</p>
                        </div>
                    </div>
                </div>


                <div class="flex justify-end mt-4">
                    <button id="nextButton" type="submit"
                            class=" text-white inline-flex items-center bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">

                        Próxima Etapa
                    </button>
                </div>
                <div class="flex justify-end mt-4">
                    <button id="submitReserveButton" type="submit"
                            class="hidden text-white inline-flex items-center bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">
                        Solicitar Reserva
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>
