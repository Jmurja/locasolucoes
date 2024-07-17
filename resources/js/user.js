document.addEventListener('DOMContentLoaded', function () {
    const editButtons = document.querySelectorAll('.edit-user-button');
    const viewButtons = document.querySelectorAll('.view-user-button');
    const deleteButtons = document.querySelectorAll('.delete-button');
    const closeModalButtons = document.querySelectorAll('button[data-modal-toggle]');
    const editModal = document.getElementById('edit-modal');
    const viewModal = document.getElementById('view-modal');
    const deleteForm = document.getElementById('delete-form');
    const deleteModal = document.getElementById('delete-modal');

    // Função para preencher campos de edição
    function populateEditForm(button) {
        const userId = button.getAttribute('data-user-id');
        const userName = button.getAttribute('data-user-name');
        const userEmail = button.getAttribute('data-user-email');
        const userPhone = button.getAttribute('data-user-phone');
        const userCpfCnpj = button.getAttribute('data-user-cpf_cnpj');
        const userCep = button.getAttribute('data-user-cep');
        const userRua = button.getAttribute('data-user-rua');
        const userBairro = button.getAttribute('data-user-bairro');
        const userCidade = button.getAttribute('data-user-cidade');
        const userRole = button.getAttribute('data-user-role');

        document.getElementById('edit-name').value = userName;
        document.getElementById('edit-email').value = userEmail;
        document.getElementById('edit-phone').value = userPhone;
        document.getElementById('edit-cpf_cnpj').value = userCpfCnpj;
        document.getElementById('edit-cep').value = userCep;
        document.getElementById('edit-rua').value = userRua;
        document.getElementById('edit-bairro').value = userBairro;
        document.getElementById('edit-cidade').value = userCidade;
        document.getElementById('edit-role').value = userRole;

        const form = document.getElementById('edit-user-form');
        form.action = `/users/${userId}`;

        editModal.classList.remove('hidden');
        editModal.setAttribute('aria-hidden', 'false');
        editModal.setAttribute('role', 'dialog');
    }

    // Função para preencher campos de visualização
    function populateViewModal(button) {
        const userName = button.getAttribute('data-user-name');
        const userEmail = button.getAttribute('data-user-email');
        const userPhone = button.getAttribute('data-user-phone');
        const userCpfCnpj = button.getAttribute('data-user-cpf_cnpj');
        const userCep = button.getAttribute('data-user-cep');
        const userRua = button.getAttribute('data-user-rua');
        const userBairro = button.getAttribute('data-user-bairro');
        const userCidade = button.getAttribute('data-user-cidade');
        const userRole = button.getAttribute('data-user-role');
        const userCreatedAt = button.getAttribute('data-user-created_at');
        const userUpdatedAt = button.getAttribute('data-user-updated_at');

        document.querySelector('.modal-user-name').textContent = userName;
        document.querySelector('.modal-user-email').textContent = userEmail;
        document.querySelector('.modal-user-phone').textContent = userPhone;
        document.querySelector('.modal-user-cpf_cnpj').textContent = userCpfCnpj;
        document.querySelector('.modal-user-cep').textContent = userCep;
        document.querySelector('.modal-user-rua').textContent = userRua;
        document.querySelector('.modal-user-bairro').textContent = userBairro;
        document.querySelector('.modal-user-cidade').textContent = userCidade;
        document.querySelector('.modal-user-role').textContent = userRole;
        document.querySelector('.modal-user-created_at').textContent = userCreatedAt;
        document.querySelector('.modal-user-updated_at').textContent = userUpdatedAt;

        viewModal.classList.remove('hidden');
        viewModal.setAttribute('aria-hidden', 'false');
        viewModal.setAttribute('role', 'dialog');
    }

    // Função para configurar o formulário de exclusão
    function setupDeleteForm(button) {
        const userId = button.getAttribute('data-user-id');
        deleteForm.action = `/users/${userId}`;
        deleteModal.classList.remove('hidden');
        deleteModal.setAttribute('aria-hidden', 'false');
        deleteModal.setAttribute('role', 'dialog');
    }

    editButtons.forEach(button => {
        button.addEventListener('click', function () {
            populateEditForm(this);
        });
    });

    viewButtons.forEach(button => {
        button.addEventListener('click', function () {
            populateViewModal(this);
        });
    });

    deleteButtons.forEach(button => {
        button.addEventListener('click', function () {
            setupDeleteForm(this);
        });
    });

    closeModalButtons.forEach(button => {
        button.addEventListener('click', function () {
            const targetModal = this.getAttribute('data-modal-toggle');
            const modal = document.getElementById(targetModal);

            modal.classList.add('hidden');
            modal.setAttribute('aria-hidden', 'true');
            modal.removeAttribute('role');
        });
    });

    window.addEventListener('click', function (event) {
        if (event.target == editModal) {
            editModal.classList.add('hidden');
            editModal.setAttribute('aria-hidden', 'true');
            editModal.removeAttribute('role');
        } else if (event.target == viewModal) {
            viewModal.classList.add('hidden');
            viewModal.setAttribute('aria-hidden', 'true');
            viewModal.removeAttribute('role');
        } else if (event.target == deleteModal) {
            deleteModal.classList.add('hidden');
            deleteModal.setAttribute('aria-hidden', 'true');
            deleteModal.removeAttribute('role');
        }
    });

    // Função para consultar a API ViaCEP
    function pesquisacep(valor) {
        var cep = valor.replace(/\D/g, '');

        if (cep.length === 8) {
            fetch(`https://viacep.com.br/ws/${cep}/json/`)
                .then(response => response.json())
                .then(data => {
                    if (!("erro" in data)) {
                        document.getElementById('rua').value = data.logradouro;
                        document.getElementById('bairro').value = data.bairro;
                        document.getElementById('cidade').value = data.localidade;
                    } else {
                        alert("CEP não encontrado.");
                    }
                })
                .catch(error => {
                    console.error('Erro ao buscar CEP:', error);
                });
        } else {
            alert("Formato de CEP inválido.");
        }
    }

    // Adiciona o evento ao campo de CEP
    const cepInput = document.getElementById('cep');
    if (cepInput) {
        cepInput.addEventListener('blur', function () {
            pesquisacep(this.value);
        });
    }
});
