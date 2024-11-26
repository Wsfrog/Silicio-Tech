<?php
session_start();
require '../BancoDAO/db.php';

$email = $_POST['email'];
$senha = $_POST['senha'];
$nome = $_POST['nome'];
$tipo = $_POST['tipo'];

// Criação do hash da senha
$senha_hash = password_hash($senha, PASSWORD_DEFAULT);

// Inserção no banco de dados
$sql = "INSERT INTO usuarios (email, senha, nome, tipo) VALUES (?, ?, ?, ?)";
$stmt = $conn->prepare($sql);
$stmt->bind_param("ssss", $email, $senha_hash, $nome, $tipo);

if ($stmt->execute()) {
    echo "Cadastro realizado com sucesso!";
} else {
    echo "Erro ao cadastrar usuário: " . $conn->error;
}

$conn->close();
?>