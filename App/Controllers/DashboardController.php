<?php


namespace App\Controllers;
use App\Controllers\Base\Action;
use App\Container;

class DashboardController extends Action
{
    public function index() {
        $this->render('index', 'layout');
    }
}