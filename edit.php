<?php
// Função para conectar ao banco de dados
function getDbConnection() {
    return new PDO("mysql:host=localhost;dbname=todo_list", "root", "");
}

if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['id'])) {
    // Obter os dados do formulário
    $id = $_POST['id'];
    $title = $_POST['title'];
    $description = $_POST['description'] ?? '';  // Usando operador null coalescing

    // Validar dados (exemplo simples de validação)
    if (!empty($title)) {
        // Atualizar tarefa no banco de dados
        $pdo = getDbConnection();
        $stmt = $pdo->prepare("UPDATE tasks SET title = ?, description = ?, updated_at = CURRENT_TIMESTAMP WHERE id = ?");
        $stmt->execute([$title, $description, $id]);

        // Redirecionar após atualização com mensagem de sucesso
        header("Location: index.php?msg=Tarefa atualizada com sucesso!");
        exit();
    } else {
        echo "O título da tarefa não pode ser vazio.";
    }
}

if (isset($_GET['id'])) {
    // Buscar a tarefa para editar
    $id = $_GET['id'];
    $pdo = getDbConnection();
    $stmt = $pdo->prepare("SELECT * FROM tasks WHERE id = ?");
    $stmt->execute([$id]);
    $task = $stmt->fetch();

    if (!$task) {
        echo "Tarefa não encontrada.";
        exit();
    }
}
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Editar Tarefa</title>
    <link rel="stylesheet" href="css/style.css">
</head>
<body>
    <div class="container">
        <h1>Editar Tarefa</h1>
        <form action="edit.php" method="POST">
            <!-- Campo escondido para o ID -->
            <input type="hidden" name="id" value="<?php echo $task['id']; ?>">

            <!-- Campo de título -->
            <label for="title">Título:</label>
            <input type="text" id="title" name="title" value="<?php echo htmlspecialchars($task['title']); ?>" required>

            <!-- Campo de descrição -->
            <label for="description">Descrição (opcional):</label>
            <textarea id="description" name="description"><?php echo htmlspecialchars($task['description']); ?></textarea>

            <!-- Botão de salvar alterações -->
            <button type="submit">Salvar Alterações</button>
        </form>
    </div>
</body>
</html>
