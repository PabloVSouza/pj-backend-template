<?php

namespace app\classes;

class Parametros
{

  private static $url = '';

  //Parametros de autenticação do JWT
  public static $jwt_key = "";
  public static $jwt_iss = "ISS do JWT";
  public static $jwt_aud = "AUD do JWT";

  public function __construct()
  {

    // Banco de dados
    $host     = 'IP SERVIDOR';
    $user     = 'USER MYSQL';
    $pass     = 'SENHA MYSQL';
    $database = 'DB MYSQL';

    // Banco de dados se for Heroku
    // $url      = getenv('JAWSDB_MARIA_URL');
    // $dbparts  = parse_url($url);
    // $host     = $dbparts['host'];
    // $user     = $dbparts['user'];
    // $pass     = $dbparts['pass'];
    // $database = ltrim($dbparts['path'], '/');


    //PHP Active Record

    $cfg = \ActiveRecord\Config::instance();
    $cfg->set_model_directory('../app/models');
    $conn = "mysql://$user:$pass@$host/$database?charset=utf8";
    $cfg->set_connections(array('development' => $conn));
  }
}
