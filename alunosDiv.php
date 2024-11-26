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
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">

    <link rel="stylesheet" href="css/alunos.css">
    <title>Lista de Alunos</title>
</head>

<body>
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
    <main class="container mt-3">
        <div class="mb-3">
            <a href="cadAluno.php" class="btn btn-warning">Novo Aluno</a>
        </div>

        <div class="linha">
            <?php
            spl_autoload_register(function ($class) {
                require_once "classes/{$class}.class.php";
            });
            $aluno = new Aluno();
            $alunos = $aluno->all();
            foreach ($alunos as $al) {
                ?>
                <div class="item-linha">
                    <h1><?php echo $al->nome ?></h1>
                    <img src="imagensAlunos/<?php echo $al->foto ?>" alt="Foto do Aluno <?php echo $al->nome ?>">
                    <p><?php echo $al->email ?></p>
                    <p><?php echo $al->celular ?></p>
                    <div class="d-flex justify-content-center gap-2 mb-3">
                        <a href="mstAluno.php?id=<?php echo $al->id ?>" class="btn btn-primary btn-sm"><i
                                class="bi bi-pencil-square"></i></a>
                        <form action="delAluno.php" method="post" class="d-flex">
                            <input type="hidden" name="id" value="<?php echo $al->id ?>">
                            <button href="#" class="btn btn-danger btn-sm" type="submit"
                                onclick="return confirm('Tem certeza que deseja excluir este aluno?');"><i
                                    class="bi bi-trash"></i></button>
                        </form>
                    </div>
                </div>
            <?php } ?>

        </div>
    </main>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz"
        crossorigin="anonymous"></script>
</body>

</html>