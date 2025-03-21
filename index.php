<?php
// Conexão com o banco de dados
$pdo = new PDO("mysql:host=localhost;dbname=todo_list", "root", "");

// Verificação de método POST para adicionar nova tarefa
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    if (isset($_POST['title']) && !empty($_POST['title'])) {
        $title = $_POST['title'];
        $description = $_POST['description'] ?? '';
        $stmt = $pdo->prepare("INSERT INTO tasks (title, description, status) VALUES (?, ?, 0)"); // Status 0 = Pendente
        $stmt->execute([$title, $description]);
        header("Location: index.php"); // Redirecionar após inserir
    }
}

// Filtrar tarefas com base no status (pendente, concluída ou todas)
$filter = $_GET['filter'] ?? 'all';
$statusCondition = '';

// Definir a condição de filtro no SQL com base no filtro recebido
if ($filter === 'pendente') {
    $statusCondition = 'WHERE status = 0';
} elseif ($filter === 'concluida') {
    $statusCondition = 'WHERE status = 1';
} else {
    $statusCondition = ''; // Exibir todas
}

$sql = "SELECT * FROM tasks $statusCondition";
$stmt = $pdo->prepare($sql);
$stmt->execute();
$tasks = $stmt->fetchAll();
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>To-Do List</title>
    <link rel="stylesheet" href="css/style.css">
</head>
<body>
    <div class="container">
        <h1>Lista de Tarefas</h1>
        
        <!-- Filtro de tarefas -->
        <div class="filter">
            <a href="?filter=all" class="filter-btn">Todos</a>
            <a href="?filter=pendente" class="filter-btn">Pendente</a>
            <a href="?filter=concluida" class="filter-btn">Concluídas</a>
        </div>

        <!-- Formulário para criar tarefa -->
        <form action="index.php" method="POST">
            <label for="title">Título:</label>
            <input type="text" id="title" name="title" required>

            <label for="description">Descrição (opcional):</label>
            <textarea id="description" name="description"></textarea>

            <button type="submit">Adicionar Tarefa</button>
        </form>

        <!-- Lista de tarefas -->
        <ul id="task-list">
            <?php foreach ($tasks as $task): ?>
                <li class="task <?php echo $task['status'] ? 'completed' : ''; ?>" data-status="<?php echo $task['status'] == 1 ? 'concluida' : 'pendente'; ?>">
                    <h3><?php echo htmlspecialchars($task['title']); ?></h3>
                    <p><?php echo htmlspecialchars($task['description']); ?></p>
                    <div class="actions">
                        <a href="edit.php?id=<?php echo $task['id']; ?>" class="btn-edit">Editar</a>
                        <a href="delete.php?id=<?php echo $task['id']; ?>" class="btn-delete">Excluir</a>
                        <a href="complete.php?id=<?php echo $task['id']; ?>" class="btn-complete">
                            <?php echo $task['status'] ? 'Marcar como Pendente' : 'Marcar como Concluída'; ?>
                        </a>
                    </div>
                </li>
            <?php endforeach; ?>
        </ul>
    </div>
</body>
</html>
