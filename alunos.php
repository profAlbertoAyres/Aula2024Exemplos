<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">

    <title>Confraternização</title>
</head>

<body>
    <header>
        <nav class="navbar navbar-expand-lg bg-body-tertiary">
            <div class="container-fluid">
                <a class="navbar-brand" href="#">
                    <img src="imagens/logo.png" alt="" width="30" height="24" class="d-inline-block align-text-top">
                    IFRO - Cacoal</a>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse"
                    data-bs-target="#navbarNavDropdown" aria-controls="navbarNavDropdown" aria-expanded="false"
                    aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse" id="navbarNavDropdown">
                    <ul class="navbar-nav">
                        <li class="nav-item">
                            <a class="nav-link" href="index.php">Home</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link active" aria-current="page" href="#">Alunos</a>
                        </li>
                    </ul>
                </div>
            </div>
        </nav>
    </header>
    <main class="container mt-3">
        <table class="table">
            <thead>
                <tr class="table-secondary table-striped table-hover">
                    <th scope="col" class="text-center">#</th>
                    <th scope="col" class="text-center">Nome</th>
                    <th scope="col" class="text-center">Email</th>
                    <th scope="col" class="text-center">Celular</th>
                    <th scope="col" class="text-center">Ações</th>
                </tr>
            </thead>
            <tbody>

            <!-- Código php para spl_autoload_register -->
             
            <?php
            spl_autoload_register(function ($class) {
                require_once("classes/{$class}.class.php");
            });
            $aluno = new Aluno();
            $alunos = $aluno->all();
            foreach ($alunos as $al) {
            ?>
                <tr>
                    <td scope="row" class="text-center"><?php echo  $al->id ?></td>
                    <td><?php echo  $al->nome ?></td>
                    <td><?php echo  $al->email ?></td>
                    <td><?php echo  $al->celular ?></td>
                    <td class="text-center">
                        <a href="#" class="btn btn-primary btn-sm"><i class="bi bi-pencil-square"></i></a>
                        <a href="#" class="btn btn-danger btn-sm"><i class="bi bi-trash"></i></a>
                    </td>
                </tr>
                <?php } ?>
            </tbody>
        </table>
        <div class="mt-3">
            <a href="cadAluno.php" class="btn btn-warning">Novo Aluno</a>
        </div>
    </main>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz"
        crossorigin="anonymous"></script>
</body>

</html>