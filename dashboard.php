<?php
require_once "validaUser.php";
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
    require_once "classes/{$class}.class.php";
});

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