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
    
    return  confirm("Tem certeza que deseja excluir esse perfil?")
      
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

function confirmarLimparCarrinho() {
    // Exibe uma mensagem de confirmação
    if (confirm("Tem certeza que deseja limpar o carrinho?")) {
        // Se o usuário confirmar, redireciona para a página de exclusão
        window.location.href = '../CRUD/limpar_carrinho.php';
        return true;
    } else {
        // Se o usuário cancelar, retorna false
        return false;
    }
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

function validartel(){
    var tel = document.getElementById("tel");
    if(tel.value.length !== 11){
        alert("O telefone deve conter 11 digitos.");
        return false; // Impede o envio do formulário
        
    }return true;
}

function formatarPreco(input) {
    var valor = input.value.replace(/[^\d]/g, ''); // Remove caracteres não numéricos
    valor = valor.replace(/(\d{2})$/, ',$1'); // Adiciona vírgula antes das duas últimas casas decimais
    valor = valor.replace(/(\d)(?=(\d{3})+(?!\d))/g, '$1.'); // Adiciona ponto a cada três dígitos, da direita para a esquerda
    input.value = valor;
}


function displayFileName() {
    var input = document.getElementById('foto');
    var fileNameDisplay = document.getElementById('fileNameDisplay');

    if (input.files.length > 0) {
        var fileName = input.files[0].name;
        fileNameDisplay.textContent = 'Arquivo selecionado: ' + fileName;
    } else {
        fileNameDisplay.textContent = '';
    }
}

function compras() {
    var inputSim = document.getElementById("compras");
    var formularioAdicional = document.getElementById("formulario-adicional");

    if (inputSim.checked) {
        // Carregar o conteúdo do arquivo PHP com o formulário adicional
        fetch('../cadastro/cadastroInfopag.php')
            .then(response => response.text())
            .then(data => {
                formularioAdicional.innerHTML = data;
            });

        // Exibir o formulário adicional
        formularioAdicional.style.display = "block";
    } else {
        // Ocultar o formulário adicional
        formularioAdicional.style.display = "none";
    }
}

