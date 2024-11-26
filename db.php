<?php
$servername = "localhost";
$username = "root";  // Substitua com seu usuário do banco de dados
$password = "";      // Substitua com sua senha
$dbname = "etech";    // Substitua com o nome correto do seu banco de dados

// Criar a conexão
$conn = new mysqli($servername, $username, $password, $dbname);

// Verificar a conexão
if ($conn->connect_error) {
    die("Falha na conexão: " . $conn->connect_error);
}
?>
