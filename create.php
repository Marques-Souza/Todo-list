<?php
// Conexão com o banco de dados
$pdo = new PDO("mysql:host=localhost;dbname=todo_list", "root", "");

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Captura os dados do formulário
    $title = $_POST['title'];
    $description = $_POST['description'] ?? ''; // Descrição é opcional

    // Verifica se o título não está vazio
    if (!empty($title)) {
        // Inserir nova tarefa no banco de dados
        $stmt = $pdo->prepare("INSERT INTO tasks (title, description) VALUES (?, ?)");
        $stmt->execute([$title, $description]);

        // Redirecionar para a página de listagem após salvar
        header("Location: index.php");
        exit();
    } else {
        echo "O título é obrigatório!";
    }
}
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Adicionar Tarefa</title>
    <link rel="stylesheet" href="css/style.css">
</head>
<body>
    <div class="container">
        <h1>Adicionar Nova Tarefa</h1>
        <form action="adicionar.php" method="POST">
            <label for="title">Título:</label>
            <input type="text" id="title" name="title" required>

            <label for="description">Descrição (opcional):</label>
            <textarea id="description" name="description"></textarea>

            <button type="submit">Adicionar Tarefa</button>
        </form>
    </div>
</body>
</html>
