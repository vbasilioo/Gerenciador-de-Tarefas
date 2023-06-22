<?php

require_once 'Conexao.php';

class Query{
    private $conexao;

    public function __construct(){
        $this->conexao = new Conexao();
    }

    public function AddTask($name){
        $stmt = $this->conexao->getConexao()->prepare("INSERT INTO task (task_name, completed) VALUES (?, 0)");
        $stmt->bind_param('s', $name);
        $stmt->execute();
    }    

    public function CompleteTask($id){
        $stmt = $this->conexao->getConexao()->prepare("UPDATE task SET completed = 1 WHERE id = ?");
        $stmt->bind_param('i', $id);
        $stmt->execute();
    }    

    public function GetAllTasks(){
        $stmt = $this->conexao->getConexao()->query("SELECT * FROM task ORDER BY id DESC");
        return $stmt->fetch_all(MYSQLI_ASSOC);
    }
}
