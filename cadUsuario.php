<?php
#    require_once 'validaUser.php'
?>  
<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cadastro de Usuaário</title>
</head>

<header>
    <nav class="navbar navbar-expand-lg " data-bs-theme="dark" style="background-color: #324a35;">
      <div class="container-fluid">
        <a class="navbar-brand" href="#">
          <img src="imagens/logo.png" alt="" width="30" height="24" class="d-inline-block align-text-top">
          IFRO - Cacoal</a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNavDropdown"
          aria-controls="navbarNavDropdown" aria-expanded="false" aria-label="Toggle navigation">
          <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNavDropdown">
          <ul class="navbar-nav">
            <li class="nav-item">
              <a class="nav-link" aria-current="page" href="index.php">Home</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="alunos_div.php">Alunos</a>
            </li>
          </ul>
        </div>
      </div>
    </nav>
  </header>

<body>
    <?php


    // Verifica se o formulário foi enviado
    $mensagem = '';
    if (filter_has_var(INPUT_POST, "salvar")) {
        spl_autoload_register(function ($class) {
          require_once "classes/{$class}.class.php" ;
        });
        $usuario = new Usuario;

        // Define os valores nos atributos da classe
        $usuario->setNome(filter_input(INPUT_POST, 'nome'));
        $usuario->setEmail(filter_input(INPUT_POST, 'email'));
        $usuario->setSenha(password_hash(filter_input(INPUT_POST,  'senha'), PASSWORD_DEFAULT));
        $usuario->setNivel_acesso(filter_input(INPUT_POST, 'nivel_acesso'));

        // Tenta criar o usuário
        if ($usuario->add()) {
            $mensagem = '<div class="alert alert-success">Usuário cadastrado com sucesso!</div>';
        } else {
            $mensagem = '<div class="alert alert-danger">Erro ao cadastrar o usuário. Tente novamente.</div>';
        }
    }
    ?>

    <!DOCTYPE html>
    <html lang="en">

    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Cadastro de Usuário</title>
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    </head>

    <body>
        <div class="container mt-5">
            <h2 class="mb-4">Cadastro de Usuário</h2>

            <!-- Exibição de mensagens -->
            <?php if (!empty($mensagem))
                echo $mensagem; ?>

            <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="POST">
                <div class="mb-3">
                    <label for="nome" class="form-label">Nome</label>
                    <input type="text" class="form-control" id="nome" name="nome" placeholder="Digite o Username"
                        required>
                </div>
                <div class="mb-3">
                    <label for="email" class="form-label">E-mail</label>
                    <input type="email" class="form-control" id="email" name="email" placeholder="Digite o e-mail"
                        required>
                </div>
                <div class="mb-3">
                    <label for="senha" class="form-label">Senha</label>
                    <input type="password" class="form-control" id="senha" name="senha" placeholder="Digite a senha"
                        required>
                </div>
                <div class="mb-3">
                    <label for="nivel_acesso" class="form-label">Nível de Acesso</label>
                    <select class="form-select" id="nivel_acesso" name="nivel_acesso" required>
                        <option value="" selected disabled>Selecione um nível de acesso</option>
                        <option value="1">Administrador</option>
                        <option value="2">Gerente</option>
                        <option value="3">Vendedor</option>
                        <option value="4">Cliente</option>
                    </select>
                </div>
                <button type="submit" class="btn btn-primary" name="salvar">Cadastrar</button>
            </form>
        </div>

        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    </body>

    </html>