<?php
    $dbname = 'db_editora';
    $hostname = 'localhost';
    $password = '';
    $username = 'root';

    $conexao = new mysqli($hostname, $username,$password, $dbname);

    if ($conexao->connect_error) {
        die("falha na coneção: ". $conexao->connect_error);
    };

    $sql_autores = "SELECT autores.nome_autor, livros.titulo_livro, livros.ano_livro, livros.genero_livro 
    FROM livros
    INNER JOIN autores ON livros.fk_id_autor = autores.id_autor
    ORDER BY livros.titulo_livro DESC";
    
    $resultado_autores = $conexao -> query($sql_autores);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Editora Senai</title>
    <link rel="stylesheet" href="css/aulas.css">
</head>
<body>
    <div class="container">
    <h1>Aulas cadastrados</h1>
    <div class="tabela-div"></div>
    <table>
        <hr>
        <thead>
            <tr>
                <th>aluno</th>
                <th>modalidade</th>
                <th>instrutor</th>
                <th>data</th>
            </tr>
        </thead>
        <tbody>
            <?php
            if ($resultado_autores->num_rows >0 ){
                while($linha = $resultado_autores->fetch_assoc()){
                echo"<tr><td>".$linha['nome_autor']."</td><td>".$linha['titulo_livro']."</td><td>".$linha['ano_livro']."</td><td>".$linha['genero_livro']."</td></tr>";
                }
            }
            
            ?>
        </tbody>
    </table>  
    </div>  
</body>
</html>