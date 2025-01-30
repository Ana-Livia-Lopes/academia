<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="shortcut icon" href="./img/HW-icon.png" type="image/x-icon">
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@100..900&family=Plus+Jakarta+Sans:wght@200..800&display=swap" rel="stylesheet">
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
    <link rel="stylesheet" href="cadastroIns.css">
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

            <label for="especialidade">Especialidade</label>
            <input class="campo-inserir" id="especialidadeInst" type="text" name="especialidade" required>
            
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