<?php
    include 'php/conexao.php';

    $sql_instrutores= "SELECT instrutor_nome, instrutor_especialidade, instrutor_cod FROM instrutores";
    
    $resultado_instrutores = $conexao->query($sql_instrutores);


?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Instrutores</title>
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@20..48,100..700,0..1,-50..200" />
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:ital,wght@0,100..900;1,100..900&family=Plus+Jakarta+Sans:ital,wght@0,200..800;1,200..800&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="stylesheet" href="pagAluno.css">
    <?php 
    include 'head.php';
    ?>
</head>
<body>
    <?php include 'header.php';?>
    <div class="container">
        <h1>Instrutores cadastrados</h1>
        <div class="tabela-div divIns">
            <table>
                <thead>
                    <tr>
                        <th>Nome</th>
                        <th>Especialidade</th>
                        <th>Editar</th>
                        <th>Excluir</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    if ($resultado_instrutores->num_rows > 0) {
                        while($linha = $resultado_instrutores->fetch_assoc()){
                            echo "<tr>";
                            echo "<td>" . $linha['instrutor_nome'] . "</td>";
                            echo "<td>" . $linha['instrutor_especialidade'] . "</td>";
                            echo "<td><button class='editar' onclick='editarInstrutor({$linha['instrutor_cod']}, recarregar)'><img src='./img/edit.svg' class='tablebutton'></button></td>";
                            echo "<td><button class='editar' onclick='excluirInstrutor({$linha['instrutor_cod']}, recarregar)'><img src=\"./img/cancel.svg\" class='tablebutton'></button></td>";
                            echo "<tr>";
                        }                   
                    }
                        ?>
                </tbody>
            </table>
        </div>
    </div>
    <div id="alinhamento">
        <div id="botoes">
            <div class="d"><button onclick="window.location.href='./cadastroAluno.php';" class="botaoCadastar">Cadastrar aluno</button></div>
            <div class="d"><button onclick="window.location.href='./cadastroInstrutor.php';" class="botaoCadastar">Cadastrar instrutor</button></div>
            <div class="d"><button onclick="adicionarAula()" class="botaoCadastar adcionarAula">Adicionar aula</button>
        </div>
    </div>
    <?php include 'footer.php';?>
</body>
</html>