<?php
$pdo = new PDO("mysql:host=localhost;dbname=todo_list", "root", "");

if (isset($_GET['id'])) {
    $id = $_GET['id'];

    // Verificar o status atual da tarefa
    $stmt = $pdo->prepare("SELECT status FROM tasks WHERE id = ?");
    $stmt->execute([$id]);
    $task = $stmt->fetch();

    if ($task) {
        // Inverter o status
        $newStatus = ($task['status'] == 0) ? 1 : 0;
        $stmt = $pdo->prepare("UPDATE tasks SET status = ?, updated_at = CURRENT_TIMESTAMP WHERE id = ?");
        $stmt->execute([$newStatus, $id]);
    }

    header("Location: index.php");
    exit();
}
?>
