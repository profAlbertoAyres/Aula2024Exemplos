<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

if (!isset($_SESSION['user_name'])) {
    // Salva a URL atual
    $current_page = urlencode($_SERVER['REQUEST_URI']);
    header("Location: login.php?redirect=$current_page");
    exit();
}
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard</title>
</head>
<body>
<?php
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
$userName = $_SESSION['user_name'];
$userLevel = $_SESSION['nivel_acesso'];

switch ($userLevel) {
    case 1:
        $accessLevel = "Administrador";
        break;
    case 2:
        $accessLevel = "Gerente";
        break;
    case 3:
        $accessLevel = "Vendedor";
        break;
    case 4:
        $accessLevel = "Cliente";
        break;
    default:
        $accessLevel = "Desconhecido";
}

   ?> 
<body>
    <div class="container mt-5">
        <h1>Bem-vindo, <?php echo htmlspecialchars($userName); ?>!</h1>
        <p>Você está acessando o sistema como: <strong><?php echo $accessLevel; ?></strong></p>
        
        <div class="mt-4">
            <a href="logout.php" class="btn btn-danger">Sair</a>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>