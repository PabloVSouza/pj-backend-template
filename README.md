# Sistema de backend simples em php com MVC (Camada View abstraida para usar frontends externos)

 - Sistema de ORM (PHPActiveRecord)
 - Sistema de rotas com o padrão /controller/method/parameter
 - Autenticação por JWT
 
 ## Configuração do banco de dados

app/classes/Parametros.php
```
    // Banco de dados
    $host     = 'IP SERVIDOR';
    $user     = 'USER MYSQL';
    $pass     = 'SENHA MYSQL';
    $database = 'DB MYSQL';
```
 
## Instalação

```
composer install
```

## Hospedagem

```
php -S 0.0.0.0:{porta} -t public

```
