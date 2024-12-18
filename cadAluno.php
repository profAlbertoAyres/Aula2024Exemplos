<?php
require_once 'validaUser.php'
  ?>
<!DOCTYPE html>
<html lang="pt-br">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
  <title>Novo Aluno</title>
</head>

<body>
  <header>
    <nav class="navbar navbar-expand-lg bg-body-tertiary">
      <div class="container-fluid">
        <a class="navbar-brand" href="#">
          <img src="imagens/logo.png" alt="" width="30" height="24" class="d-inline-block align-text-top">
          IFRO - Cacoal
        </a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNavDropdown"
          aria-controls="navbarNavDropdown" aria-expanded="false" aria-label="Toggle navigation">
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
          <ul class="navbar-nav">
            <?php if (isset($_SESSION['user_name'])): ?>
              <!-- Usuário Logado -->
              <li class="nav-item dropdown">
                <a class="nav-link dropdown-toggle" href="#" id="userDropdown" role="button" data-bs-toggle="dropdown"
                  aria-expanded="false">
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
  <?php
  if (filter_has_var(INPUT_POST, "salvar")) {
    spl_autoload_register(function ($class) {
      require_once("classes/{$class}.class.php");
    });
    // Diretório onde o arquivo será salvo
    $diretorio = 'imagensAlunos/';

    // Verifica se o diretório existe
    if (!is_dir($diretorio)) {
      die("O diretório '$diretorio' não existe.");
    }

    // Verifica se o arquivo foi enviado
    if (isset($_FILES['foto'])) {
      $arquivo = $_FILES['foto'];

      // Verifica se houve erro no upload
      if ($arquivo['error'] !== UPLOAD_ERR_OK) {
        die("Erro ao fazer upload da imagem. Código do erro: " . $arquivo['error']);
      }
      //Pegar a extensão do arquivo
      $extensao = strtolower(pathinfo(basename($arquivo['name']), PATHINFO_EXTENSION));
      // Gera um nome único para a imagem
      $nomeArquivo = uniqid() . '.' . $extensao;
      $caminhoArquivo = $diretorio . $nomeArquivo;

      // Move o arquivo para o diretório especificado
      if (!move_uploaded_file($arquivo['tmp_name'], $caminhoArquivo)) {
        die("Erro ao mover o arquivo.");
      }
    } else {
      die("Nenhum arquivo foi enviado.");
    }

    $aluno = new Aluno;
    $aluno->setNome(filter_input(INPUT_POST, 'nome'));
    $aluno->setEmail(filter_input(INPUT_POST, 'email'));
    $aluno->setCelular(filter_input(INPUT_POST, 'celular'));
    $aluno->setEstadoCivil(filter_input(INPUT_POST, 'estadocivil'));
    $aluno->setStatus(filter_input(INPUT_POST, 'status'));
    $aluno->setFoto($nomeArquivo);

    if($aluno->add()){  
      echo "<script>window.alert('Adicionado com sucesso.'); window.location.href='alunos_div.php';</script>";

  }else{
      echo "<script>window.alert('Adicionado com sucesso.'); window.open(document.referrer,'_self');</script>";
  }

  }
  ?>
  <div class="container">
    <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]) ?>" method="post" class="row g3"
      enctype="multipart/form-data">
      <div class="col-12 mb-3">
        <label for="nome" class="form-label">Nome</label>
        <input type="text" name="nome" id="nome" class="form-control" placeholder="">
      </div>
      <div class="col-12 mb-3">
        <label for="email" class="form-label">E-mail</label>
        <input type="email" name="email" id="email" class="form-control" placeholder="">
      </div>
      <div class="col-md-4 mb-3">
        <label for="celular" class="form-label">Celular</label>
        <input type="text" name="celular" id="celular" class="form-control" placeholder="">
      </div>
      <div class="col-md-4 mb-3">
        <label for="estadocivil" class="form-label">Estado Civil</label>
        <select name="estadocivil" id="estadocivil" class="form-select">
          <option>Selecione o Estado Civil</option>
          <option value="Sol">Solteiro</option>
          <option value="Cas">Casado</option>
          <option value="Sep">Separado</option>
          <option value="Div">Divorciado</option>
          <option value="Viú">Viúvo</option>
        </select>
      </div>
      <div class="col-md-4 mb-3">
        <label for="" class="form-label">Status</label>
        <div>
          <div class="btn-group" role="group" aria-label="Basic radio toggle button group">
            <input type="radio" class="btn-check" name="status" id="ativo" autocomplete="off" value="A">
            <label class="btn btn-outline-success" for="ativo">Ativo</label>

            <input type="radio" class="btn-check" name="status" id="inativo" autocomplete="off" value="I">
            <label class="btn btn-outline-danger" for="inativo">Inativo</label>
          </div>
        </div>
      </div>
      <div class="col-12 mb-3">
        <label for="foto" class="form-label">Foto</label>
        <input type="file" name="foto" id="foto" class="form-control" placeholder="" accept="image/*">
      </div>
      <div class="col-12 mb-3">
        <button type="submit" class="btn btn-primary" name="salvar">
          Salvar
        </button>
      </div>
    </form>
  </div>
  </main>
  <footer>

  </footer>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
    integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz"
    crossorigin="anonymous"></script>
</body>

</html>