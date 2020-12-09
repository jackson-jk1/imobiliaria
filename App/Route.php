<?php

namespace App;

use App\Bootstrap;

/**
 * Class Route
 * @package App
 */
class Route extends Bootstrap {

    protected function initRoutes(){
        $routes['criabd'] = array(
            'route' => '/criabd',
            'controller' => 'DatabaseController',
            'action' => 'index'
        );

        $routes['home'] = array(
            'route' => '/',
            'controller' => 'IndexController',
            'action' => 'index'
        );

        $routes['todosimoveis'] = array(
            'route' => '/todosimoveis',
            'controller' => 'IndexController',
            'action' => 'listarTodosImoveis'
        );

        $routes['login'] = array(
            'route' => '/login',
            'controller' => 'IndexController',
            'action' => 'login'
        );

        $routes['recuperarSenha'] = array(
            'route' => '/recuperarSenha',
            'controller' => 'IndexController',
            'action' => 'recuperarSenha'
        );

        $routes['logout'] = array(
            'route' => '/logout',
            'controller' => 'IndexController',
            'action' => 'logout'
        );

        //Retorna um objeto preenchido de um imóvel de acordo com o id passado em get
        $routes['imovel'] = array(
            'route' => '/imovel',
            'controller' => 'IndexController',
            'action' => 'getInformacoesImovel'
        );

        //Dashboard do administrador do sistema
        $routes['dashboard'] = array(
            'route' => '/dashboard',
            'controller' => 'DashboardController',
            'action' => 'index'
        );

        //Retorna uma array com todos os imoveis cadastrados no banco
        $routes['listarimoveis'] = array(
            'route' => '/dashboard/listarimoveis',
            'controller' => 'ImovelController',
            'action' => 'listarImoveis'
        );

        //Retorna uma array com todos os administradores cadastrados no banco
        $routes['listaradministradores'] = array(
            'route' => '/dashboard/listaradministradores',
            'controller' => 'AdministradorController',
            'action' => 'listarAdministradores'
        );

        //Verificação de post determina se deve exibir a página de cadastro ou realizar cadastro
        $routes['cadastrarimovel'] = array(
            'route' => '/dashboard/cadastrarimovel',
            'controller' => 'ImovelController',
            'action' => 'criar'
        );

        //Verificação de post determina se deve exibir a página de cadastro ou realizar cadastro
        $routes['cadastraradministrador'] = array(
            'route' => '/dashboard/cadastraradministrador',
            'controller' => 'AdministradorController',
            'action' => 'criar'
        );

        //Ação de deleção de imóvel passando um id por get, pode ser feito utilizando AJAX
        $routes['deletarimovel'] = array(
            'route' => '/dashboard/deletarimovel',
            'controller' => 'ImovelController',
            'action' => 'deletar'
        );

        //Ação de deleção de administrador passando um id por get, pode ser feito utilizando AJAX
        $routes['deletaradministrador'] = array(
            'route' => '/dashboard/deletaradministrador',
            'controller' => 'AdministradorController',
            'action' => 'deletar'
        );

        //Verificação de post determina se deve exibir a página de edição com o objeto preenchido (através de um id enviado por get) ou realizar a edição no banco
        $routes['editarimovel'] = array(
            'route' => '/dashboard/editarimovel',
            'controller' => 'ImovelController',
            'action' => 'editar'
        );

        //Verificação de post determina se deve exibir a página de edição com o objeto preenchido (através de um id enviado por get) ou realizar a edição no banco
        $routes['editaradministrador'] = array(
            'route' => '/dashboard/editaradministrador',
            'controller' => 'AdministradorController',
            'action' => 'editar'
        );

        $this->setRoutes($routes);
    }
}


?>