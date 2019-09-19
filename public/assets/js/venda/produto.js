divSelecionaProduto = $('.venda-divSelecionaProduto');
tableSelProdutos = $('.venda-tableSelProdutos tbody');
txtBuscaProduto = $('.venda-txtBuscaProduto');
botaoAddProduto = $('.detalhaVenda-botaoAddProduto');


//Testando quando algum produto é digitado na busca
txtBuscaProduto.typeWatch({
    callback: function() {
        buscaProduto(txtBuscaProduto.val());
    },
    wait: 100,
    highlight: false,
    captureLength: 0
});

//Função que atualiza o resultado do produto buscado
function buscaProduto(produto) {
    $.get('produtos/buscaProduto/' + produto).done(function(response) {

        objClientes = JSON.parse(response);

        tableSelProdutos.empty();

        $.each(objClientes, function(produto) {

            valor = (produto.valor_vend).toFixed(2).replace(".", ",");

            tableSelProdutos.append(
                "<tr idProduto=\"" + valor.id + "\">" +
                "<td>" + produto.cod_est + "</td>" +
                "<td>" + produto.descricao + "</td>" +
                "<td>R$ " + valor + "</td>" +
                "</tr>"
            );
        });

    });
}

function adicionaProduto(venda){
    bloqueiaTela();
    buscaProduto('');
    divSelecionaProduto.toggleClass('visivel');
}