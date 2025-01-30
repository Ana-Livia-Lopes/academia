<?php
include 'conexao.php';

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $var_nome = $_POST["nome"];
    $var_email = $_POST["email"];
    $var_senha = $_POST["senha"];

    $senha_hashed = password_hash($var_senha, PASSWORD_DEFAULT);

    $sql_insercao = "INSERT INTO usuarios (nome_usuario, email_usuario, senha_usuario, imagem_usuario, tipo_usuario) VALUES (?, ?, ?, 'user_default.jpg', 'aluno')";
    
    $stmt = $conexao->prepare($sql_insercao);
    
    $stmt->bind_param("sss", $var_nome, $var_email, $senha_hashed);
    
    if ($stmt->execute()) {
        header("Location: index.php?cad=1");
    } else {
        echo "Erro ao cadastrar usuário: " . $conexao->error;
    }

    $stmt->close();
    $conexao->close();
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
    <link rel="stylesheet" href="css/login.css">
    <title>Cadastrar aluno - Power Gym</title>
</head>
<body>
<section class="secao-cadastro">
    
    <div class="box-cadastro">
        <form action="" method="POST">
            <h1>Cadastro</h1>
            <label for="nome">Nome</label>
            <input class="campo-inserir" type="text" name="nome" required>
            
            <label for="email">Email</label>
            <input class="campo-inserir" type="email" name="email" required>
            
            <label for="senha">Senha</label>
            <input class="campo-inserir" id="senha-campo" type="password" name="senha" required>
            <div id='mostrar'>
                <input type='checkbox' onclick='mostrarSenha()'> Mostrar senha
            </div>
            
            <button id="botao-cadastrar" type="submit" onclick="window.location='index.php'">Cadastrar</button>
            <p class="celular">Já tem uma conta? <a href="./login.php" id="entre">Entre!</a></p>
        </form>
    </div>
    <div class="box-bemvindo">
        <h2>Já tem uma conta?</h2>
        <p>Para continuar sua jornada conosco, entre com suas credenciais.</p>
        <button id="botao-entrar" onclick="window.location='login.php'"><a href="./login.php">Entrar</a></button>
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