<?php
session_start();

if (isset($_POST['info'])) {
    $request = $_POST['info'];

    switch ($request) {
        case 'nome':
            $info = "";
            if (isset($_SESSION['nome'])) $info = $_SESSION['nome'];
            break;
        case 'email':
            $info = "";
            if (isset($_SESSION['email'])) $info = $_SESSION['email'];
            break;
        case 'nivel':
            $info = "";
            if (isset($_SESSION['nivel'])) $info = $_SESSION['nivel'];
            break;
        default:
            $info = "";
            break;
    }

    echo $info;
} else {
    echo "";
}