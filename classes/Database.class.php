<?php

final class Database
{
    private static $driver = 'mysql';  # Escolher qual o banco vai utilizar, coloquei para MYSQL ou PostgreSQL
    private static $host = "localhost"; #Endereço da banco de dados
    private static $dbName = "aulapw"; # Nome do banco de dados
    private static $username = "root"; # Usuário do banco de dados 
    private static $password = ""; # Senha do banco de dados 
    private static $charset = 'utf8mb4';  # Charset usado que vai utilizar, pelos acentos

    public static $port = 3306; #Define a porta do banco de dados 
    private static $pdo = null; # Vamos utilizar para conectar
    private static $error; # guardar os erros

    // Método privado que será utlizado quando deseja conectar ao banco de dados
    private static function connect()
    {
        if (self::$pdo === null) {
            // Monta a conexão conforme o banco de dados
            if (self::$driver === 'mysql') {
                // para conectar ao MySQL
                $dsn = "mysql:host=" . self::$host . ";port=" . self::$port . ";dbname=" . self::$dbName . ";charset=" . self::$charset;
            } elseif (self::$driver === 'pgsql') {
                # para conectar ao PostgreSQL
                $dsn = "pgsql:host=" . self::$host . ";port=" . self::$port . ";dbname=" . self::$dbName;
            } else {
                # para se digitar o drive de conexão errado.
                throw new Exception("Driver de banco de dados não suportado: " . self::$driver);
            }

            
            $options = [
                PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION, # definindo o mode de tratamento de erros
                PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_OBJ, # como os dados vão retornar nas consultas
                PDO::ATTR_PERSISTENT => false, # para abrir uma nova conexão toda vez
                PDO::ATTR_EMULATE_PREPARES => false #Evita emular pelo PHP
            ];

            try {
                # Criando nossa conexão utilizando o PDO
                self::$pdo = new PDO($dsn, self::$username, self::$password, $options);
                #caso ocorra erro será tratado no cath
            } catch (PDOException $e) {
                self::$error = $e->getMessage();
                echo "Erro na conexão: " . self::$error;
            }
        }
        # Retorna a conexão
        return self::$pdo;
    }

    # Método estático para realizar uma consulta
    public static function query($sql)
    {
        $pdo = self::connect();
        if ($pdo) {
            return $pdo->query($sql);
        }

        return false;
    }

    # Método estático para preparar uma declaração SQL
    public static function prepare($sql)
    {
        $pdo = self::connect();
        if ($pdo) {
            return $pdo->prepare($sql);
        }

        return false;
    }

    
    public static function setDriver($driver)
    {
        self::$driver = $driver;
    }
}
