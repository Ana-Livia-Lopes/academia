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

                if (isset($_POST['data'])) {
                    $data = $_POST['data'];
                    $validDays = ["Segunda-feira", "Terça-feira", "Quarta-feira", "Quinta-feira", "Sexta-feira", "Sábado", "Domingo"];
                    if (!in_array($data, $validDays)) {
                        array_push($invalidos, "Dia inexistente");
                    }
                    $editando['aula_data'] = $data;
                }
                if (isset($_POST['tipo'])) {
                    $validTypes = ["Pilates", "Crossfit", "Musculação", "Yoga", "Aeróbica", "Ginástica", "Alongamento", "Luta"];
                    if (!in_array($_POST['tipo'], $validTypes)) {
                        array_push($invalidos, "Modalidade desconhecida");
                    }
                    $editando['aula_tipo'] = $_POST['tipo'];
                }

                if (isset($_POST['instrutor'])) {
                    $instrutor = $_POST['instrutor'];
                    $sql = "SELECT instrutor_cod FROM instrutores WHERE instrutor_email = ?";
                    $stmt = $conexao->prepare($sql);
                    $stmt->bind_param("i", $instrutor);
                    $stmt->execute();
                    $result = $stmt->get_result();

                    if ($result->num_rows > 0) {
                        $editando['aula_instrutor'] = $result->fetch_assoc()['instrutor_nome'];
                    } else {
                        array_push($invalidos, "Instrutor não encontrado");
                    }
                }

                if (isset($_POST['aluno'])) {
                    $aluno = $_POST['aluno'];
                    $sql = "SELECT aluno_cod FROM alunos WHERE aluno_email = ?";
                    $stmt = $conexao->prepare($sql);
                    $stmt->bind_param("i", $aluno);
                    $stmt->execute();
                    $result = $stmt->get_result();

                    if ($result->num_rows > 0) {
                        $editando['aula_aluno'] = $result->fetch_assoc()['aluno_nome'];
                    } else {
                        array_push($invalidos, "Aluno não encontrado");
                    }
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

                $sql = "UPDATE aulas SET " . implode(", ", $setClause) . " WHERE aula_cod = ?";
                $stmt = $conexao->prepare($sql);
                $stmt->bind_param($types, ...$params);
                $stmt->execute();

                if ($stmt->affected_rows > 0) {
                    echo respostaJSON("sucesso", "Aula atualizado com sucesso");
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

                $sql = "DELETE FROM aulas WHERE aula_cod = ?";
                $stmt = $conexao->prepare($sql);
                $stmt->bind_param("i", $id);
                $stmt->execute();

                if ($stmt->affected_rows > 0) {
                    echo respostaJSON("sucesso", "Aula removida com sucesso");
                } else {
                    echo respostaJSON("erro", "Aula não encontrada");
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
    echo respostaJSON("erro", "Método de requisição inválido.");
    exit;
}