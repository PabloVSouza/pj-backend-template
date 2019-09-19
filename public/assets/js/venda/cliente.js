tableSelClientes = $('.venda-tableSelClientes tbody');
divSelecionaCliente = $('.venda-divSelecionaCliente');
txtBuscaCliente = $('.venda-txtBuscaCliente');



//Testando quando algum cliente é digitado ba busca
txtBuscaCliente.typeWatch({
    callback: function() {
        buscaCliente(txtBuscaCliente.val());
    },
    wait: 100,
    highlight: false,
    captureLength: 0
});

//Função que atualiza o resultado do cliente buscado
function buscaCliente(cliente) {
    $.get('clientes/buscaClienteNome/' + cliente).done(function(response) {

        objClientes = JSON.parse(response);

        tableSelClientes.empty();

        $.each(objClientes, function(key, valor) {
            tableSelClientes.append(
                "<tr idCliente=\"" + valor.id + "\">" +
                "<td>" + valor.codigo + "</td>" +
                "<td>" + valor.razao + "</td>" +
                "</tr>"
            );
        });

    });
}

//Capturando o cliente selecionado
tableSelClientes.on('click', 'tr', function() {
    if (novaAbaGlobal === true) {
        adicionaAba($(this).attr("idcliente"));
    }
    else {
        defineClienteVenda($(this).attr("idcliente"), vendaAtual);
    }
})

//Exibe a tela de seleção de cliente
function mostraSelCliente(novaAba) {
    bloqueiaTela();
    buscaCliente('');
    divSelecionaCliente.toggleClass("visivel");

    novaAbaGlobal = novaAba;
}

//Função que define o cliente da venda
function defineClienteVenda(cliente, venda = 0) {
    $.get("vendas/defineClienteVenda/" + venda + "/" + cliente).done(function(response) {
        if (response == "true") {
            montaAbas();
        }
    }).fail(function() {
        console.log('Ocorreu um Erro');
    });
}

function criaVenda(){
    vendaAtual = 1;
    bloqueiaTela();
    mostraSelCliente();
}