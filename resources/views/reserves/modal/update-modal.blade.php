<script>
    document.addEventListener('DOMContentLoaded', function () {
        const editButtons = document.querySelectorAll('.edit-button');
        const modal = document.getElementById('jetete');
        const backdrop = document.getElementById('modalBackdrop');
        const closeModalButtons = document.querySelectorAll('.close-modal');

        editButtons.forEach(button => {
            button.addEventListener('click', function () {
                const reserveId = this.getAttribute('data-reserve-id');

                // Use fetch API to get the reserve data
                fetch(`/reserves/${reserveId}`)
                    .then(response => response.json())
                    .then(data => {
                        // Populate modal fields with data
                        document.getElementById('update_user_id').value = data.user_id;
                        document.getElementById('update_start_date').value = data.start_date;
                        document.getElementById('update_end_date').value = data.end_date;
                        document.getElementById('update_reserve_notes').value = data.reserve_notes;

                        // Update the form action to include the correct reserve ID
                        document.getElementById('editForm').action = `/reserves/${reserveId}`;

                        // Open the modal and show backdrop
                        modal.classList.remove('hidden');
                        backdrop.classList.remove('hidden');
                    })
                    .catch(error => console.error('Error:', error));
            });
        });

        // Close modal logic
        closeModalButtons.forEach(button => {
            button.addEventListener('click', function () {
                modal.classList.add('hidden');
                backdrop.classList.add('hidden');
            });
        });

        // Close modal when clicking outside the modal content
        backdrop.addEventListener('click', function () {
            modal.classList.add('hidden');
            backdrop.classList.add('hidden');
        });
    });
</script>


<!-- Modal backdrop -->
<div id="modalBackdrop" class="fixed inset-0 bg-gray-900 bg-opacity-50 hidden"></div>

<!-- Main modal -->
<div id="jetete" tabindex="-1" aria-hidden="true"
     class="hidden overflow-y-auto overflow-x-hidden fixed inset-0 z-50 justify-center items-center w-full h-full">
    <div class="relative p-4 w-full max-w-md h-auto mx-auto my-auto">
        <!-- Modal content -->
        <div class="relative bg-white rounded-lg shadow dark:bg-gray-700">
            <!-- Modal header -->
            <div class="flex items-center justify-between p-4 md:p-5 border-b rounded-t dark:border-gray-600">
                <h3 class="text-lg font-semibold text-gray-900 dark:text-white">
                    Editar Reserva
                </h3>
                <button type="button"
                        class="close-modal text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm w-8 h-8 ms-auto inline-flex justify-center items-center dark:hover:bg-gray-600 dark:hover:text-white">
                    <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg"
                         fill="none" viewBox="0 0 14 14">
                        <path stroke="currentColor" stroke-linecap="round"
                              stroke-linejoin="round" stroke-width="2"
                              d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6"/>
                    </svg>
                    <span class="sr-only">Fechar Modal</span>
                </button>
            </div>
            <!-- Modal body -->
            <div class="max-w-md mx-auto sm:px-6 lg:p-8 mt-8 bg-slate-800">
                <form id="editForm" action="{{ route('reserves.update', 'reserve-id-placeholder') }}" method="post"
                      class="max-w-md mx-auto">
                    @csrf
                    @method('patch')

                    <div class="relative z-0 w-full mb-5 group">
                        <label for="user_id" class="sr-only">Underline select</label>
                        <select id="update_user_id" name="user_id"
                                class="block py-2.5 px-0 w-full text-sm text-gray-500 bg-transparent border-0 border-b-2 border-gray-200 appearance-none dark:text-gray-400 dark:border-gray-700 focus:outline-none focus:ring-0 focus:border-gray-200 peer">
                            @foreach($users as $user)
                                <option value="{{ $user->id }}">{{ $user->name }}</option>
                            @endforeach
                        </select>
                    </div>

                    <div class="relative z-0 w-full mb-5 group">
                        <input type="text" name="start_date" id="update_start_date"
                               class="block py-2.5 px-0 w-full text-sm text-gray-900 bg-transparent border-0 border-b-2 border-gray-300 appearance-none dark:text-white dark:border-gray-600 dark:focus:border-blue-500 focus:outline-none focus:ring-0 focus:border-blue-600 peer"
                               placeholder=" "/>
                        <label for="update_start_date"
                               class="peer-focus:font-medium absolute text-sm text-gray-500 dark:text-gray-400 duration-300 transform -translate-y-6 scale-75 top-3 -z-10 origin-[0] peer-focus:start-0 rtl:peer-focus:translate-x-1/4 rtl:peer-focus:left-auto peer-focus:text-blue-600 peer-focus:dark:text-blue-500 peer-placeholder-shown:scale-100 peer-placeholder-shown:translate-y-0 peer-focus:scale-75 peer-focus:-translate-y-6">
                            Hora de inicio
                        </label>
                    </div>

                    <div class="relative z-0 w-full mb-5 group">
                        <input type="text" name="end_date" id="update_end_date"
                               class="block py-2.5 px-0 w-full text-sm text-gray-900 bg-transparent border-0 border-b-2 border-gray-300 appearance-none dark:text-white dark:border-gray-600 dark:focus:border-blue-500 focus:outline-none focus:ring-0 focus:border-blue-600 peer"
                               placeholder=" "/>
                        <label for="update_end_date"
                               class="peer-focus:font-medium absolute text-sm text-gray-500 dark:text-gray-400 duration-300 transform -translate-y-6 scale-75 top-3 -z-10 origin-[0] peer-focus:start-0 rtl:peer-focus:translate-x-1/4 rtl:peer-focus:left-auto peer-focus:text-blue-600 peer-focus:dark:text-blue-500 peer-placeholder-shown:scale-100 peer-placeholder-shown:translate-y-0 peer-focus:scale-75 peer-focus:-translate-y-6">
                            Hora de fim
                        </label>
                    </div>
                    <div class="relative z-0 w-full mb-5 group">
                        <input type="text" name="reserve_notes" id="update_reserve_notes"
                               class="block py-2.5 px-0 w-full text-sm text-gray-900 bg-transparent border-0 border-b-2 border-gray-300 appearance-none dark:text-white dark:border-gray-600 dark:focus:border-blue-500 focus:outline-none focus:ring-0 focus:border-blue-600 peer"
                               placeholder=" "/>
                        <label for="update_reserve_notes"
                               class="peer-focus:font-medium absolute text-sm text-gray-500 dark:text-gray-400 duration-300 transform -translate-y-6 scale-75 top-3 -z-10 origin-[0] peer-focus:start-0 rtl:peer-focus:translate-x-1/4 peer-focus:left-auto peer-focus:text-blue-600 peer-focus:dark:text-blue-500 peer-placeholder-shown:scale-100 peer-placeholder-shown:translate-y-0 peer-focus:scale-75 peer-focus:-translate-y-6">
                            Observações
                        </label>
                    </div>

                    <button type="submit"
                            class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm w-full sm:w-auto px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">
                        Salvar
                    </button>
                </form>
            </div>
        </div>
    </div>
</div>
