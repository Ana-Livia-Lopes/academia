<?php
include './conexao.php';
session_start();
header("Content-Type:application/json");

if ($_SERVER['REQUEST_METHOD'] === "POST") {
    if (isset($_POST['action'])) {
        $action = $_POST['action'];

        switch ($action) {
            case 'update':
                $invalidos = [];
                $editando = [];
                $faltando = [];
                if (!isset($_POST['id'])) array_push($faltando, "ID");

                if (count($faltando) > 0) {
                    respostaJSON("erro", "Campos faltando: " . implode(", ", $faltando));
                    exit;
                }

                if (isset($_POST['nome'])) {
                    $nome = $_POST['nome'];
                    if (strlen($nome) < 3 || strlen($nome) > 256) array_push($invalidos, "Tamanho do Nome (3 a 256)");
                    $editando['aluno_nome'] = $nome;
                }
                if (isset($_POST['endereco'])) {
                    $endereco = $_POST['endereco'];
                    if (strlen($endereco) < 5 || strlen($endereco) > 512) array_push($invalidos, "Tamanho do Endereço (5 a 256)");
                    $editando['aluno_endereco'] = $endereco;
                }

                if (isset($_POST['telefone'])) {
                    $telefone = $_POST['telefone'];
                    if (strlen($telefone) < 8 || strlen($telefone) > 24) array_push($invalidos, "Tamanho do Telefone (8 a 24)");
                    $editando['aluno_telefone'] = $telefone;
                }

                if (count($invalidos) > 0) {
                    echo respostaJSON("erro", "Campos inválidos: " . implode(", ", $invalidos));
                    exit;
                }

                $id = $_POST['id'];
                $setClause = [];
                $params = [];
                $types = '';

                foreach ($editando as $campo => $valor) {
                    $setClause[] = "$campo = ?";
                    $params[] = $valor;
                    $types .= 's';
                }

                $params[] = $id;
                $types .= 'i';

                $sql = "UPDATE alunos SET " . implode(", ", $setClause) . " WHERE aluno_cod = ?";
                $stmt = $conexao->prepare($sql);
                $stmt->bind_param($types, ...$params);
                $stmt->execute();

                if ($stmt->affected_rows > 0) {
                    echo respostaJSON("sucesso", "Aluno atualizado com sucesso");
                } else {
                    echo respostaJSON("erro", "Nenhuma alteração realizada");
                }
                break;
            
            case 'delete':
                $faltando = [];
                if (!isset($_POST['id'])) array_push($faltando, "ID");

                if (count($faltando) > 0) {
                    echo respostaJSON("erro", "Campos faltando: " . implode(", ", $faltando));
                    exit;
                }

                $id = $_POST['id'];

                $sql = "DELETE FROM alunos WHERE aluno_cod = ?";
                $stmt = $conexao->prepare($sql);
                $stmt->bind_param("i", $id);
                $stmt->execute();

                if ($stmt->affected_rows > 0) {
                    echo respostaJSON("sucesso", "Aluno removido com sucesso");
                } else {
                    echo respostaJSON("erro", "Aluno não encontrado");
                }

                break;
            default:
                echo respostaJSON("erro", "Ação não especificada");
                break;
        }
    } else {
        echo respostaJSON("erro", "Ação não especificada");
    }
} else {
    echo respostaJSON("erro", "Método de requisição incorreto");
}