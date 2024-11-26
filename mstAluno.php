<!DOCTYPE html>
<html lang="pt-br">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
    integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
  <title>Gerenciar Aluno</title>
</head>

<body>
  <header>
    <nav class="navbar navbar-expand-lg bg-body-tertiary">
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
              <a class="nav-link" href="index.php">Home</a>
            </li>
            <li class="nav-item">
              <a class="nav-link active" aria-current="page" href="alunosDiv.php">Alunos</a>
            </li>
          </ul>
        </div>
      </div>
    </nav>
  </header>

  <?php
  spl_autoload_register(function ($class) {
    require_once "classes/{$class}.class.php";
  });

  // Verifica se existe um aluno para editar
  if (filter_has_var(INPUT_GET,"id")) {
    $alunoEdt = new Aluno;
    $id = intval(filter_input(INPUT_GET, "id"));
    $aluno = $alunoEdt->search("id",$id); // método para pegar os dados do aluno (implemente-o na classe Aluno)

    // Preenche os campos do formulário com os dados do aluno
  }
  ?>

  <div class="container">
    <form action="<?php echo htmlspecialchars("edtAluno.php") ?>" method="post" class="row g3" enctype="multipart/form-data">
        <input type="hidden" name="id" value="<?php echo $aluno->id ?? ''; ?>" />
      
      <div class="col-12 mb-3">
        <label for="nome" class="form-label">Nome</label>
        <input type="text" name="nome" id="nome" class="form-control" value="<?php echo  $aluno->nome ?? ''; ?>" required>
      </div>
      <div class="col-12 mb-3">
        <label for="email" class="form-label">E-mail</label>
        <input type="email" name="email" id="email" class="form-control" value="<?php echo $aluno->email ?? ''; ?>" required>
      </div>
      <div class="col-md-4 mb-3">
        <label for="celular" class="form-label">Celular</label>
        <input type="text" name="celular" id="celular" class="form-control" value="<?php echo $aluno->celular ?? ''; ?>" required>
      </div>
      <div class="col-md-4 mb-3">
        <label for="estadocivil" class="form-label">Estado Civil</label>
        <select name="estadocivil" id="estadocivil" class="form-select">
          <option>Selecione o Estado Civil</option>
          <option value="Sol" <?php echo ($aluno->estadocivil == 'Sol') ? 'selected' : ''; ?>>Solteiro</option>
          <option value="Cas" <?php echo ($aluno->estadocivil == 'Cas') ? 'selected' : ''; ?>>Casado</option>
          <option value="Sep" <?php echo ($aluno->estadocivil == 'Sep') ? 'selected' : ''; ?>>Separado</option>
          <option value="Div" <?php echo ($aluno->estadocivil == 'Div') ? 'selected' : ''; ?>>Divorciado</option>
          <option value="Viú" <?php echo ($aluno->estadocivil == 'Viú') ? 'selected' : ''; ?>>Viúvo</option>
        </select>
      </div>
      <div class="col-md-4 mb-3">
        <label for="" class="form-label">Status</label>
        <div>
          <div class="btn-group" role="group" aria-label="Basic radio toggle button group">
            <input type="radio" class="btn-check" name="status" id="ativo" autocomplete="off" value="A" <?php echo ($aluno->status == 'A') ? 'checked' : ''; ?>>
            <label class="btn btn-outline-success" for="ativo">Ativo</label>

            <input type="radio" class="btn-check" name="status" id="inativo" autocomplete="off" value="I" <?php echo ($aluno->status == 'I') ? 'checked' : ''; ?>>
            <label class="btn btn-outline-danger" for="inativo">Inativo</label>
          </div>
        </div>
      </div>
      <div class="col-12 mb-3">
        <label for="foto" class="form-label">Foto</label>
        <input type="file" name="foto" id="foto" class="form-control" accept="image/*">
        <?php 
            $fotoAtual = $aluno->foto;
        if (!empty($fotoAtual)): ?>
        <br>
        <img src="imagensAlunos/<?php echo $fotoAtual; ?>" alt="Foto Atual" width="100">
        <input type="hidden" name="fotoAtual" value="<?php echo $aluno->foto;?>" />
    <?php endif; ?>
      </div>
      <div class="col-12 mb-3">
        <button type="submit" class="btn btn-primary" name="atualizar">
          Atualizar
        </button>
      </div>
      
    </form>
  </div>

  <footer></footer>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>
