<?php

class Database {
    private $host;
    private $dbName;
    private $username;
    private $password;
    private $charset = 'utf8mb4';
    private $pdo;
    private $error;

    public function __construct() {
        $this->host = "DB_HOST";
        $this->dbName = "DB_NAME";
        $this->username = "DB_USER";
        $this->password = "DB_PASS";
        $this->connect();
    }

    private function connect() {
        $dsn = "mysql:host={$this->host};dbname={$this->dbName};charset={$this->charset}";
        $options = [
            PDO::ATTR_ERRMODE            => PDO::ERRMODE_EXCEPTION,
            PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
            PDO::ATTR_PERSISTENT         => false,
            PDO::ATTR_EMULATE_PREPARES   => false
        ];

        try {
            $this->pdo = new PDO($dsn, $this->username, $this->password, $options);
        } catch (PDOException $e) {
            $this->error = $e->getMessage();
            echo "Erro na conexão: " . $this->error;
            // Pode-se registrar esse erro em um log de segurança
        }
    }
}