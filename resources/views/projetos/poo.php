<?php

// Exemplo com POO

class Personagem
{

    public $nome;
    public $vida = 100;
    public $dano;

    public function _construct($nome, $vida, $dano)
    {
        $this->nome = $nome;
         $this->vida = $vida;
          $this->dano = $dano;
        
        public function atacar() {


echo "$this->nome realizou um ataque";
    

        }
        
        
         
    
}


$Christian = new personagem("Christian", 80, 10);
$Lucas = new personagem("Lucas", 90, 10);
$Gustavo = new personagem("Gustavo", 80, 10);

?>