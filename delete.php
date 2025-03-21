<?php
// Conexão com o banco de dados
$pdo = new PDO("mysql:host=localhost;dbname=todo_list", "root", "");

if (isset($_GET['id'])) {
    $id = $_GET['id'];

    // Excluir tarefa
    $stmt = $pdo->prepare("DELETE FROM tasks WHERE id = ?");
    $stmt->execute([$id]);

    header("Location: index.php"); // Redirecionar após exclusão
    exit();
}
?>
