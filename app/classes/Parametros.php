<?php

namespace app\classes;

class Parametros
{

  private static $url = '';

  //Parametros de autenticação do JWT
  public static $jwt_key = "";
  public static $jwt_iss = "http://pjinformatica.org";
  public static $jwt_aud = "http://pjinformatica.org";

  public function __construct()
  {

    // Banco de dados Integrator
    // $host     = 'mysql.pjinformatica.org';
    // $user     = 'pjinform_dev';
    // $pass     = 'a1b2c3d4e5';
    // $database = 'pjinform_venda_remota';

    // Banco de dados local
    // $host     = '127.0.0.1';
    // $user     = 'root';
    // $pass     = 'pjinfo1779';
    // $database = 'venda_web';

    // Banco de dados Heroku
    $url      = getenv('JAWSDB_MARIA_URL');
    $dbparts  = parse_url($url);
    $host     = $dbparts['host'];
    $user     = $dbparts['user'];
    $pass     = $dbparts['pass'];
    $database = ltrim($dbparts['path'], '/');


    //PHP Active Record

    $cfg = \ActiveRecord\Config::instance();
    $cfg->set_model_directory('../app/models');
    $conn = "mysql://$user:$pass@$host/$database?charset=utf8";
    $cfg->set_connections(array('development' => $conn));
  }
}
