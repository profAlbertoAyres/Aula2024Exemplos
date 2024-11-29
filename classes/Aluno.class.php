<?php

// script do banco de dados
// CREATE TABLE aluno (
//     id int NOT NULL AUTO_INCREMENT,
//     nomeAluno varchar(255) NOT NULL,
//     emailAluno varchar(255) NOT NULL,
//     celularAluno varchar(14) NOT NULL,
//     estadoCivilAluno varchar(5) NOT NULL,
//     statusAluno varchar(1) NOT NULL,
//     Foto varchar(255) DEFAULT NULL,
//     PRIMARY KEY (id)
//   );
  
class Aluno extends CRUD{
    protected $table = "Aluno";
    private $id;
    private $nome;
    private $email;
    private $celular;
    private $estadoCivil;
    private $status;
    private $foto;

    public function __construct() {
        
    }


    /**
     * Get the value of nome
     */ 
    public function getNome()
    {
        return $this->nome;
    }

    /**
     * Set the value of nome
     *
     * @return  self
     */ 
    public function setNome($nome)
    {
        $this->nome = $nome;

        return $this;
    }

    /**
     * Get the value of id
     */ 
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set the value of id
     *
     * @return  self
     */ 
    public function setId($id)
    {
        $this->id = $id;

        return $this;
    }

    /**
     * Get the value of email
     */ 
    public function getEmail()
    {
        return $this->email;
    }

    /**
     * Set the value of email
     *
     * @return  self
     */ 
    public function setEmail($email)
    {
        $this->email = $email;

        return $this;
    }

    /**
     * Get the value of estadoCivil
     */ 
    public function getEstadoCivil()
    {
        return $this->estadoCivil;
    }

    /**
     * Set the value of estadoCivil
     *
     * @return  self
     */ 
    public function setEstadoCivil($estadoCivil)
    {
        $this->estadoCivil = $estadoCivil;

        return $this;
    }

    /**
     * Get the value of status
     */ 
    public function getStatus()
    {
        return $this->status;
    }

    /**
     * Set the value of status
     *
     * @return  self
     */ 
    public function setStatus($status)
    {
        $this->status = $status;

        return $this;
    }

    /**
     * Get the value of foto
     */ 
    public function getFoto()
    {
        return $this->foto;
    }

    /**
     * Set the value of foto
     *
     * @return  self
     */ 
    public function setFoto($foto)
    {
        $this->foto = $foto;

        return $this;
    }

    function add(){
        // SQL de inserção
        $sql = "INSERT INTO Aluno (nomeAluno, emailAluno, celularAluno, estadoCivilAluno, statusAluno, Foto) 
                VALUES (:nome, :email, :celular, :estadoCivil, :status, :foto)";

        // Preparar a declaração usando a classe Database
        $stmt = Database::prepare($sql);

        // Atribuir os valores aos parâmetros
        $stmt->bindParam(':nome', $this->nome);
        $stmt->bindParam(':email', $this->email);
        $stmt->bindParam(':celular', $this->celular);
        $stmt->bindParam(':estadoCivil', $this->estadoCivil);
        $stmt->bindParam(':status', $this->status);
        $stmt->bindParam(':foto', $this->foto);

        // Executar a consulta e verificar se funcionou
        return $stmt->execute();

    }
    function update($campo, $id){
        $sql = "UPDATE $this->table SET nomeAluno=:nome, emailAluno=:email, celularAluno=:celular, estadocivilAluno=:estadocivilAluno, statusAluno=:status, Foto=:foto WHERE $campo=:id";
        $stmt = Database::prepare($sql);
        // Atribuir os valores aos parâmetros
        $stmt->bindParam(':nome', $this->nome);
        $stmt->bindParam(':email', $this->email);
        $stmt->bindParam(':celular', $this->celular);
        $stmt->bindParam(':estadocivil', $this->estadoCivil);
        $stmt->bindParam(':status', $this->status);
        $stmt->bindParam(':foto', $this->foto);
        $stmt->bindParam(":id",$id,PDO::PARAM_INT);

        // Executar a consulta e verificar se funcionou
        return $stmt->execute();
    }

    /**
     * Get the value of celular
     */ 
    public function getCelular()
    {
        return $this->celular;
    }

    /**
     * Set the value of celular
     *
     * @return  self
     */ 
    public function setCelular($celular)
    {
        $this->celular = $celular;

        return $this;
    }
}