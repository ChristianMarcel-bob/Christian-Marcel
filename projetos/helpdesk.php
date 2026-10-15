<php
require_once "helpdesk-func.php";

$mensagem = "";

// Identificar a operacao solicitada

if ($_SERVER["REQUEST_METHOD"] === "POST") {

// o operador ?? é chamado de operador de coalescencia nula
// ele significa:
    //"utilize o valor da esquerda, se ele existir e nao for nulo. Caso contrario, utilize o valor da direita"

    $acao = $_POST["acao"] ?? "";

    // if(isset($_POST["acao"])) {
        // $acao = $_POST["acao"];
        // } else {

            $acao = "";
            //
        }

        if($acao === "cadastrar") {
$sucesso = cadastrarChamados (


    
)


        }



    }


}