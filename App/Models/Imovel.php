<?php

namespace App\Models;
use App\Models\Base\Model;

class Imovel extends Model
{
    private $id_imovel;
    private $titulo;
    private $descricao;
    private $imagem;

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
        $query = "INSERT INTO grr20193920_imoveis (titulo, descricao, imagem) VALUES (:titulo, :descricao, :imagem)";
        $stmt = $this->db->prepare($query);
        $stmt->bindValue(':titulo', $this->__get('titulo'));
        $stmt->bindValue(':descricao', $this->__get('descricao'));
        $stmt->bindValue(':imagem', $this->__get('imagem'));
        $stmt->execute();
        return $this;
    }

    /**
     * @param int $id
     * @return array
     */
    public function procurar(int $id) {
        try {
            $query = "SELECT id_imovel, titulo, descricao, imagem FROM grr20193920_imoveis WHERE id_imovel = :id";
            $stmt = $this->db->prepare($query);
            $stmt->bindValue(':id', $id);

            $stmt->execute();

            return $stmt->fetchAll(\PDO::FETCH_ASSOC);
        } catch (\PDOException $e) {
            throw $e;
        }
    }

    public function deletar(int $id){
        try {
            $query = "DELETE FROM grr20193920_imoveis  WHERE id_imovel = :id";
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
            $query = "UPDATE grr20193920_imoveis SET titulo = :titulo, descricao = :descricao, imagem = :imagem WHERE id_imovel = :id_imovel";
            $stmt = $this->db->prepare($query);
            $stmt->bindValue(':titulo', $this->__get('titulo'));
            $stmt->bindValue(':descricao', $this->__get('descricao'));
            $stmt->bindValue(':imagem', $this->__get('imagem'));
            $stmt->bindValue(':id_imovel', $this->__get('id_imovel'));
            $stmt->execute();
            return true;
        } catch (\PDOException $e) {
            throw $e;
        }
    }

    /**
     * @return array
     */
    public function procurarTodos() {
        try {
            $query = "SELECT id_imovel, titulo, descricao, imagem FROM grr20193920_imoveis";
            $stmt = $this->db->prepare($query);
            $stmt->execute();
            return $stmt->fetchAll(\PDO::FETCH_ASSOC);
        } catch (\PDOException $e) {
            throw $e;
        }
    }
    
    /**
     * @return array
     */
    public function procurarTodosComLimit() {
        try {
            $query = "SELECT id_imovel, titulo, descricao, imagem FROM grr20193920_imoveis order by id_imovel desc limit 10";
            $stmt = $this->db->prepare($query);
            $stmt->execute();
            return $stmt->fetchAll(\PDO::FETCH_ASSOC);
        } catch (\PDOException $e) {
            throw $e;
        }
    }
}