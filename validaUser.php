<?php

if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
spl_autoload_register(function ($class) {
    require_once "classes/{$class}.class.php";
});

if (!isset($_SESSION['user_name'])) {
    // Salva a URL atual
    $current_page = urlencode($_SERVER['REQUEST_URI']);
    header("Location: login.php?redirect=$current_page");
    exit();
}

$usuario = new Usuario;

if ($usuario->sessaoExpirou()) {
    header("Location: login.php?session_expired=true");
    exit;
}

if (!isset($_SESSION['user_name']) || !isset($_SESSION['nivel_acesso'])) {
    header("Location: login.php?error=not_logged_in");
    exit;
}

if (!$usuario->verificarNivelAcesso($niveisPermitidos)) {
    // Redireciona para a página de login ou exibe mensagem de erro
    echo "<script>alert('Você não tem permissão para acessar esta página!');</script>";
    header("Location: login.php");
    exit();
}