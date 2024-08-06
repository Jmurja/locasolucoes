<div id="edit-modal" tabindex="-1" aria-hidden="true"
     class="hidden overflow-y-auto overflow-x-hidden fixed top-0 right-0 left-0 z-50 justify-center items-center w-full md:inset-0 h-[calc(100%-1rem)] max-h-full">
  <div class="relative p-4 w-full max-w-2xl max-h-full">
    <!-- Modal content -->
    <div class="relative bg-white rounded-lg shadow dark:bg-gray-700">
      <!-- Modal header -->
      <div class="flex items-center justify-between p-4 md:p-5 border-b rounded-t dark:border-gray-600">
        <h3 class="text-lg font-semibold text-gray-900 dark:text-white">
          Editar Produto
        </h3>
        <button type="button"
                class="text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm w-8 h-8 ms-auto inline-flex justify-center items-center dark:hover:bg-gray-600 dark:hover:text-white"
                data-modal-toggle="edit-modal">
          <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none"
               viewBox="0 0 14 14">
            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                  d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6"/>
          </svg>
          <span class="sr-only">Fechar Modal</span>
        </button>
      </div>
      <!-- Modal body -->
      <form action="" method="post" class="p-4 md:p-5 space-y-6" id="edit-form" enctype="multipart/form-data">
        @csrf
        @method('patch')
        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
          <div class="mb-4">
            <label for="edit_user_id"
                   class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Selecione o
              Responsável</label>
            <select id="edit_user_id" name="user_id"
                    class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500"
                    required>
              <option disabled selected>Selecione o Responsável</option>
              @foreach($landLordUsers as $landLordUser)
                <option value="{{$landLordUser->id}}">{{$landLordUser->name}}</option>
              @endforeach
            </select>
          </div>
          <div class="mb-4">
            <label for="edit_name"
                   class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Nome</label>
            <input type="text" name="name" id="edit_name"
                   class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500"
                   placeholder="Digite o nome" required>
            <small id="name-error" class="text-red-500 text-xs hidden">Nome é obrigatório e deve ter pelo
              menos 3 caracteres.</small>
          </div>

          <div class="mb-4">
            <label for="edit_description"
                   class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Descrição</label>
            <textarea name="description" id="edit_description"
                      class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500"
                      placeholder="Digite a descrição" required></textarea>
            <small id="description-error" class="text-red-500 text-xs hidden">Descrição é obrigatória e deve
              ter pelo menos 5 caracteres.</small>
          </div>
          <div class="mb-4">
            <label for="edit_price_per_hour"
                   class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Valor por
              hora</label>
            <input type="text" name="price_per_hour" id="edit_price_per_hour"
                   class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500"
                   placeholder="Digite o valor por hora" required>
            <small id="edit_price_per_hour-error" class="text-red-500 text-xs hidden">Valor por hora deve
              ser um número.</small>
          </div>
          <div class="mb-4">
            <label for="edit_price_per_day"
                   class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Valor por
              dia</label>
            <input type="text" name="price_per_day" id="edit_price_per_day"
                   class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500"
                   placeholder="Digite o valor por dia" required>
            <small id="edit_price_per_day-error" class="text-red-500 text-xs hidden">Valor por dia deve ser
              um número.</small>
          </div>
        </div>
        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
          <div class="mb-4">
            <label for="edit_price_per_month"
                   class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Valor por
              mês</label>
            <input type="text" name="price_per_month" id="edit_price_per_month"
                   class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500"
                   placeholder="Digite o valor por mês" required>
            <small id="edit_price_per_month-error" class="text-red-500 text-xs hidden">Valor por mês deve
              ser um número.</small>
          </div>
          <div class="mb-4">
            <label for="edit_status"
                   class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Status</label>
            <select id="edit_status" name="status"
                    class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500"
                    required>
              <option value="available">Disponível</option>
              <option value="reserved">Reservado</option>
              <option value="maintenance">Manutenção</option>
            </select>
          </div>
        </div>
        <div class="mb-4">
          <label for="edit_rental_item_notes"
                 class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Observações</label>
          <textarea name="rental_item_notes" id="edit_rental_item_notes"
                    class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500"
                    placeholder="Digite as observações"></textarea>
        </div>


        <div class="mb-4">
          <label for="multiple_files" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Upload
            múltiplos arquivos</label>
          <input
              class="block w-full text-sm text-gray-900 border border-gray-300 rounded-lg cursor-pointer bg-gray-50 dark:text-gray-400 focus:outline-none dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400"
              id="multiple_files" name="rental_item_images[]" type="file" multiple>
          <div id="edit-image-previews"
               class="mt-4 grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-4"></div>
          <button data-rentalItem-id="{{$rentalItem->id}}"
                  class="delete-button block text-red-500 rounded-lg text-sm px-5 py-2.5 text-center dark:focus:ring-blue-800"
                  data-modal-target="delete-modal" data-modal-toggle="delete-modal" type="button">
            <x-icons.trash/>
          </button>
        </div>

        <button type="submit"
                class="text-white inline-flex items-center bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">
          Salvar
        </button>
      </form>
    </div>
  </div>
</div>
