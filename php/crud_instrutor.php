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
                    $editando['instrutor_nome'] = $nome;
                }
                if (isset($_POST['especialidade'])) {
                    $validTypes = ["Pilates", "Crossfit", "Musculação", "Yoga", "Aeróbica", "Ginástica", "Alongamento", "Luta"];
                    if (!in_array($_POST['especialidade'], $validTypes)) {
                        array_push($invalidos, "Modalidade desconhecida");
                    }
                    $editando['instrutor_especialidade'] = $_POST['especialidade'];
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

                $sql = "UPDATE instrutores SET " . implode(", ", $setClause) . " WHERE instrutor_cod = ?";
                $stmt = $conexao->prepare($sql);
                $stmt->bind_param($types, ...$params);
                $stmt->execute();

                if ($stmt->affected_rows > 0) {
                    echo respostaJSON("sucesso", "Instrutor atualizado com sucesso");
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

                $sql = "DELETE FROM instrutores WHERE instrutor_cod = ?";
                $stmt = $conexao->prepare($sql);
                $stmt->bind_param("i", $id);
                $stmt->execute();

                if ($stmt->affected_rows > 0) {
                    echo respostaJSON("sucesso", "Instrutor removido com sucesso");
                } else {
                    echo respostaJSON("erro", "Instrutor não encontrado");
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