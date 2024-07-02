<!-- Main modal -->
<div id="view-modal" tabindex="-1" aria-hidden="true"
     class="hidden overflow-y-auto overflow-x-hidden fixed top-0 right-0 left-0 z-50 flex justify-center items-center w-full md:inset-0 h-[calc(100%-1rem)] max-h-full">
    <div class="relative p-4 w-full max-w-2xl max-h-full">
        <!-- Modal content -->
        <div class="relative bg-white rounded-lg shadow dark:bg-gray-700">
            <!-- Modal header -->
            <div class="flex items-center justify-between p-4 md:p-5 border-b rounded-t dark:border-gray-600">
                <h3 class="text-lg font-semibold text-gray-900 dark:text-white">
                    Usuário:
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
            <div class="p-6 bg-white border border-gray-200 rounded-b-lg shadow dark:bg-gray-800 dark:border-gray-700">
                <dl class="grid grid-cols-1 md:grid-cols-2 gap-x-6 gap-y-4 text-gray-900 dark:text-white">
                    <div class="flex flex-col">
                        <dt class="mb-1 text-gray-500 md:text-lg dark:text-gray-400">Nome</dt>
                        <dd class="text-lg font-semibold modal-user-name"></dd>
                    </div>
                    <div class="flex flex-col">
                        <dt class="mb-1 text-gray-500 md:text-lg dark:text-gray-400">Email</dt>
                        <dd class="text-lg font-semibold modal-user-email"></dd>
                    </div>
                    <div class="flex flex-col">
                        <dt class="mb-1 text-gray-500 md:text-lg dark:text-gray-400">Telefone</dt>
                        <dd class="text-lg font-semibold modal-user-phone"></dd>
                    </div>
                    <div class="flex flex-col">
                        <dt class="mb-1 text-gray-500 md:text-lg dark:text-gray-400">CPF/CPNJ</dt>
                        <dd class="text-lg font-semibold modal-user-cpf_cnpj"></dd>
                    </div>
                    <div class="flex flex-col">
                        <dt class="mb-1 text-gray-500 md:text-lg dark:text-gray-400">CEP</dt>
                        <dd class="text-lg font-semibold modal-user-cep"></dd>
                    </div>
                    <div class="flex flex-col">
                        <dt class="mb-1 text-gray-500 md:text-lg dark:text-gray-400">Rua</dt>
                        <dd class="text-lg font-semibold modal-user-rua"></dd>
                    </div>
                    <div class="flex flex-col">
                        <dt class="mb-1 text-gray-500 md:text-lg dark:text-gray-400">Bairro</dt>
                        <dd class="text-lg font-semibold modal-user-bairro"></dd>
                    </div>
                    <div class="flex flex-col">
                        <dt class="mb-1 text-gray-500 md:text-lg dark:text-gray-400">Cidade</dt>
                        <dd class="text-lg font-semibold modal-user-cidade"></dd>
                    </div>
                    <div class="flex flex-col">
                        <dt class="mb-1 text-gray-500 md:text-lg dark:text-gray-400">Categoria</dt>
                        <dd class="text-lg font-semibold modal-user-role"></dd>
                    </div>
                    <div class="flex flex-col">
                        <dt class="mb-1 text-gray-500 md:text-lg dark:text-gray-400">Criado em</dt>
                        <dd class="text-lg font-semibold modal-user-created_at"></dd>
                    </div>
                    <div class="flex flex-col">
                        <dt class="mb-1 text-gray-500 md:text-lg dark:text-gray-400">Atualizado em</dt>
                        <dd class="text-lg font-semibold modal-user-updated_at"></dd>
                    </div>
                </dl>
            </div>
        </div>
    </div>
</div>
