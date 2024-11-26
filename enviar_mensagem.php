<?php
// Conexão com o banco de dados
$host = 'localhost';
$user = 'root';
$password = '';
$dbname = 'teemo';

$conn = new mysqli($host, $user, $password, $dbname);

if ($conn->connect_error) {
    die("Conexão falhou: " . $conn->connect_error);
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $nome = $_POST['nome'];
    $mensagem = $_POST['mensagem'];

    if (!empty($nome) && !empty($mensagem)) {
        $stmt = $conn->prepare("INSERT INTO mensagens (nome, mensagem, data_envio) VALUES (?, ?, NOW())");
        $stmt->bind_param("ss", $nome, $mensagem);

        if ($stmt->execute()) {
            echo "<div class='alert alert-success'>Mensagem enviada com sucesso!</div>";
        } else {
            echo "<div class='alert alert-danger'>Erro ao enviar mensagem: " . $conn->error . "</div>";
        }
    } else {
        echo "<div class='alert alert-warning'>Por favor, preencha todos os campos.</div>";
    }
}
?>

<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Enviar Mensagem</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            background-color: #121212;
            color: #fff;
        }
        .container {
            max-width: 600px;
            margin-top: 50px;
        }
        .card {
            background-color: #333;
            border: none;
            box-shadow: 0 0 15px rgba(0, 0, 0, 0.2);
        }
        .card-header {
            background-color: #444;
            color: #ffc107;
        }
        .form-label {
            color: #ffc107;
        }
        .btn-primary {
            background-color: #ffc107;
            border-color: #ffc107;
        }
        .btn-primary:hover {
            background-color: #e0a800;
            border-color: #e0a800;
        }
        .message-container {
            background-color: #444;
            padding: 20px;
            border-radius: 10px;
            margin-bottom: 30px;
        }
        .message-container h4 {
            color: #fff;
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="card">
            <div class="card-header text-center">
                <h4>Enviar Mensagem</h4>
            </div>
            <div class="card-body">
                <form method="POST" action="">
                    <div class="mb-3">
                        <label for="nome" class="form-label">Nome:</label>
                        <input type="text" id="nome" name="nome" class="form-control" required>
                    </div>
                    <div class="mb-3">
                        <label for="mensagem" class="form-label">Mensagem:</label>
                        <textarea id="mensagem" name="mensagem" class="form-control" rows="4" required></textarea>
                    </div>
                    <button type="submit" class="btn btn-primary w-100">Enviar</button>
                </form>
            </div>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
