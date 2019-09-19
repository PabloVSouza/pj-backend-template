 formLogin = $('#login-divFormLogin');
 txtLogin = $('#login-txtLogin');
 txtSenha = $('#login-txtSenha');
 btnLogar = $('#login-btnLogar');
 msgLogin = $('#login-spanMsgLogin');

 txtLogin.focus();

function loga(){

    $.post("login/autentica", {
        login: txtLogin.val(),
        senha: txtSenha.val()
    }).done(function (response) {

        if (response == "false") {
            msgLogin.html("Usuário ou senha Incorretos.");
        } else {
            document.location.href = '/';
        }

    }).fail(function () {
        console.log('Ocorreu um Erro');
    });

}

formLogin.keyup(function (event) {
    if (event.keyCode === 13) {
        loga();
    }
});