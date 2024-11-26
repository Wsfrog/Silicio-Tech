<?php
// Conexão com o banco de dados
$servername = "localhost";
$username = "root"; // Altere conforme necessário
$password = ""; // Altere conforme necessário
$dbname = "etech"; // Altere conforme necessário

// Cria a conexão
$conn = new mysqli($servername, $username, $password, $dbname);

// Verifica a conexão
if ($conn->connect_error) {
    die("Conexão falhou: " . $conn->connect_error);
}

// Verifica se o id foi passado via GET
if (isset($_GET['id']) && !empty($_GET['id'])) {
    $id = $_GET['id'];

    // Prepara a consulta SQL para buscar o registro com o id fornecido
    $sql = "SELECT * FROM moradores WHERE id = $id";
    $result = $conn->query($sql);

    // Verifica se encontrou algum resultado
    if ($result->num_rows > 0) {
        // Se encontrar o registro, pega os dados
        $row = $result->fetch_assoc();
    } else {
        // Caso não encontre o registro, exibe uma mensagem
        echo "Registro não encontrado!";
        exit;
    }
} else {
    echo "ID não fornecido!";
    exit;
}

// Fecha a conexão
$conn->close();
?>

<!-- Formulário de edição -->
<form action="atualizar.php" method="POST">
    <input type="hidden" name="id" value="<?php echo $row['id']; ?>">
    <div class="form-group">
        <label for="nome">Nome:</label>
        <input type="text" class="form-control" id="nome" name="nome" value="<?php echo htmlspecialchars($row['nome']); ?>" required>
    </div>
    <div class="form-group">
        <label for="apartamento">Apartamento:</label>
        <input type="text" class="form-control" id="apartamento" name="apartamento" value="<?php echo htmlspecialchars($row['apartamento']); ?>" required>
    </div>
    <div class="form-group">
        <label for="email">Email:</label>
        <input type="email" class="form-control" id="email" name="email" value="<?php echo htmlspecialchars($row['email']); ?>" required>
    </div>
    <div class="form-group">
        <label for="telefone">Telefone:</label>
        <input type="text" class="form-control" id="telefone" name="telefone" value="<?php echo htmlspecialchars($row['telefone']); ?>" required>
    </div>
    <button type="submit" class="btn btn-custom mt-3">Atualizar</button>
</form>
