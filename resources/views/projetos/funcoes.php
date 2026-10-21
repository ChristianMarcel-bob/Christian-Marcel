<?php

function apresentarSistemas()  {


echo "Bem vindo(a) ao Help Desk";


}

apresentarSistemas();

function abrirChamado ($nome, $problema)  {

echo "$nome abriu um chamado: $problema";



}

abrirChamado("Christian", "Impressora não funciona");

function contarChamados($quantidade)  {

return "Existem $quantidade chamados registrados";


}

$resultado = contarChamados(5);
