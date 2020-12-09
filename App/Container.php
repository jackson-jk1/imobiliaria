<?php


namespace App;

/**
 * Class Container
 * @package App
 */
class Container
{
    public static function getModel($model){
        //Retornar o modelo solicitado já instanciado, inclusive com a conexão estabelecida.
        $class = "\\App\\Models\\".ucfirst($model);
        $conn = Connection::getDb();
        return new $class($conn);
    }
}