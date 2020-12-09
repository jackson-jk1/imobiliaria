<?php


namespace App\Models;
use App\Models\Base\Model;

/**
 * Class Administrador
 * @package App\Models
 */
class Administrador extends Model
{
    private $id_usuario;
    private $nome;
    private $email;
    private $senha;

    public function __get($atributo){
        return $this->$atributo;
    }

    public function __set($atributo, $valor){
        $this->$atributo = $valor;
    }

    /**
     * @return $this
     */
    public function salvar(){
        try {
            $query = "INSERT INTO grr20193920_administradores (nome, email, senha) VALUES (:nome, :email, :senha)";
            $stmt = $this->db->prepare($query);
            $stmt->bindValue(':nome', $this->__get('nome'));
            $stmt->bindValue(':email', $this->__get('email'));
            $stmt->bindValue(':senha', $this->__get('senha'));
            $stmt->execute();
            return $this;
        } catch (\PDOException $e) {
            throw new $e;
        }
    }

    /**
     * @param int $id
     * @return array
     */
    public function procurar(int $id) {
        try {


            $query = "SELECT id_usuario, nome, email, senha FROM grr20193920_administradores WHERE id_usuario = :id";
            $stmt = $this->db->prepare($query);
            $stmt->bindValue(':id', $id);
            $stmt->execute();
            return $stmt->fetchAll(\PDO::FETCH_ASSOC);
        } catch (\PDOException $e) {
            throw new $e;
        }
    }

    public function deletar(int $id){
        try {
            $query = "DELETE FROM grr20193920_administradores WHERE id_usuario = :id";
            $stmt = $this->db->prepare($query);
            $stmt->bindValue(':id', $id);
            $stmt->execute();
            return $stmt->fetchAll(\PDO::FETCH_ASSOC);
        } catch (\PDOException $e) {
            throw new $e;
        }

    }

    /**
     * @return bool
     */
    public function editar(){
        try {
            $query = "UPDATE grr20193920_administradores SET nome = :nome, email = :email, senha = :senha WHERE id_usuario = :id_usuario";
            $stmt = $this->db->prepare($query);
            $stmt->bindValue(':nome', $this->__get('nome'));
            $stmt->bindValue(':email', $this->__get('email'));
            $stmt->bindValue(':senha', $this->__get('senha'));
            $stmt->bindValue(':id_usuario', $this->__get('id_usuario'));
            $stmt->execute();
            return true;
        } catch (\PDOException $e) {
            throw new $e;
        }
    }
    /**
     * @return array
     */
    public function procurarTodos() {
        try {
            $query = "SELECT id_usuario, nome, email FROM grr20193920_administradores";
            $stmt = $this->db->prepare($query);
            $stmt->execute();
            return $stmt->fetchAll(\PDO::FETCH_ASSOC);
        } catch (\PDOException $e) {
            throw $e;
        }
    }

    public function autenticar(){
        $query = "SELECT id_usuario, nome, email FROM grr20193920_administradores WHERE email = :email AND senha = :senha";
        $stmt = $this->db->prepare($query);
        $stmt->bindValue(':email', $this->__get('email'));
        $stmt->bindValue(':senha', $this->__get('senha'));
        $stmt->execute();

        $adm = $stmt ->fetch(\PDO::FETCH_ASSOC);

        if($adm['id_usuario'] != '' && $adm['nome'] != ''){
            $this->__set('id_usuario', $adm['id_usuario']);
            $this->__set('nome', $adm['nome']);
        }

        return $adm;
    }


    public function SenhaPorEmail(){
        $query = "SELECT id_usuario, nome, email FROM grr20193920_administradores WHERE email = :email ";
        $stmt = $this->db->prepare($query);
        $stmt->bindValue(':email', $this->__get('email'));
        $stmt->execute();

        $adm = $stmt ->fetch(\PDO::FETCH_ASSOC);

        if($adm == false){
            return $adm;
        }
        else if($adm['id_usuario'] != '' && $adm['nome'] != ''){
            $this->__set('id_usuario', $adm['id_usuario']);
            $this->__set('nome', $adm['nome']);
            return $adm;
        }

    }

    
    public function getPorEmail() {
        try {
            $query = "SELECT nome, email FROM grr20193920_administradores WHERE email = :email";
            $stmt = $this->db->prepare($query);
            $stmt->bindValue(':email', $this->__get('email'));
            $stmt->execute();
            return $stmt->fetchAll(\PDO::FETCH_ASSOC);
        } catch (\PDOException $e) {
            throw $e;
        }
    }


}