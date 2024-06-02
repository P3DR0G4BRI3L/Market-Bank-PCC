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
    return confirm("Tem certeza que deseja excluir seu mercado?\n Todos os seus produtos também vão ser excluídos");
}
function confirmarExclusaoCliente() {
    // Exibe uma mensagem de confirmação
    return confirm("Tem certeza que deseja excluir seu perfil?");
}


function confirmarExclusaoClienteadm() {
    // Exibe uma mensagem de confirmação
    if (confirm("Tem certeza que deseja excluir esse perfil?")) {
        // Se o usuário confirmar, redireciona para a página de exclusão
        window.location.href = '../CRUD/delclienteadm.php';
        return true;
    } else {
        // Se o usuário cancelar, retorna false
        return false;
    }
}

function confirmarExclusaoProduto() {
    // Exibe uma mensagem de confirmação
    if (confirm("Tem certeza que deseja excluir esse produto?")) {
        // Se o usuário confirmar, redireciona para a página de exclusão
        window.location.href = '../CRUD/delete-cliente.php';
        return true;
    } else {
        // Se o usuário cancelar, retorna false
        return false;
    }
}

function confirmarExclusaoPanfleto() {
    // Exibe uma mensagem de confirmação
    return confirm("Tem certeza que deseja excluir esse panfleto?"); 
}


function restringirLetras(input) {
    input.value = input.value.replace(/\D/g, ''); // Remove tudo que não é dígito
}

document.getElementById("cnpj").addEventListener("input", function() {
    this.value = this.value.replace(/\D/g, ''); // Remove tudo que não é dígito
    if (this.value.length > 14) {
        this.value = this.value.slice(0, 14);
    }
});

document.getElementById("telefone").addEventListener("input", function() {
    this.value = this.value.replace(/\D/g, ''); // Remove tudo que não é dígito
    if (this.value.length > 11) {
        this.value = this.value.slice(0, 11);
    }
});


function formatarPreco(input) {
    // Remove caracteres não numéricos, exceto vírgulas
    input.value = input.value.replace(/[^\d,]/g, '');

    // Substitui todas as vírgulas adicionais, exceto a primeira, por uma string vazia
    input.value = input.value.replace(/(.*),/, '$1').replace(/,/g, '');

    // Formata o preço para ter duas casas decimais
    var parts = input.value.split(',');
    if (parts.length > 1) {
        input.value = parts[0] + ',' + parts[1].substring(0, 2);
    }
}

function validarquant() {
    var cnpj = document.getElementById("cnpj");
    var tel = document.getElementById("telefone");
    if (cnpj.value.length !== 14) {
        alert("O CNPJ deve conter 14 caracteres.");
        return false; // Impede o envio do formulário
    }

    if (tel.value.length !== 11) {
        alert("O telefone deve conter 11 digitos.");
        return false; // Impede o envio do formulário
    }
    
    return true; // Permite o envio do formulário
}
