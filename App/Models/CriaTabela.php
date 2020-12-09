<?php


namespace App\Models;
use App\Models\Base\Model;

/**
 * Class CriaTabela
 * @package app\Models
 */
class CriaTabela extends Model
{
    public function criaTabelas () {
        try {
            $query = "
                CREATE TABLE grr20193920_imoveis (
                    id_imovel int(11) PRIMARY KEY AUTO_INCREMENT,
                    titulo varchar(255) not null,
                    descricao mediumtext not null,
                    imagem varchar(255) null
                );
                
                CREATE TABLE grr20193920_administradores (
                    id_usuario int(11) PRIMARY KEY AUTO_INCREMENT,
                    nome varchar(255) not null,
                    email varchar(255) not null unique,
                    senha varchar(255) not null
                );
                
                INSERT INTO grr20193920_administradores (nome, email, senha) VALUES ('admin', 'admin@admin.com', '21232f297a57a5a743894a0e4a801fc3');
            ";
            $this->db->exec($query);
            return true;
        } catch (\PDOException $e) {
            return false;
        }
    }
}