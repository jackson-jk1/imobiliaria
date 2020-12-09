<?php


namespace App\Controllers;
use App\Controllers\Base\Action;
use App\Container;

class ImovelController extends Action
{
    public function listarImoveis() {
       // $this->validaAutenticacao();
        $imovelModel = Container::getModel('Imovel');
        $imoveis = $imovelModel->procurarTodos();
        $this->view->imoveis = $imoveis;
        $this->render('listarimoveis', 'layout');
    }

    public function criar() {
        try {
           $this->validaAutenticacao();
            if ($_SERVER['REQUEST_METHOD'] === 'POST') {
                if (empty($_POST['titulo']) || empty($_POST['descricao'])) {
                    header('Location: /dashboard/cadastrarimovel?erro=validacao');
                    return;
                }
                $imovel = Container::getModel('Imovel');
                if (!empty($_FILES['imagem'])) {
                    $imagem           = $_FILES["imagem"];
                    $titulo_imagem    = $imagem["name"];
                    $tmp              = $imagem["tmp_name"];
                    $formato          = pathinfo($titulo_imagem, PATHINFO_EXTENSION);
                    $tamanho          = $imagem["size"];
                    if ($formato == "jpg" || $formato == "png" && $tamanho <= 2000000) {
                        $imagemNome = uniqid(date('HisYmd')) . "." . $formato;
                        move_uploaded_file($tmp, 'img/imoveis/' . $imagemNome);
                        $imovel->__set('imagem', $imagemNome);
                        echo $imagemNome;
                    } else {
                        header('Location: /dashboard/cadastrarimovel?erro=arquivojpgpng');
                        return;
                    }
                }
                $imovel->__set('titulo', $_POST['titulo']);
                $imovel->__set('descricao', $_POST['descricao']);
                $imovel->salvar();
                header('Location: /dashboard/cadastrarimovel?sucesso=true');
            }
        } catch (\PDOException $e) {
            echo $e->getMessage();
            die();
        }
        $this->render('cadastrarimovel', 'layout');
    }

    public function deletar() {
        try{
            if (empty($_GET['id'])) {
                header('Location: /dashboard/listarimoveis?erro=semid');
                return;
            }
            $id_imovel = $_GET['id'];
            $imovelModel = Container::getModel('Imovel');
            $imovel = $imovelModel->procurar($id_imovel);
            if (count($imovel) == 0) {
                header('Location: /dashboard/listarimoveis?erro=encontrarid');
                return;
            }
            $imovelModel->deletar($imovel[0]['id_imovel']);
            header('Location: /dashboard/listarimoveis?sucesso=true');
        } catch (\PDOException $e) {
            echo $e->getMessage();
            die();
        }
    }


    public function editar() {

        try {
            $this->validaAutenticacao();
            if (!empty($_GET['erro'])) {
                header('Location: /dashboard/listarimoveis?erro=arquivojpgpng');
                return;
            }

            if (empty($_GET['id'])) {
                header('Location: /dashboard/listarimoveis?erro=semid');
                return;
            }

           $id_imovel = $_GET['id'] ?? $_POST['id'];
           $imovelModel = Container::getModel('Imovel');
           $imovel = $imovelModel->procurar($id_imovel);
           if (count($imovel) == 0) {
               header('Location: /dashboard/listarimoveis?erro=encontrarid');
               return;
           }

           $imovelModel->__set('id_imovel', $imovel[0]['id_imovel']);
           $imovelModel->__set('titulo', $imovel[0]['titulo']);
           $imovelModel->__set('descricao', $imovel[0]['descricao']);
           $imovelModel->__set('imagem', $imovel[0]['imagem']);

           if ($_SERVER['REQUEST_METHOD'] === 'POST') {
               if (empty($_POST['titulo']) || empty($_POST['descricao']) || empty($_FILES["imagem"])) {
                   header('Location: /dashboard/editarimovel?erro=validacao');
                   return;
               }
               if (!empty($_FILES['imagem'])) {
                   $imagem = $_FILES["imagem"];
                   $titulo_imagem = $imagem["name"];
                   $tmp = $imagem["tmp_name"];
                   $formato = pathinfo($titulo_imagem, PATHINFO_EXTENSION);
                   $tamanho = $imagem["size"];
                   if ($formato == "jpg" || $formato == "png" && $tamanho <= 2000000) {
                       $imagemNome = uniqid(date('HisYmd')) . "." . $formato;
                       move_uploaded_file($tmp, 'img/imoveis/' . $imagemNome);
                       $imovelModel->__set('imagem', $imagemNome);
                       echo $imagemNome;
                   } else {
                       header('Location: /dashboard/editarimovel?erro=arquivojpgpng');
                       return;
                   }
               }
               $imovelModel->__set('titulo', $_POST['titulo']);
               $imovelModel->__set('descricao', $_POST['descricao']);
               $imovelModel->editar();
               header('Location: /dashboard/listarimoveis?sucesso=true');
               return;
           }
           $this->view->imovel = $imovelModel;
           $this->render('editarimovel', 'layout');
       } catch (\PDOException $e) {
            echo $e->getMessage();
            die();
        }
    }
}