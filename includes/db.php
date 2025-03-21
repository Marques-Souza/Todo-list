<?php
$host = 'localhost'; // Ou o host do seu banco
$dbname = 'todo_list'; // Aqui é o  nome do banco de dados
$username = 'root'; // Seu usuário do MySQL
$password = ''; // Sua senha do MySQL

try {
    // Aqui é a criação da conexão PDO
    $pdo = new PDO("mysql:host=$host;dbname=$dbname", $username, $password);

    // Definir o modo de erro do PDO
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    // Caso ocorra erro na conexão
    die("Erro na conexão: " . $e->getMessage());
}
?>