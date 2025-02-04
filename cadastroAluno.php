<?php
session_start();
if (!isset($_SESSION['nivel'])) {
    header("Location: ./index.php");
}
if ($_SESSION['nivel'] !== "instrutor") {
    header("Location: ./index.php");
}
?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="shortcut icon" href="./img/HW-icon.png" type="image/x-icon">
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@100..900&family=Plus+Jakarta+Sans:wght@200..800&display=swap" rel="stylesheet">
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
    <link rel="stylesheet" href="cadastroAlu.css">
    <?php include './head.php' ?>
    <title>Cadastrar aluno - Power Gym</title>
</head>
<body>
<section class="secao-cadastro">
    
    <div class="box-cadastro">
        <form action="" method="POST" id="form-cadastro-aluno">
            <h1>Cadastre um aluno</h1>
            <label for="nome">Nome</label>
            <input class="campo-inserir" type="text" name="nome" required>
            
            <label for="cpf">CPF</label>
            <input class="campo-inserir" type="text" name="cpf" required>

            <label for="email">Email</label>
            <input class="campo-inserir" type="email" name="email" required>

            <label for="end_aluno">Endereço</label>
            <input class="campo-inserir" type="text" name="endereco" required>

            <label for="tel_aluno">Telefone</label>
            <input class="campo-inserir" type="tel" name="telefone" required>
            
            <label for="senha">Senha</label>
            <input class="campo-inserir" id="senha-campo" type="password" name="senha" required>
            <div id='mostrar'>
                <input type='checkbox' onclick='mostrarSenha()'> Mostrar senha <br>
                <button class="botaoVoltar2" onclick="history.back()">⭠ Voltar</button>
            </div>
            
            <button id="botao-cadastrar" type="submit">Cadastrar</button>
        </form>
    </div>
</section>
<script>
    function mostrarSenha() {
        var x = document.getElementById("senha-campo");
        if (x.type === "password") {
            x.type = "text";
        } else {
            x.type = "password";
        }
    }
</script>
</body>
</html>