<?php

session_start();

if (isset($_SESSION['nivel'])) {
    echo $_SESSION['nivel'];
} else {
    echo "";
}