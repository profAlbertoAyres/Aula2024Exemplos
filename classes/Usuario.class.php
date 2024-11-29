<?php

if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

class Usuario extends CRUD
{

    protected $table = "Usuario";
    private $id;
    private $nome;
    private $email;
    private $senha;
    private $nivel_acesso;

    //Adiciona um usuário
    public function add()
    {
        $query = "INSERT INTO $this->table (nome, email, senha, nivel_acesso) 
                  VALUES (:nome, :email, :senha, :nivel_acesso)";
        $stmt = Database::prepare($query);

        try {
            $stmt->bindParam(':nome', $this->nome, PDO::PARAM_STR);
            $stmt->bindParam(':email', $this->email, PDO::PARAM_STR);
            $stmt->bindParam(':senha', $this->senha, PDO::PARAM_STR);
            $stmt->bindParam(':nivel_acesso', $this->nivel_acesso, PDO::PARAM_INT);
            return $stmt->execute();
        } catch (PDOException $e) {
            echo "Erro ao criar usuário: " . $e->getMessage();
            return false;
        }
    }

    // Atualizar um usuário existente
    public function update($campo, $id)
    {
        $query = "UPDATE $this->table 
                  SET nome = :nome, email = :email, senha = :senha, nivel_acesso = :nivel_acesso 
                  WHERE $campo = :id";
        $stmt = Database::prepare($query);

        try {
            $stmt->bindParam(':nome', $this->nome, PDO::PARAM_STR);
            $stmt->bindParam(':email', $this->email, PDO::PARAM_STR);
            $stmt->bindParam(':senha', $this->senha, PDO::PARAM_STR);
            $stmt->bindParam(':nivel_acesso', $this->nivel_acesso, PDO::PARAM_INT);
            $stmt->bindParam(':id', $this->id, PDO::PARAM_INT);
            return $stmt->execute();
        } catch (PDOException $e) {
            echo "Erro ao atualizar usuário: " . $e->getMessage();
            return false;
        }
    }

    #Efetuar Login
    public function login()
    {
        $query = "SELECT * FROM " . $this->table . " WHERE nome = :nome";
        $stmt = Database::prepare($query);
        $stmt->bindParam(':nome', $this->nome);
        $stmt->execute();

        if ($stmt->rowCount() > 0) {
            $usuario = $stmt->fetch(PDO::FETCH_OBJ);
            if (password_verify($this->senha, $usuario->senha)) {
                $_SESSION['user_name'] = $usuario->nome;
                $_SESSION['nivel_acesso'] = $usuario->nivel_acesso; // Armazena o nível de acesso
                $_SESSION['ultimaAtividade'] = time(); // Armazena a hora da última atividade
                $redirect_url = $_POST['redirect'] ?? 'dashboard.php';
                header("Location: $redirect_url");
                exit();
            }
        }

        return "Usuário ou Senha incorreta. Por favor, tente novamente.";
    }

    //Efetuar Logoff

    public function logout()
    {
        session_unset();
        session_destroy();
        header("Location: login.php");
        exit();
    }

    #Expirar 

    public function sessaoExpirou()
    {
        $tempo = 1800; // 30 minutos de inatividade
        if (isset($_SESSION['ultimaAtividade']) && (time() - $_SESSION['ultimaAtividade']) > $tempo) {
            $this->logout();
            return true;
        }
        $_SESSION['ultimaAtividade'] = time(); // Atualiza a hora da última atividade
        return false;
    }

    public function verificarNivelAcesso($nivelNecessario)
    {
        // Verifica se o usuário está logado
        if (!isset($_SESSION['user_id'])) {
            return false; // Usuário não está logado
        }

        // Verifica se o nível de acesso do usuário atende ao nível necessário
        if (isset($_SESSION['nivel_acesso']) && $_SESSION['nivel_acesso'] >= $nivelNecessario) {
            return true; // Usuário tem permissão
        }

        return false; // Usuário não tem permissão
    }

    public function getId()
    {
        return $this->id;
    }


    public function setId($id)
    {
        $this->id = $id;

        return $this;
    }


    public function getNome()
    {
        return $this->nome;
    }


    public function setNome($nome)
    {
        $this->nome = $nome;

        return $this;
    }

    public function getEmail()
    {
        return $this->email;
    }

    public function setEmail($email)
    {
        $this->email = $email;

        return $this;
    }


    public function getSenha()
    {
        return $this->senha;
    }

    public function setSenha($senha)
    {
        $this->senha = $senha;

        return $this;
    }

    public function getNivel_acesso()
    {
        return $this->nivel_acesso;
    }

    public function setNivel_acesso($nivel_acesso)
    {
        $this->nivel_acesso = $nivel_acesso;

        return $this;
    }
}
