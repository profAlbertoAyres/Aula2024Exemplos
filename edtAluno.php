<?php

if (filter_has_var(INPUT_POST, "atualizar")) {
    spl_autoload_register(function ($class) {
        require_once("classes/{$class}.class.php");
      });
    $diretorio = 'imagensAlunos/';
    $aluno = new Aluno;
    $aluno->setNome(filter_input(INPUT_POST, 'nome'));
    $aluno->setEmail(filter_input(INPUT_POST, 'email'));
    $aluno->setCelular(filter_input(INPUT_POST, 'celular'));
    $aluno->setEstadoCivil(filter_input(INPUT_POST, 'estadocivil'));
    $aluno->setStatus(filter_input(INPUT_POST, 'status'));
    $fotoAtual = filter_input(INPUT_POST, 'fotoAtual');
    $aluno->setFoto($fotoAtual);
    if (!is_dir($diretorio)) {
        die("O diretório '$diretorio' não existe.");
    }

    if (isset($_FILES['foto'] )&& $_FILES['foto']['error'] === UPLOAD_ERR_OK) {
        $arquivo = $_FILES['foto'];
        
        $extensao = strtolower(pathinfo(basename($arquivo['name']), PATHINFO_EXTENSION));
        $nomeArquivo = uniqid() . '.' . $extensao;
        $caminhoArquivo = $diretorio . $nomeArquivo;
        
        if (file_exists($diretorio . $fotoAtual)) {
            unlink($diretorio . $fotoAtual); // Apaga a foto antiga
        }

        if (!move_uploaded_file($arquivo['tmp_name'], $caminhoArquivo)) {
            die("Erro ao mover o arquivo.");
        }
        $aluno->setFoto($nomeArquivo);
    }



    // Atualiza aluno
    $id = intval(filter_input(INPUT_POST, 'id'));
    if($aluno->update("id", $id, )){  
        echo "<script>window.alert('Atualizado com sucesso.'); window.location.href='alunosDiv.php';</script>";

    }else{
        echo "<script>window.alert('Atualizado com sucesso.'); window.open(document.referrer,'_self');</script>";
    }
}