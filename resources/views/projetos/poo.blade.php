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

abstract class Personagem
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
    public function getVida()
    {
        return $this->vida;
    }

    //setter
    public function setVida($vida)
    {


        if ($vida < 0) {
            echo "A vida não pode ser negativa!\n";

            return;
        }

        $this->vida = $vida;
    }



    abstract public function atacar();
}

class Guerreiro extends Personagem
{

    public function atacar()
    {
        echo "$this->nome levantou o escudo!";
    }

    public function defender()
    {
        echo "$this->nome levantou o escudo!";
    }
}
class Mago extends Personagem
{


    public function atacar()
    {

        echo "$this->nome lançou uma bola de fogo!\n";
    }
}

class Curandeiro extends Personagem
{

    public function atacar()
    {

        echo "$this->nome Atacou com uma faca!\n";
    }

    public function curar(Personagem $alvo, int $quantidade)
    {


        $novaVida = $alvo->getVida() + $quantidade;
        $alvo->setVida($novaVida);
        echo "$this->nome curou {$alvo->nome} em $quantidade HP!\n";
    }
}



$guerreiro = new Guerreiro("Christian", 50, 10);
$mago = new Mago("Lucas", 50, 10);
$curandeiro = new Curandeiro("Gustavo", 30, 3);

$personagens = [$guerreiro, $mago, $curandeiro];

foreach ($personagens as $p) {

    $p->atacar();
}

$guerreiro->getVida();

$curandeiro->curar($guerreiro, 30);

$guerreiro->getVida();

// https: //look.devlook.xyz/resources/views/projetos/poo.php

//1. o que é uma classe?
//um molde para criar objetos

//2. o que significa new personagem()?
//Criar um objeto da classe Personagem

//3. Para que serve $this->nome?
//Acessar o nome do objeto atual

//4. O que significa extends?
//Herdar características e métodos de outra classe
