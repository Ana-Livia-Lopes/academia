<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="shortcut icon" href="./img/HW-icon.png" type="image/x-icon">
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@100..900&family=Plus+Jakarta+Sans:wght@200..800&display=swap" rel="stylesheet">
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
    <link rel="stylesheet" href="cadastroIns.css">
    <title>Login Instrutor - Power Gym</title>
</head>
<body>
    <section id="secao-login">
        <div id="box-login">
        <form action="" method="POST">
            <h1>Entre na sua conta</h1>
            <label for="nome">Nome</label>
            <input class="campo-inserir" type="text" name="nome" required>

            <label for="especialidade">Especialidade</label>
            <input class="campo-inserir" id="especialidadeInst" type="text" name="especialidade" required>
            
            <label for="senha">Senha</label>
            <input class="campo-inserir" id="senha-campo" type="password" name="senha" required>
            <div id='mostrar'>
                <input type='checkbox' onclick='mostrarSenha()'> Mostrar senha
            </div>

                    <?php

                        session_start();
                        include 'php/conexao.php';

                        if($_SERVER["REQUEST_METHOD"] == "POST") {
                            $var_nome = $_POST["nome"];
                            $var_especialidade = $_POST["especialidade"];
                            $var_senha = $_POST["senha"];

                            $query = "SELECT * FROM usuarios WHERE instrutor_nome = '$var_nome'";

                            $result = mysqli_query($conexao, $query);

                            if($result->num_rows > 0) {
                                $usuario_logado = $result->fetch_assoc();

                                if (password_verify($var_senha, $usuario_logado['instrutor_senha'])){
                                    $_SESSION['id'] = $usuario_logado['id_usuario'];
                                    $_SESSION['nome'] = $usuario_logado['instrutor_nome'];
                                    $_SESSION['especialidade'] = $usuario_logado['instrutor_especialidade'];
                                    $_SESSION['senha'] = $usuario_logado['instrutor_senha'];
                                    
                                    header('Location: index.php');
                                } else {
                                    echo "<p style='color:red;'>Senha incorreta</p>";
                                }
                            } else {
                                echo "<p style='color:red;'>Email incorreto</p>";
                            }
                        }
                    ?>

                    <button id="entrar" type="submit">Entrar</button>
                    <p class="celular">Não tem uma conta? <a href="./cadastroInstrutor.php">Cadastre-se!</a></p>
                </form>
        </div>
        <div id="box-welcome">
            <h2>Não tem uma conta?</h2>
            <p>Entre com seus dados pessoais e comece sua jornada conosco</p>
            <button id="cadastrar-button" onclick="window.location='./cadastroInstrutor.php'"><a href="./cadastroInstrutor.php">Cadastre-se</a></button>
        </div>
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