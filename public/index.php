<?php

require '../bootstrap.php';

use app\classes\Parametros;
use app\classes\Uri;
use core\Controller;
use core\Method;
use core\Parameters;

try {

  // header("Access-Control-Allow-Origin: *");
  // header("Access-Control-Allow-Headers: Content-Type");
  // header('Content-Type: application/json');

  header("Access-Control-Allow-Origin: *");
  header("Access-Control-Allow-Methods: POST");
  header("Access-Control-Max-Age: 3600");
  header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");

  date_default_timezone_set('America/Sao_Paulo');

  $parametros_projeto = new Parametros;

  $controller = new Controller;
  $controller = $controller->load();

  $method = new Method;
  $method = $method->load($controller);

  $parameters = new Parameters;
  $parameters = $parameters->load();

  $controller->$method($parameters);
} catch (\Exception $e) {
  var_dump($e->getMessage());
}
