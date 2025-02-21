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
    <link rel="stylesheet" href="cadastroIns.css">
    <?php include './head.php' ?>
    <title>Cadastrar Instrutor - Power Gym</title>
</head>
<body>
<section class="secao-cadastro">
    
    <div class="box-cadastro">
        <form action="" method="POST" id="form-cadastro-instrutor">
            <h1>Cadastro Instrutor</h1>
            <label for="nome">Nome</label>
            <input class="campo-inserir" type="text" name="nome" required>

            <label for="email">Email</label>
            <input class="campo-inserir" type="email" name="email" required>

            <label for="especialidade">Especialidade</label><br>
            <select id="especialidadeInst" name="especialidade">
                <option value="Pilates">Pilates</option>
                <option value="Crossfit">Crossfit</option>
                <option value="Musculação">Musculação</option>
                <option value="Yoga">Yoga</option>
                <option value="Aeróbica">Aeróbica</option>
                <option value="Ginástica">Ginástica</option>
                <option value="Alongamento">Alongamento</option>
                <option value="Luta">Luta</option>
            </select>
            
            <label for="senha">Senha</label>
            <input class="campo-inserir" id="senha-campo" type="password" name="senha" required>
            <div id='mostrar'>
                <input type='checkbox' onclick='mostrarSenha()'> Mostrar senha <br>
                <button class="botaoVoltar2" onclick="history.back()">⭠ Voltar</button>
            </div>
            
            <button id="botao-cadastrar" type="submit">Cadastrar</button>
            <p class="celular">Já tem uma conta? <a href="./loginIns.php" id="entre">Entre!</a></p>
        </form>
    </div>
    <div class="box-bemvindo">
        <h2>Já tem uma conta?</h2>
        <p>Para continuar sua jornada conosco, entre com suas credenciais.</p>
        <button id="botao-entrar" onclick="window.location='loginIns.php'"><a href="./loginIns.php">Entrar</a></button>
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