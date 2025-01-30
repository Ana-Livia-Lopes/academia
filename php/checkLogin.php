<?php

session_start();

if (isset($_SESSION['nivel'])) {
    echo "true";
} else {
    echo "false";
}