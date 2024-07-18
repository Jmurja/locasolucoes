<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Visitor Reserve</title>
    <link rel="stylesheet" href="path/to/your/styles.css">
    <script src="https://cdn.jsdelivr.net/npm/flowbite@2.4.1/dist/flowbite.min.js"></script>
</head>
<body>
<!-- Main modal -->
<div id="visitor-reserve" tabindex="-1" aria-hidden="true"
     class="hidden overflow-y-auto overflow-x-hidden fixed top-0 right-0 left-0 z-50 justify-center items-center w-full md:inset-0 h-[calc(100%-1rem)] max-h-full">
    <div class="relative p-4 w-full max-w-6xl max-h-full">
        <!-- Modal content -->
        <div class="relative bg-white rounded-lg shadow dark:bg-gray-700">
            <!-- Modal header -->
            <div class="flex items-center justify-between p-4 border-b rounded-t dark:border-gray-600">
                <h3 id="modalTitle" class="text-lg font-semibold text-gray-900 dark:text-white">
                    Solicitar Reserva
                </h3>
                <button type="button"
                        class="text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm w-8 h-8 ms-auto inline-flex justify-center items-center dark:hover:bg-gray-600 dark:hover:text-white"
                        data-modal-toggle="visitor-reserve">
                    <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none"
                         viewBox="0 0 14 14">
                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                              d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6"/>
                    </svg>
                    <span class="sr-only">Fechar modal</span>
                </button>
            </div>
            <!-- Modal body -->
            <form action="{{ route('reserves.store') }}" method="post" class="p-4 space-y-4">
                @csrf
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <!-- Left side (Dados do Visitante + Empresa) -->
                    <div class="space-y-6">
                        <!-- Dados do Visitante Section -->
                        <div class="space-y-3">
                            <h4 class="text-md font-semibold text-gray-900 dark:text-white">Dados do Visitante</h4>
                            <div class="grid grid-cols-1 gap-3">
                                <div>
                                    <label for="visitorName"
                                           class="block mb-1 text-sm font-medium text-gray-900 dark:text-white">Nome</label>
                                    <input type="text" name="name" id="visitorName"
                                           class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500"
                                           placeholder="Digite o nome do visitante" required value="{{ old('name') }}">
                                </div>
                                <div>
                                    <label for="visitorEmail"
                                           class="block mb-1 text-sm font-medium text-gray-900 dark:text-white">Email</label>
                                    <input type="email" name="email" id="visitorEmail"
                                           class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500"
                                           placeholder="Digite o email do visitante" required
                                           value="{{ old('email') }}">
                                </div>
                                <div>
                                    <label for="visitorPhone"
                                           class="block mb-1 text-sm font-medium text-gray-900 dark:text-white">Telefone</label>
                                    <input type="text" name="visitor_phone" id="visitorPhone"
                                           class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500"
                                           placeholder="Digite o telefone do visitante" required
                                           value="{{ old('visitor_phone') }}">
                                </div>
                            </div>
                        </div>

                        <!-- Dados da Empresa Section -->
                        <div class="space-y-3">
                            <h4 class="text-md font-semibold text-gray-900 dark:text-white">Dados da Empresa</h4>
                            <div class="grid grid-cols-1 gap-3">
                                <div>
                                    <label for="eventCompany"
                                           class="block mb-1 text-sm font-medium text-gray-900 dark:text-white">Empresa</label>
                                    <input type="text" name="company" id="eventCompany"
                                           class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500"
                                           placeholder="Digite o nome da Empresa" required value="{{ old('company') }}">
                                </div>
                                <div>
                                    <label for="eventCpfCnpj"
                                           class="block mb-1 text-sm font-medium text-gray-900 dark:text-white">CPF/CNPJ</label>
                                    <input type="text" name="cpf_cnpj" id="eventCpfCnpj"
                                           onblur="pesquisacnpj(this.value)"
                                           class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500"
                                           placeholder="Digite o CPF/CNPJ" required value="{{ old('cpf_cnpj') }}">
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Right side (Endereço) -->
                    <div class="space-y-6">
                        <div class="space-y-3">
                            <h4 class="text-md font-semibold text-gray-900 dark:text-white">Endereço</h4>
                            <div class="grid grid-cols-1 gap-3">
                                <div>
                                    <label for="eventCep"
                                           class="block mb-1 text-sm font-medium text-gray-900 dark:text-white">CEP</label>
                                    <input type="text" name="cep" id="eventCep" onblur="pesquisacep(this.value)"
                                           class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500"
                                           placeholder="Digite o CEP da Empresa" required value="{{ old('cep') }}">
                                </div>
                                <div>
                                    <label for="eventCity"
                                           class="block mb-1 text-sm font-medium text-gray-900 dark:text-white">Cidade</label>
                                    <input type="text" name="city" id="eventCity"
                                           class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500"
                                           placeholder="Digite a cidade" required value="{{ old('city') }}">
                                </div>
                                <div>
                                    <label for="eventStreet"
                                           class="block mb-1 text-sm font-medium text-gray-900 dark:text-white">Rua</label>
                                    <input type="text" name="street" id="eventStreet"
                                           class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500"
                                           placeholder="Digite a Rua" required value="{{ old('street') }}">
                                </div>
                                <div>
                                    <label for="eventNeighborhood"
                                           class="block mb-1 text-sm font-medium text-gray-900 dark:text-white">Bairro</label>
                                    <input type="text" name="neighborhood" id="eventNeighborhood"
                                           class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500"
                                           placeholder="Digite o Bairro" required value="{{ old('neighborhood') }}">
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Bottom (Dados da Locação) -->
                <div class="space-y-6">
                    <h4 class="text-md font-semibold text-gray-900 dark:text-white">Dados da Locação</h4>

                    <div class="grid grid-cols-1 md:grid-cols-3 gap-3">
                        <div class="col-span-2 flex items-center space-x-4">
                            <div class="relative w-full">
                                <div class="absolute inset-y-0 left-0 flex items-center pl-3 pointer-events-none">
                                    <svg class="w-4 h-4 text-gray-500 dark:text-gray-400" aria-hidden="true"
                                         xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 20 20">
                                        <path
                                            d="M20 4a2 2 0 0 0-2-2h-2V1a1 1 0 0 0-2 0v1h-3V1a1 1 0 0 0-2 0v1H6V1a1 1 0 0 0-2 0v1H2a2 2 0 0 0-2 2v2h20V4ZM0 18a2 2 0 0 0 2 2h16a2 2 0 0 0 2-2V8H0v10Zm5-8h10a1 1 0 0 1 0 2H5a1 1 0 0 1 0-2Z"/>
                                    </svg>
                                </div>
                                <input id="datepicker-range-start" name="start" type="text"
                                       class="datepicker-custom bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full pl-10 p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500"
                                       placeholder="Data de início" value="{{ old('start') }}">
                            </div>
                            <span class="mx-4 text-gray-500">até</span>
                            <div class="relative w-full">
                                <div class="absolute inset-y-0 left-0 flex items-center pl-3 pointer-events-none">
                                    <svg class="w-4 h-4 text-gray-500 dark:text-gray-400" aria-hidden="true"
                                         xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 20 20">
                                        <path
                                            d="M20 4a2 2 0 0 0-2-2h-2V1a1 1 0 0 0-2 0v1h-3V1a1 1 0 0 0-2 0v1H6V1a1 1 0 0 0-2 0v1H2a2 2 0 0 0-2 2v2h20V4ZM0 18a2 2 0 0 0 2 2h16a2 2 0 0 0 2-2V8H0v10Zm5-8h10a1 1 0 0 1 0 2H5a1 1 0 0 1 0-2Z"/>
                                    </svg>
                                </div>
                                <input id="datepicker-range-end" name="end" type="text"
                                       class="datepicker-custom bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full pl-10 p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500"
                                       placeholder="Data de término" value="{{ old('end') }}">
                            </div>
                        </div>
                        <div>
                            <label for="eventTitle"
                                   class="block mb-1 text-sm font-medium text-gray-900 dark:text-white">Título do
                                Evento</label>
                            <input type="text" name="title" id="eventTitle"
                                   class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500"
                                   placeholder="Digite o Título do seu Evento" required value="{{ old('title') }}">
                        </div>
                    </div>

                    <div class="grid grid-cols-1 md:grid-cols-3 gap-3">
                        <div class="col-span-1 md:col-span-2">
                            <label for="eventDescription"
                                   class="block mb-1 text-sm font-medium text-gray-900 dark:text-white">Descrição</label>
                            <textarea name="description" id="eventDescription"
                                      class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500"
                                      placeholder="Digite a descrição do evento"
                                      required>{{ old('description') }}</textarea>
                        </div>
                        <div>
                            <label for="rental_item_id"
                                   class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Espaço</label>
                            <select id="rental_item_id" name="rental_item_id"
                                    class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500">
                                @foreach($RentalItems as $RentalItem)
                                    <option
                                        value="{{$RentalItem->id}}" {{ old('rental_item_id') == $RentalItem->id ? 'selected' : '' }}>{{$RentalItem->name}}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-3">
                        <div>
                            <label for="start_time"
                                   class="block mb-1 text-sm font-medium text-gray-900 dark:text-white">Hora de
                                Início</label>
                            <input type="time" id="start_time" name="start_time"
                                   class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500"
                                   min="08:00" max="18:00" required value="{{ old('start_time') }}">
                        </div>
                        <div>
                            <label for="end_time"
                                   class="block mb-1 text-sm font-medium text-gray-900 dark:text-white">Hora de
                                Término</label>
                            <input type="time" id="end_time" name="end_time"
                                   class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500"
                                   min="09:00" max="18:00" required value="{{ old('end_time') }}">
                        </div>
                    </div>
                </div>

                <div class="flex justify-end mt-4">
                    <button type="submit"
                            class="text-white inline-flex items-center bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">
                        Solicitar Reserva
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>
</body>
</html>
