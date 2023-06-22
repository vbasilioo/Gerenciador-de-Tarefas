<?php

require_once 'database/Conexao.php';
require_once 'database/Query.php';

$query = new Query();

if(isset($_POST['task_name'])){
    $query->AddTask($_POST['task_name']);
    header("Location: index.php");
}

if(isset($_GET['complete'])){
    $query->CompleteTask($_GET['complete']);
    header("Location: index.php");
}

$tasks = $query->GetAllTasks();
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" type="text/css" href="style.css">
    <title>Gerenciador de Tarefas</title>
</head>
<body>
    <h1>Gerenciador de Tarefas</h1>
    <form method="POST" action="index.php">
        <input type="text" name="task_name" placeholder="Nova tarefa" required>
        <button type="submit">Adicionar</button>
    </form>
    <ul>
        <?php foreach($tasks as $task): ?>
            <li>
                <?php echo $task['task_name']; ?>
                <?php if($task['completed'] == 0): ?>
                    <a href="index.php?complete=<?php echo $task['id']; ?>">Concluir</a>
                <?php else: ?>
                    (Concluída)
                <?php endif; ?>
            </li>
        <?php endforeach; ?>
    </ul>
</body>
</html>