<?php
// Conexão com o banco de dados
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "etech";

// Cria a conexão
$conn = new mysqli($servername, $username, $password, $dbname);

// Verifica a conexão
if ($conn->connect_error) {
    die("Conexão falhou: " . $conn->connect_error);
}

// Verifica se o ID foi passado pela URL
if (isset($_GET['id'])) {
    $id = $_GET['id'];

    // Deleta o registro
    $sql = "DELETE FROM moradores WHERE id = $id";

    if ($conn->query($sql) === TRUE) {
        echo "Registro deletado com sucesso!";
        header("Location: index.php"); // Redireciona para a página principal após exclusão
        exit;
    } else {
        echo "Erro ao deletar o registro: " . $conn->error;
    }
}

// Fecha a conexão
$conn->close();
?>
