function validateForm() {
    const form = document.querySelector('form');
    const button = document.getElementById('saveButton');
    button.disabled = !form.checkValidity();
    const nome = document.getElementById('nome').value;
    const sobrenome = document.getElementById('sobrenome').value;
    const email = document.getElementById('email').value;
    const saveButton = document.getElementById('saveButton');

    // Habilitar botão somente se todos os campos obrigatórios estiverem preenchidos
    if (nome.length >= 3 && sobrenome.length >= 3 && email) {
        saveButton.disabled = false;
    } else {
        saveButton.disabled = true;
    }
}

// Inicializa o estado do botão salvar
document.addEventListener("DOMContentLoaded", function() {
    validateForm();
});
