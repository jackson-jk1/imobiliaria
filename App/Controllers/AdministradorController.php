<?php


namespace App\Controllers;
use App\Controllers\Base\Action;
use App\Container;

class AdministradorController extends Action
{
    public function listarAdministradores() {
        try {
            //$this->validaAutenticacao();
            $administrador = Container::getModel('Administrador');
            $administradores = $administrador->procurarTodos();
            $this->view->administradores = $administradores;
            $this->render('listaradministradores', 'layout');
        } catch (\PDOException $e) {
            echo $e->getMessage();
            die();
        }
    }
    public function criar() {
        $this->validaAutenticacao();
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {

           if (empty($_POST['nome']) || empty($_POST['email'])|| empty($_POST['senha'])) {  
               header('Location: /dashboard/cadastraradministrador?erro=validacao');
               return; }
            try {
                $administrador = Container::getModel('Administrador');
                $administrador->__set('nome', $_POST['nome']);
                $administrador->__set('email', $_POST['email']);
                $administrador->__set('senha', md5($_POST['senha']));
                if (count($administrador->getPorEmail()) == 0) {
                    $administrador->salvar();
                    $this->view->msg = "Cadastro realizado com sucesso";
                } else {
                    header('Location: /dashboard/cadastraradministrador?erro=existe');
                    return;
                }
            } catch (\PDOException $e) {
                echo $e->getMessage();
                die();
            }
        }
        $this->render('cadastraradministrador', 'layout');
    }

    public function deletar() {
        try{
        if (empty($_GET['id'])) {
            header('Location: /dashboard/listaradministradores?erro=semid');
            return;
        }
        $id_administrador       = $_GET['id'];
        $administradorModel     = Container::getModel('Administrador');
        $administrador          = $administradorModel->procurar($id_administrador);

        if (count($administrador) == 0) {
            header('Location: /dashboard/listaradministradores?erro=encontrarid');
            return;
        }
        $administradorModel->deletar($administrador[0]['id_usuario']);
        header('Location: /dashboard/listaradministradores?sucesso=true');
        return;
    } catch (\PDOException $e) {
        echo $e->getMessage();
        die();
        }
    }

    public function editar() {

        try {
            $this->validaAutenticacao();
            if (!empty($_GET['sucesso'])) {
                header('Location: /dashboard/listaradministradores?sucesso=true');
                return;
            }
            if (empty($_GET['id'])) {
                header('Location: /dashboard/listaradministradores?erro=semid');
                return;
            }
            $id_administrador       = $_GET['id'] ?? $_POST['id'];
            $administradorModel     = Container::getModel('Administrador');
            $administrador          = $administradorModel->procurar($id_administrador);

            if (count($administrador) == 0) {
                header('Location: /dashboard/listaradministradores?erro=encontrarid');
                return;
            }

            $administradorModel->__set('id_usuario', $administrador[0]['id_usuario']);
            $administradorModel->__set('nome', $administrador[0]['nome']);
            $administradorModel->__set('email', $administrador[0]['email']);
            $administradorModel->__set('senha', $administrador[0]['senha']);

            if ($_SERVER['REQUEST_METHOD'] === 'POST') {
                if (!empty($_POST['senha'])) {
                    $administradorModel->__set('senha', md5($_POST['senha']));
                }
                $administradorModel->__set('nome', $_POST['nome']);
                $administradorModel->__set('email', $_POST['email']);
                $administradorModel->editar();
                header('Location: /dashboard/editaradministrador?sucesso=true');
                return;

          

            }
            $this->view->administrador = $administradorModel;
            $this->render('editaradministrador', 'layout');
        } catch (\PDOException $e) {
            echo $e->getMessage();
            die();
        }
    }
}