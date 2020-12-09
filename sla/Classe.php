<?php

Class Cachorro{
    private $cor;
    private $nome;

    public function __get($atributo){
        return $this->$atributo;
    }

    public function __set($atributo,$valor ){
        $this->$atributo = $valor;
        return $this;
    }

}
 Class Raca extends Cachorro{
     private $raça;


     public function __construct(){

     }
     public function __get($atributo){
         return $this->$atributo;
     }

     public function __set($atributo,$valor ){
         $this->$atributo = $valor;
         return $this;
     }

 }

   $Cachororaca = new Raca;

   $Cachororaca->__set('cor','branca');
   $Cachororaca->__set('nome','Rodolfo');
   $Cachororaca->__set('raca','pastor alemao');

   $setCor = $Cachororaca->__get('cor');
   $setNome  = $Cachororaca->__get('nome');
   $setRaca  = $Cachororaca->__get('raca');
   print_r($Cachororaca);
   echo $setNome." e o nome tem a cor ".$setCor." e é da raça ". $setRaca;
?>
