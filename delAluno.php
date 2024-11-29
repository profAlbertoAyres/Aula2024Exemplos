<?php
  require_once 'validaUser.php';
  spl_autoload_register(function ($class) {
    require_once "classes/{$class}.class.php";
  });

  // Verifica se existe um aluno para editar
  if (filter_has_var(INPUT_POST,"id")) {
    $aluno = new Aluno;
    $id = intval(filter_input(INPUT_POST, "id"));
    if($aluno->delete("id", $id, )){  
        echo "<script>window.alert('Aluno excluido com sucesso.'); window.location.href='alunos_div.php.php';</script>";

    }else{
        echo "<script>window.alert('Erro ao excluir com sucesso.');  window.location.href='alunos_div.php.php';</script>";
    }
  }