<?php
    include 'php/conexao.php';

    $sql_alunos= "SELECT aluno_nome, aluno_cod, aluno_cpf, aluno_endereco, aluno_telefone FROM alunos";
    
    $resultado_alunos = $conexao->query($sql_alunos);


?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Alunos</title>
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@20..48,100..700,0..1,-50..200" />
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:ital,wght@0,100..900;1,100..900&family=Plus+Jakarta+Sans:ital,wght@0,200..800;1,200..800&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <?php 
    include 'head.php';
?>
    <link rel="stylesheet" href="pagAluno.css">
</head>
<?php include 'header.php';?>
<body>
    <div class="container">
        <h1>Alunos cadastrados</h1>
        <div class="tabela-div">
            <table>
                <thead>
                    <tr>
                        <th>Nome</th>
                        <th>CPF</th>
                        <th>Telefone</th>
                        <th>Editar</th>
                        <th>Excluir</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    if ($resultado_alunos->num_rows > 0) {
                        while($linha = $resultado_alunos->fetch_assoc()){
                            echo "<tr>";
                            echo "<td>" . $linha['aluno_nome'] . "</td>";
                            echo "<td>" . $linha['aluno_cpf'] . "</td>";
                            echo "<td>" . $linha['aluno_telefone'] . "</td>";
                            echo "<td><button class='editar' onclick='editarAluno({$linha['aluno_cod']}, recarregar)'><img src='./img/edit.svg' class='tablebutton'></button></td>";
                            echo "<td><button class='editar' onclick='excluirAluno({$linha['aluno_cod']}, recarregar)'><img src=\"./img/cancel.svg\" class='tablebutton'></button></td>";
                            echo "<tr>";
                        }                   
                    }
                        ?>
                </tbody>
            </table>
        </div>
    </div>
    <?php include 'footer.php';?>
</body>
</html>