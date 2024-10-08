<!-- Main modal -->
<div id="view-modal" tabindex="-1" aria-hidden="true"
     class="hidden overflow-y-auto overflow-x-hidden fixed top-0 right-0 left-0 z-50 justify-center items-center w-full md:inset-0 h-[calc(100%-1rem)] max-h-full">
    <div class="relative p-4 w-full max-w-2xl max-h-full">
        <!-- Modal content -->
        <div class="relative bg-white rounded-lg shadow dark:bg-gray-700">
            <!-- Modal header -->
            <div class="flex items-center justify-between p-4 md:p-5 border-b rounded-t dark:border-gray-600">
                <h3 class="text-lg font-semibold text-gray-900 dark:text-white">
                    Sala:
                </h3>
                <button type="button"
                        class="text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm w-8 h-8 ms-auto inline-flex justify-center items-center dark:hover:bg-gray-600 dark:hover:text-white"
                        data-modal-toggle="view-modal">
                    <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg"
                         fill="none" viewBox="0 0 14 14">
                        <path stroke="currentColor" stroke-linecap="round"
                              stroke-linejoin="round" stroke-width="2"
                              d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6"/>
                    </svg>
                    <span class="sr-only">Fechar modal</span>
                </button>
            </div>
            <!-- Modal body -->
            <div class="p-4 md:p-5 bg-white border border-gray-200 rounded-b-lg dark:bg-gray-800 dark:border-gray-700">
                <dl class="grid grid-cols-1 md:grid-cols-2 gap-4 text-gray-900 dark:text-white">
                    <div class="mb-4">
                        <dt class="text-sm font-medium text-gray-500 dark:text-gray-400">Nome</dt>
                        <dd class="text-lg font-semibold" data-field="name"></dd>
                    </div>
                    <div class="mb-4">
                        <dt class="text-sm font-medium text-gray-500 dark:text-gray-400">Status</dt>
                        <dd class="text-lg font-semibold" data-field="status"></dd>
                    </div>
                    <div class="mb-4 md:col-span-2">
                        <dt class="text-sm font-medium text-gray-500 dark:text-gray-400">Descrição</dt>
                        <dd class="text-lg font-semibold" data-field="description"></dd>
                    </div>
                    <div class="mb-4">
                        <dt class="text-sm font-medium text-gray-500 dark:text-gray-400">Preço por hora</dt>
                        <dd class="text-lg font-semibold" data-field="price_per_hour"></dd>
                    </div>
                    <div class="mb-4">
                        <dt class="text-sm font-medium text-gray-500 dark:text-gray-400">Preço por dia</dt>
                        <dd class="text-lg font-semibold" data-field="price_per_day"></dd>
                    </div>
                    <div class="mb-4 md:col-span-2">
                        <dt class="text-sm font-medium text-gray-500 dark:text-gray-400">Preço por mês</dt>
                        <dd class="text-lg font-semibold" data-field="price_per_month"></dd>
                    </div>
                    <div class="mb-4 md:col-span-2">
                        <dt class="text-sm font-medium text-gray-500 dark:text-gray-400">Observações</dt>
                        <dd class="text-lg font-semibold" data-field="rental_item_notes"></dd>
                    </div>
                </dl>
            </div>
        </div>
    </div>
</div>
