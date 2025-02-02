<?php
session_start();

if (!isset($_SESSION['nivel'])) {
    header("Location: index.php");
}
$nivel = $_SESSION['nivel'];
if ($nivel !== "instrutor") {   
    header("Location: ./aulas.php");
}

include './php/conexao.php';

$sql = "SELECT a.aula_tipo, a.aula_data, al.aluno_nome FROM aulas a
LEFT JOIN alunos al ON a.fk_aluno_cod = al.aluno_cod
WHERE a.fk_instrutor_cod = ?";
$stmt = $conexao->prepare($sql);
$stmt->bind_param("i", $_SESSION['id']);
$stmt->execute();

$aulas = $stmt->get_result();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Editora Senai</title>
    <link rel="stylesheet" href="pagAluno.css">
    <?php include './head.php' ?>
</head>
<body>
    <?php include './header.php' ?>
    <div class="container">
    <h1>Aulas cadastrados</h1>
    <div class="tabela-div">
    <table>
        <hr>
        <thead>
            <tr>
                <th>Modalidade</th>
                <th>Aluno</th>
                <th>Data</th>
                <th>Editar</th>
                <th>Excluir</th>
            </tr>
        </thead>
        <tbody>
            <?php
            if ($aulas->num_rows >0 ){
                while($linha = $aulas->fetch_assoc()){
                echo"<tr><td>".$linha['aula_tipo']."</td><td>".$linha['aluno_nome']."</td><td>".$linha['aula_data']."</td><td><button class='editar' onclick='editarAluno({$linha['aluno_cod']}, recarregar)'><img src='./img/edit.svg' class='tablebutton'></button></td><td><button class='editar' onclick='excluirAluno({$linha['aluno_cod']}, recarregar)'><img src=\"./img/cancel.svg\" class='tablebutton'></button></td></tr>";
                }
            }
            
            ?>
        </tbody>
    </table>  
    </div>  
    <?php include './footer.php' ?>
</body>
</html>