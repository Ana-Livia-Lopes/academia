

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="shortcut icon" href="./img/HW-icon.png" type="image/x-icon">
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@100..900&family=Plus+Jakarta+Sans:wght@200..800&display=swap" rel="stylesheet">
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
    <link rel="stylesheet" href="cadastroAlu.css">
    <title>Login aluno - Power Gym</title>
</head>
<body>
<section class="secao-cadastro secaoAlu">
    
    <div class="box-cadastro">
        <form action="" method="POST">
            <h1>Entre na sua conta</h1>
            <label for="email">Email</label>
            <input class="campo-inserir" type="email" name="email" required>
            
            <label for="senha">Senha</label>
            <input class="campo-inserir" id="senha-campo" type="password" name="senha" required>
            <div id='mostrar'>
                <input type='checkbox' onclick='mostrarSenha()'> Mostrar senha
            </div>
            
            <button id="botao-cadastrar" type="submit" onclick="window.location='index.php'">Cadastrar</button>
            <?php

                        session_start();
                        include 'php/conexao.php';

                        if($_SERVER["REQUEST_METHOD"] == "POST") {
                            $var_email = $_POST["email"];
                            $var_senha = $_POST["senha"];

                            $query = "SELECT * FROM usuarios WHERE email_usuario = '$var_email'";

                            $result = mysqli_query($conexao, $query);

                            if($result->num_rows > 0) {
                                $usuario_logado = $result->fetch_assoc();

                                if (password_verify($var_senha, $usuario_logado['instrutor_senha'])){
                                    $_SESSION['id'] = $usuario_logado['id_usuario'];
                                    $_SESSION['email'] = $usuario_logado['instrutor_email'];
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