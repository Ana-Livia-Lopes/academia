<?php

try {
    $conexao = new mysqli(
        "localhost", 
        "root", 
        "", 
        "db_academia"
    );
} catch (Exception $e) {
    die("Erro de conexão: " . $e->getMessage());
}

function respostaJSON($status, $mensagem) {
    return json_encode([
        "status" => $status,
        "mensagem" => $mensagem
    ], JSON_UNESCAPED_UNICODE);
}