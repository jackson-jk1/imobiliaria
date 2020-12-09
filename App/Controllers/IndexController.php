<?php

namespace App\Controllers;
use App\Controllers\Base\Action;
use App\Container;

class IndexController extends Action {

    public function index(){
        $imoveis = Container::getModel('Imovel');
        $imoveis = $imoveis->procurarTodosComLimit();
        $this->view->imoveis = $imoveis;
        $this->render('index', 'layout');
    }

    public function recuperarSenha()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        $administrador = Container::getModel('Administrador');
        $administrador->__set('email', $_POST['email']);
        $usuario = $administrador->SenhaPorEmail();
        if ($usuario == false) {
            $this->view->msg = "O Email informado é invalido";
        } else {
            $novaSenha = uniqid(date('HisYmd'));
            $administrador->__set('senha', md5($novaSenha));
            $administrador->editar();
            $mensagem = Container::getModel('Email');
            $mensagem->__set('mensagem', ($novaSenha));
            $mensagem->__set('para', $_POST['email']);
            $mensagem->__set('assunto', 'Sua Nova Senha');
            $mensagem->mensagemValida();
            header('Location: /login?sucesso=true');

        }
    }

        $this->render('recuperarSenha', 'layout');
    }
    public function listarTodosImoveis() {
        $imoveis = Container::getModel('Imovel');
        $imoveis = $imoveis->procurarTodos();
        $this->view->imoveis = $imoveis;
        $this->render('todosimoveis', 'layout');
    }

    public function login(){
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $administrador = Container::getModel('Administrador');
            $administrador->__set('email', $_POST['email']);
            $administrador->__set('senha', MD5($_POST['senha']));
            $administrador->autenticar();
            if($administrador->__get('id_usuario') != '' && $administrador->__get('nome')){
                session_start();
                $_SESSION['id_usuario']     = $administrador->__get('id_usuario');
                $_SESSION['nome']   = $administrador->__get('nome');
                print_r($_SESSION);

                header('Location: /dashboard');
            } else {
                header('Location: /?login=erro');
            }
        }
        $this->render('login', 'layout');
    }

    public function getInformacoesImovel() {
        if (empty($_GET['id'])) {
            echo("É obrigatório passar um id");
            die();
        }

        $id_imovel       = $_GET['id'] ?? $_POST['id'];
        $imovelModel     = Container::getModel('Imovel');
        $imovel          = $imovelModel->procurar($id_imovel);

        if (count($imovel) == 0) {
            echo "Nenhum imóvel com o id ".$id_imovel." foi encontrado!";
            die();
        }

        $imovelModel->__set('id_imovel', $imovel[0]['id_imovel']);
        $imovelModel->__set('titulo', $imovel[0]['titulo']);
        $imovelModel->__set('descricao', $imovel[0]['descricao']);
        $imovelModel->__set('imagem', $imovel[0]['imagem']);
        $this->view->imovel = $imovelModel;
        $this->render('informacoes', 'layout');
    }

    public function logout(){
        session_start();
        session_destroy();
        header('Location: /');
    }
}

?>