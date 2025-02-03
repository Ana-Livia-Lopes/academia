<?php
include './conexao.php';
header("Content-Type: application/json");
session_start();

if ($_SERVER['REQUEST_METHOD'] === "POST") {
    $faltando = [];
    if (!isset($_POST['nome'])) array_push($faltando, "Nome");
    if (!isset($_POST['email'])) array_push($faltando, "Email");
    if (!isset($_POST['senha'])) array_push($faltando, "Senha");
    if (!isset($_POST['especialidade'])) array_push($faltando, "Especialidade");

    if (count($faltando) > 0) {
        echo respostaJSON("erro", "Campos faltando: " . implode(", ", $faltando));
        exit;
    }
    
    $nome = $_POST['nome'];
    $email = $_POST['email'];
    $senha = $_POST['senha'];
    $especialidade = $_POST['especialidade'];

    $vazio = [];

    if (empty($nome)) array_push($vazio, "Nome");
    if (empty($email)) array_push($vazio, "Email");
    if (empty($senha)) array_push($vazio, "Senha");
    if (empty($especialidade)) array_push($vazio, "Especialidade");

    if (count($vazio) > 0) {
        echo respostaJSON("erro", "Campos vazios: " . implode(", ", $vazio));
        exit;
    }
    
    $incorreto = [];

    if (strlen($nome) < 3 || strlen($nome) > 256) array_push($incorreto, "Tamanho do Nome (3 a 256)");
    if (strlen($email) < 5 || strlen($email) > 256) array_push($incorreto, "Tamanho do Nome (5 a 256)");
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) array_push($incorreto, "Formato do Email inválido");
    if (strlen($senha) < 6|| strlen($senha) > 64) array_push($incorreto, "Tamanho da Senha (6 a 64)");
    if (!in_array($especialidade, [
        "Pilates", "Crossfit", "Musculação", "Yoga", "Aeróbica", "Ginástica", "Alongamento", "Luta"
    ])) array_push($incorreto, "Modalidade desconhecida");
    
    if (count($incorreto) > 0) {
        echo respostaJSON("erro", "Campos incorretos: " . implode(", ", $incorreto));
        exit;
    }

    $senha = password_hash($senha, PASSWORD_DEFAULT);

    try {
        $sql = "SELECT instrutor_cod FROM instrutores WHERE instrutor_email = ?";
        $stmt = $conexao->prepare($sql);
        $stmt->bind_param("s", $email);
        $stmt->execute();
        $stmt->store_result();
    
        if ($stmt->num_rows > 0) {
            echo respostaJSON("erro", "Email já registrado.");
            exit;
        }
    } catch (Exception $e) {
        echo respostaJSON("erro", "Erro ao verificar email: " . $e->getMessage());
        exit;
    }
    
    try {
        $sql = "INSERT INTO instrutores (instrutor_nome, instrutor_email, instrutor_senha, instrutor_especialidade) VALUES (?, ?, ?, ?)";
        $stmt = $conexao->prepare($sql);
        $stmt->bind_param("ssss", $nome, $email, $senha, $especialidade);
        $stmt->execute();
        
        if ($stmt->affected_rows > 0) {
            echo respostaJSON("sucesso", "Instrutor $nome registrado com sucesso.");
        } else {
            echo respostaJSON("erro", "Erro ao registrar instrutor.");
        }
    } catch (Exception $e) {
        echo respostaJSON("erro", "Erro ao registrar instrutor: " . $e->getMessage());
    }
} else {
    echo respostaJSON("erro", "Método de requisição incorreto.");
}