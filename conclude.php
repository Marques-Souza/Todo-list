// complete.php
<?php
// Conexão com o banco de dados
$pdo = new PDO("mysql:host=localhost;dbname=todo_list", "root", "");

// Verificar se o ID da tarefa foi passado
if (isset($_GET['id'])) {
    $taskId = $_GET['id'];

    // Alterar o status da tarefa (inverte de pendente para concluída e vice-versa)
    $stmt = $pdo->prepare("SELECT status FROM tasks WHERE id = ?");
    $stmt->execute([$taskId]);
    $task = $stmt->fetch();

    if ($task) {
        // Inverter o status
        $newStatus = ($task['status'] == 0) ? 1 : 0;
        $stmt = $pdo->prepare("UPDATE tasks SET status = ? WHERE id = ?");
        $stmt->execute([$newStatus, $taskId]);
    }

    header('Location: index.php'); // Redirecionar após atualização
    exit();
} else {
    echo "ID da tarefa não fornecido.";
}
?>
