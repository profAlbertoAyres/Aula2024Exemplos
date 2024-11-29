<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <title>Login</title>
</head>
<?php
    if (filter_has_var(INPUT_POST, "logar")) {
        spl_autoload_register(function ($class) {
          require_once "classes/{$class}.class.php" ;
        });
        $usuario = new Usuario;
        $usuario->setNome(filter_input(INPUT_POST, 'nome'));
        $usuario->setSenha(filter_input(INPUT_POST,  'senha'));
        $mensagem = $usuario->login();
        echo "<script>alert('$mensagem');</script>";
    }
?>
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
                            <a class="nav-link" href="alunos_div.php">Alunos</a>
                        </li>
                    </ul>
                </div>
            </div>
        </nav>

    </header>
    <div style="height: 100vh">
        <div class="row h-100 justify-content-center align-items-center" style="display: flex; flex-direction: column;">
            <img src="imagens/logo.png" alt="" style="height:100px; width:auto;">
            <form class="col-md-4 mt-5" method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
            <input type="hidden" name="redirect" value="<?php echo isset($_GET['redirect']) ? htmlspecialchars($_GET['redirect']) : 'dashboard.php'; ?>">
                <div class="mb-3">
                    <label for="nome" class="form-label">Usuário</label>
                    <input type="nome" class="form-control" id="nome" placeholder="Usuário" name="nome">
                </div>
                <div class="mb-3">
                    <label for="senha" class="form-label">Senha</label>
                    <input type="password" class="form-control" id="senha" placeholder="Senha" name="senha">
                </div>
                <button type="submit" class="btn btn-primary" name="logar">Entrar</button>
            </form>
        </div>
    </div>
</body>

</html>