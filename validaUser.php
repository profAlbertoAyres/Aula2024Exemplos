<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

spl_autoload_register(function ($class) {
    require_once("classes/{$class}.class.php");
});

$usuario = new Usuario;

if ($usuario->sessaoExpirou()) {
    header("Location: login.php?session_expired=true");
    exit;
}

if (!isset($_SESSION['user_name']) || !isset($_SESSION['nivel_acesso'])) {
    header("Location: login.php?error=not_logged_in");
    exit;
}

