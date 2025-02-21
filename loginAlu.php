

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
    <title>Login aluno - Power Gym</title>
</head>
<body>
<section class="secao-cadastro secaoAlu">
    
    <div class="box-cadastro">
        <form action="" method="POST" id="form-login-aluno">
            <h1>Entre na sua conta</h1>
            <label for="email">Email</label>
            <input class="campo-inserir" type="email" name="email" required>
            
            <label for="senha">Senha</label>
            <input class="campo-inserir" id="senha-campo" type="password" name="senha" required>
            <div id='mostrar'>
                <input type='checkbox' onclick='mostrarSenha()'> Mostrar senha
            </div>
            
            <button id="botao-cadastrar" type="submit">Entrar</button>
            <a id="a" href="loginIns.php">Você é um instrutor? Clique aqui!</a>
            <button class="botaoVoltar" onclick="history.back()">⭠ Voltar</button>
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