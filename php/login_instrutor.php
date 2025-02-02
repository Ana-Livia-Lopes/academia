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

    if (!isset($_POST['email'])) array_push($faltando, "Email");
    if (!isset($_POST['senha'])) array_push($faltando, "Senha");

    if (count($faltando) > 0) {
        echo respostaJSON("erro", "Campos faltando: " . implode(", ", $faltando));
        exit;
    }

    $email = $_POST['email'];
    $senha = $_POST['senha'];

    $vazio = [];

    if (empty($email)) array_push($vazio, "Email");
    if (empty($senha)) array_push($vazio, "Senha");

    if (count($vazio) > 0) {
        echo respostaJSON("erro", "Campos vazios: " . implode(", ", $vazio));
        exit;
    }

    $incorreto = [];

    if (strlen($email) < 5 || strlen($email) > 256) array_push($incorreto, "Tamanho do Nome (5 a 256)");
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) array_push($incorreto, "Formato do Email inválido");
    if (strlen($senha) < 6|| strlen($senha) > 64) array_push($incorreto, "Tamanho da Senha (6 a 64)");

    if (count($incorreto) > 0) {
        echo respostaJSON("erro", "Campos incorretos: " . implode(", ", $incorreto));
        exit;
    }

    try {
        $sql = "SELECT instrutor_cod, instrutor_nome, instrutor_email, instrutor_senha FROM instrutores WHERE instrutor_email = ?";
        $stmt = $conexao->prepare($sql);
        $stmt->bind_param("s", $email);
        $stmt->execute();

        $result = $stmt->get_result();

        if ($result->num_rows > 0) {
            $instrutor = $result->fetch_assoc();

            if (password_verify($senha, $instrutor['instrutor_senha'])) {
                $_SESSION['email'] = $instrutor['instrutor_email'];
                $_SESSION['nome'] = $instrutor['instrutor_nome'];
                $_SESSION['nivel'] = "instrutor";
                $_SESSION['id'] = $instrutor['instrutor_cod'];

                echo respostaJSON("sucesso", "Olá, {$instrutor['instrutor_nome']}.");
            } else {
                echo respostaJSON("erro", "Senha incorreta.");
                exit;
            }
        } else {
            echo respostaJSON("erro", "Email não cadastrado.");
            exit;
        }
    } catch (Exception $e) {
        echo respostaJSON("erro", "Erro ao buscar instrutor: " . $e->getMessage());
    }
} else {
    echo respostaJSON("erro", "Método de requisição incorreto.");
}