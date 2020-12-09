<?php

namespace App\Controllers;
use App\Controllers\Base\Action;
use App\Container;

class DatabaseController extends Action
{
    public function index() {
        $criaTabela = Container::getModel('CriaTabela');
        $criaTabela->criaTabelas();
        $this->view->msg = "Tabelas criadas";
        $this->render('index', 'layout');
    }
}