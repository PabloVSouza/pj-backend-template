<?php

namespace app\controllers\home;

use app\controllers\ContainerController;


class HomeController extends ContainerController
{
  public function index()
  {
    header("Location: https://pjinformatica.org");
  }
}
