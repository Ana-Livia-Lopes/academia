<?php
include './conexao.php';
header("Content-Type: application/json");
session_start();

if (isset($_SESSION['nivel'])) {
    echo respostaJSON("erro", "Sessão já iniciada.");
    exit;
}

if ($_SERVER['REQUEST_METHOD'] === "POST") {
    $faltando = [];
    if (!isset($_POST['nome'])) array_push($faltando, "Nome");
    if (!isset($_POST['email'])) array_push($faltando, "Email");
    if (!isset($_POST['senha'])) array_push($faltando, "Senha");
    if (!isset($_POST['cpf'])) array_push($faltando, "CPF");
    if (!isset($_POST['endereco'])) array_push($faltando, "Endereço");
    if (!isset($_POST['telefone'])) array_push($faltando, "Telefone");

    if (count($faltando) > 0) {
        echo respostaJSON("erro", "Campos faltando: " . implode(", ", $faltando));
        exit;
    }
    
    $nome = $_POST['nome'];
    $email = $_POST['email'];
    $senha = $_POST['senha'];
    $cpf = $_POST['cpf'];
    $endereco = $_POST['endereco'];
    $telefone = $_POST['telefone'];

    $vazio = [];

    if (empty($nome)) array_push($vazio, "Nome");
    if (empty($email)) array_push($vazio, "Email");
    if (empty($senha)) array_push($vazio, "Senha");
    if (empty($cpf)) array_push($vazio, "CPF");
    if (empty($endereco)) array_push($vazio, "Endereço");
    if (empty($telefone)) array_push($vazio, "Telefone");

    if (count($vazio) > 0) {
        echo respostaJSON("erro", "Campos vazios: " . implode(", ", $vazio));
        exit;
    }
    
    $incorreto = [];

    if (strlen($nome) < 3 || strlen($nome) > 256) array_push($incorreto, "Tamanho do Nome (3 a 256)");
    if (strlen($email) < 5 || strlen($email) > 256) array_push($incorreto, "Tamanho do Nome (5 a 256)");
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) array_push($incorreto, "Formato do Email inválido");
    if (strlen($senha) < 6|| strlen($senha) > 64) array_push($incorreto, "Tamanho da Senha (6 a 64)");
    if (strlen($cpf) < 11|| strlen($cpf) > 24) array_push($incorreto, "Tamanho do CPF (11)");
    if (strlen($endereco) < 5 || strlen($endereco) > 512) array_push($incorreto, "Tamanho do Endereço (5 a 512)");
    if (strlen($telefone) < 8 || strlen($telefone) > 24) array_push($incorreto, "Tamanho do Telefone (8 a 24)");
    
    if (count($incorreto) > 0) {
        echo respostaJSON("erro", "Campos incorretos: " . implode(", ", $incorreto));
        exit;
    }

    $senha = password_hash($senha, PASSWORD_DEFAULT);

    try {
        $sql = "SELECT aluno_cod FROM alunos WHERE aluno_email = ?";
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
        $sql = "INSERT INTO alunos (aluno_nome, aluno_email, aluno_senha, aluno_cpf, aluno_endereco, aluno_telefone) VALUES (?, ?, ?, ?, ?, ?)";
        $stmt = $conexao->prepare($sql);
        $stmt->bind_param("ssssss", $nome, $email, $senha, $cpf, $endereco, $telefone);
        $stmt->execute();
        
        if ($stmt->affected_rows > 0) {
            echo respostaJSON("sucesso", "Aluno $nome registrado com sucesso.");

            $_SESSION['id'] = $stmt->insert_id;
            $_SESSION['nome'] = $aluno['aluno_nome'];
            $_SESSION['email'] = $aluno['aluno_email'];
            $_SESSION['nivel'] = "aluno";
        } else {
            echo respostaJSON("erro", "Erro ao registrar aluno.");
        }
    } catch (Exception $e) {
        echo respostaJSON("erro", "Erro ao registrar aluno: " . $e->getMessage());
    }
} else {
    echo respostaJSON("erro", "Método de requisição incorreto.");
}