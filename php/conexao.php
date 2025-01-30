<?php

try {
    $connection = new mysqli(
        "localhost", 
        "root", 
        "", 
        "db_academia"
    );
} catch (Exception $e) {
    die("Erro de conexão: " . $e->getMessage());
}