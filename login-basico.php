<?php

$usuarioCorreto = "admin";
$senhaCorreta = "1234";

$mensagem = "";

if ($_SERVER ["REQUEST_METHOD"] == "POST") {
$usuario = $_POST["usuario"];
$senha = $_POST["senha"];

if ($usuario == $usuarioCorreto && $senha == $senhaCorreta) {
    $mensagem = "login realizado";

}

else {
    $mensagem = "usuario ou senha incorretos";
}



}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>login de usuario</title>
</head>



<body>
   <div class="login-container">

        <h1 id="titulo">Login</h1>

        <form method="POST" action="">
            <label for="usuario">Usuário:</label>
            <input type="text" id="usuario" name="usuario" required>

            <label for="senha">Senha:</label>
            <br><br>
            <input type="password" id="senha" name="senha" required>
            <br><br>

            <button type="submit">Entrar</button>
        </form>

        <?php if ($mensagem != ""): ?>
            <p class="mensagem"><?php echo $mensagem; ?></p>
        <?php endif; ?>

    </div>

</body>
</html>


