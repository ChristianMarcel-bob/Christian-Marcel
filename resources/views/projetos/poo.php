<?php

// Exemplo com POO
//ENCAPSULAMENTO
//Proteger informacoes para que não sejam alteradas de qualquer jeito.
//HERANÇA
// Criar uma classe nova aproveitando caracteristicas de outra
//POLIFORMISMO
//Permitir que projetos diferentes respondam a mesma ação de maneiras diferentes.
//ABSTRAÇÃO
//Mostrar o que é necessário e esconder detalhes complicados de funcionamentos.

class Personagem
{

    public $nome;
    private $vida;
    public $dano;

    public function _construct($nome, $vida, $dano)
    {
        $this->nome = $nome;
        $this->vida = $vida;
        $this->dano = $dano;
    }

    //getter
    public function getVida()  {
return $this->vida;


    }

//setter
public function  setVida($vida) {


    if ($vida < 0 );  {
        echo "A vida não pode ser negativa!\n"


    }


}

$this->vida = $vida;

    public function atacar()
    {


        echo "$this->nome realizou um ataque";
    }
}

$Christian = new Personagem("Christian", 100, 10);

$Christian->setVida(50);


$Lucas = new personagem("Lucas", 90, 10);
$Gustavo = new personagem("Gustavo", 80, 10);

$Christian->atacar(); // metodo proprio

class Guerreiro extends Personagem
{

    public function defender()
    {

        echo "$this->nome levantou o escudo!";
    }
}
class Mago extends Personagem {


public function lancarMagia()  {

echo "$this->nome lançou uma bola de fogo!\n";


}


}


$guerreiro = new Guerreiro("Christian", 100, 10);
$mago = new Mago("Lucas", 50, 10);
$personagem = new Personagem("Gustavo", 30, 3);

$guerreiro = new Guerreiro("Christian", 100, 10);

$guerreiro->atacar(); //método herdado
$guerreiro->defender(); // método próprio



//1. o que é uma classe?
//um molde para criar objetos

//2. o que significa new personagem()?
//Criar um objeto da classe Personagem

//3. Para que serve $this->nome?
//Acessar o nome do objeto atual

//4. O que significa extends?
//Herdar características e métodos de outra classe



?>
