<?php

class Conexao{
    private $servername = "localhost";
    private $username = "root";
    private $password = "";
    private $dbname = "dbgerenciador";
    private $conn;

    public function __construct(){
        $this->conn = new mysqli($this->servername, $this->username, $this->password, $this->dbname);

        if($this->conn->connect_error)
            die("Falha ao conectar com o banco de dados: " . $this->conn->connect_error);

        $this->CreateDatabase();
        $this->CreateTableTasks();
    }

    private function CreateDatabase(){
        $sql = "CREATE DATABASE IF NOT EXISTS " . $this->dbname;
        
        if($this->conn->query($sql) === false)
            die("Erro ao criar o banco de dados: " . $this->conn->error);
    }

    private function CreateTableTasks(){
        $sql = "CREATE TABLE IF NOT EXISTS task (
            id INT(11) AUTO_INCREMENT PRIMARY KEY,
            task_name VARCHAR(50) NOT NULL,
            completed INT NOT NULL
        )";

        if($this->conn->query($sql) === false)
            die("Erro ao criar a tabela 'task': " . $this->conn->error);
    }

    public function getConexao(){
        return $this->conn;
    }

    public function CloseConnection(){
        $this->conn->close();
    }
}