window.onload = function () {//quando o ponteiro do mouse estiver no input senha ele rola a tela pra baixo
    // Obtém a referência para o input específico
    var input = document.getElementById('senha');

    // Adiciona um ouvinte de eventos para o evento de foco (quando o input recebe o foco)
    input.addEventListener('focus', function () {
        // Rola a tela para baixo para o input específico
        this.scrollIntoView();
    });
};

function mostrarsenha() {
    var senhaInput = document.getElementById("senha");
    if (senhaInput.type === "password") {
        senhaInput.type = "text";
    } else {
        senhaInput.type = "password";
    }
}
function confirmarExclusaoMercado() {
    // Exibe uma mensagem de confirmação
    if (confirm("Tem certeza que deseja excluir seu perfil?")) {
        // Se o usuário confirmar, redireciona para a página de exclusão
        window.location.href = 'CRUD/delete-cliente.php';
        return true;
    } else {
        // Se o usuário cancelar, retorna false
        return false;
    }
}