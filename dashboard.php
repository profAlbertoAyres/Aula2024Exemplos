<?php
<<<<<<< HEAD
    require_once "validaUser.php"
=======
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

if (!isset($_SESSION['user_name'])) {
    // Salva a URL atual
    $current_page = urlencode($_SERVER['REQUEST_URI']);
    header("Location: login.php?redirect=$current_page");
    exit();
}
>>>>>>> parent of 1e10d06 (Foda)
?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
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

<header>
        <nav class="navbar navbar-expand-lg bg-body-tertiary">
            <div class="container-fluid">
                <a class="navbar-brand" href="#">
                    <img src="imagens/logo.png" alt="" width="30" height="24" class="d-inline-block align-text-top">
                    IFRO - Cacoal
                </a>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse"
                    data-bs-target="#navbarNavDropdown" aria-controls="navbarNavDropdown" aria-expanded="false"
                    aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse" id="navbarNavDropdown">
                    <ul class="navbar-nav me-auto">
                        <li class="nav-item">
                            <a class="nav-link" href="index.php">Home</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link active" aria-current="page" href="#">Alunos</a>
                        </li>
                    </ul>
                    <ul class="navbar-nav">
                        <?php if (isset($_SESSION['user_name'])): ?>
                            <!-- Usuário Logado -->
                            <li class="nav-item dropdown">
                                <a class="nav-link dropdown-toggle" href="#" id="userDropdown" role="button"
                                    data-bs-toggle="dropdown" aria-expanded="false">
                                    <?php echo htmlspecialchars($_SESSION['user_name']); ?>
                                </a>
                                <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="userDropdown">
                                    <li><a class="dropdown-item" href="alterar_perfil.php">Alterar Perfil</a></li>
                                    <li><a class="dropdown-item" href="alterar_senha.php">Alterar Senha</a></li>
                                    <li>
                                        <hr class="dropdown-divider">
                                    </li>
                                    <li><a class="dropdown-item text-danger" href="logout.php">Sair</a></li>
                                </ul>
                            </li>
                        <?php else: ?>
                            <!-- Usuário Não Logado -->
                            <li class="nav-item">
                                <a class="nav-link" href="login.php"><i class="bi bi-person-circle"></i> Entrar</a>
                            </li>
                        <?php endif; ?>
                    </ul>
                </div>
            </div>
        </nav>

    </header>
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