<?php
include './conexao.php';
header("Content-Type: application/json");
session_start();

if ($_SERVER['REQUEST_METHOD'] === "POST") {
    $faltando = [];
    if (!isset($_POST['tipo'])) array_push($faltando, "Modalidade");
    if (!isset($_POST['data'])) array_push($faltando, "Data");
    if (!isset($_POST['instrutor'])) array_push($faltando, "Instrutor");
    if (!isset($_POST['aluno'])) array_push($faltando, "Aluno");

    if (count($faltando) > 0) {
        echo respostaJSON("erro", "Campos faltando: " . implode(", ", $faltando));
        exit;
    }
    
    $tipo = $_POST['tipo'];
    $data = $_POST['data'];
    $instrutor = $_POST['instrutor'];
    $aluno = $_POST['aluno'];

    $vazio = [];

    if (empty($tipo)) array_push($vazio, "Modalidade");
    if (empty($data)) array_push($vazio, "Data");
    if (empty($instrutor)) array_push($vazio, "Instrutor");
    if (empty($aluno)) array_push($vazio, "Aluno");

    if (count($vazio) > 0) {
        echo respostaJSON("erro", "Campos vazios: " . implode(", ", $vazio));
        exit;
    }
    
    $incorreto = [];

    if (!in_array($tipo, [
        "Pilates", "Crossfit", "Musculação", "Yoga", "Aeróbica", "Ginástica", "Alongamento", "Luta"
    ])) array_push($incorreto, "Modalidade desconhecida");
    if (!in_array($data, ["Segunda-feira", "Terça-feira", "Quarta-feira", "Quinta-feira", "Sexta-feira", "Sábado", "Domingo"])) {
        array_push($incorreto, "Dia inexistente");
    }
    if (!filter_var($instrutor, FILTER_VALIDATE_EMAIL)) {
        array_push($incorreto, "Formato de email do instrutor inválido");
    }
    if (!filter_var($aluno, FILTER_VALIDATE_EMAIL)) {
        array_push($incorreto, "Formato de email do aluno inválido");
    }

    if (count($incorreto) > 0) {
        echo respostaJSON("erro", "Erros: " . implode(", ", $incorreto));
        exit;
    }

    $sql = "SELECT instrutor_cod FROM instrutores WHERE instrutor_email = ?";
    $stmt = $conexao->prepare($sql);
    $stmt->bind_param("s", $instrutor);
    $stmt->execute();

    $result = $stmt->get_result();
    if ($result->num_rows > 0) {
        $instrutor_cod = $result->fetch_assoc()["instrutor_cod"];
    } else {
        echo respostaJSON("erro", "Instrutor não encontrado");
        exit;
    }

    $sql = "SELECT aluno_cod FROM alunos WHERE aluno_email = ?";
    $stmt = $conexao->prepare($sql);
    $stmt->bind_param("s", $aluno);
    $stmt->execute();

    $result = $stmt->get_result();
    if ($result->num_rows > 0) {
        $aluno_cod = $result->fetch_assoc()["aluno_cod"];
    } else {
        echo respostaJSON("erro", "Aluno não encontrado");
        exit;
    }

    try {
        $sql = "INSERT INTO aulas (aula_tipo, aula_data, fk_instrutor_cod, fk_aluno_cod) VALUES (?, ?, ?, ?)";
        $stmt = $conexao->prepare($sql);
        $stmt->bind_param("ssii", $tipo, $data, $instrutor_cod, $aluno_cod);
        $stmt->execute();

        if ($stmt->affected_rows > 0) {
            echo respostaJSON("sucesso", "Aula registrada com sucesso");
            exit;
        } else {
            echo respostaJSON("erro", "Erro ao registrar aula");
        }
    } catch (Exception $e) {
        echo respostaJSON("erro", "Erro ao registrar aula: " . $e);
        exit;
    }
}