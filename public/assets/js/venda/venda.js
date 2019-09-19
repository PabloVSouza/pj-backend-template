//Executar automaticamente ao carregar a página
$(document).ready(function() {
    montaAbas();
});

//Declarando variáveis e atribuindo a elementos dom
divCoberturaVenda = $('.venda-divCoberturaVenda');
divAbasVenda = $('.venda-divAbasVenda');
divConteudoAba = $('.venda-divConteudoAba');

vendaAtual = 0;
novaAbaGlobal = false;

//Função que exibe ou esconde o bloqueio da tela
function bloqueiaTela() {
    divCoberturaVenda.toggleClass('visivel');
}

//Testando quando a cobertura é clicada
divCoberturaVenda.on('click', function(){
    novaAbaGlobal = false;
    var visivel = $('.visivel');
    visivel.toggleClass('visivel');
    bloqueiaTela();
});

//Função que Exibe a aba clicada
function abreAba(e, aba) {
    $.get("vendas/mostravenda/" + aba).done(function(response) {
        divConteudoAba.html(response);
    });

    var botaoAba = $('.venda-btnBotaoAba');

    botaoAba.each(function() {
        if ($(this).hasClass('active')) {
            $(this).toggleClass('active');
        }
    });

    e.toggleClass('active');
}

//Função que monta as abas existentes na tela
function montaAbas() {

    $.get("vendas/contaVendas").done(function(response) {
        divAbasVenda.empty();

        if (response > 0) {
            for (let i = 0; i < response; i++) {

                divAbasVenda.append('<button class="venda-btnBotaoAba" onclick="abreAba($(this),' +  (i + 1) + ')">Venda ' + (i + 1) + '</button>');

            }
            divAbasVenda.append('<button class="venda-btnBotaoAba" onclick = "mostraSelCliente(true)" > +</button >');
            divCoberturaVenda.click();
            var botaoAba = $('.venda-btnBotaoAba');

            botaoAba[0].click();

        } else {
            criaVenda();
        }
    });
}

function adicionaAba(cliente){
    alert('oi');
}