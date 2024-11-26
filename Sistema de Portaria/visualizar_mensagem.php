<?php
// Conexão com o banco de dados
$host = 'localhost';
$user = 'root';
$password = '';
$dbname = 'etech';

$conn = new mysqli($host, $user, $password, $dbname);

if ($conn->connect_error) {
    die("Conexão falhou: " . $conn->connect_error);
}

// Deletar mensagem, se solicitado
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['delete_id'])) {
    $delete_id = intval($_POST['delete_id']);
    $sql_delete = "DELETE FROM mensagens WHERE id = $delete_id";
    if ($conn->query($sql_delete) === TRUE) {
        echo "<script>alert('Mensagem deletada com sucesso!');</script>";
    } else {
        echo "<script>alert('Erro ao deletar mensagem: " . $conn->error . "');</script>";
    }
}

// Consulta para exibir mensagens
$sql = "SELECT id, nome, mensagem, data_envio, resposta FROM mensagens ORDER BY data_envio DESC";
$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Mensagens Enviadas</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            background-color: #121212;
            color: #fff;
            font-family: 'Arial', sans-serif;
        }
        .container {
            max-width: 900px;
            margin-top: 50px;
        }
        .card {
            background-color: #222;
            border: none;
            border-radius: 10px;
            box-shadow: 0 0 20px rgba(0, 0, 0, 0.3);
        }
        .card-header {
            background-color: #333;
            color: #ffc107;
            font-size: 1.5rem;
            border-bottom: 2px solid #444;
            padding: 20px;
        }
        .message-container {
            background-color: #2b2b2b;
            padding: 25px;
            border-radius: 10px;
            margin-bottom: 20px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.3);
            transition: background-color 0.3s ease, transform 0.3s ease;
        }
        .message-container:hover {
            background-color: #444;
            transform: translateY(-5px);
        }
        .message-container h5 {
            color: #ffc107;
            font-weight: bold;
            font-size: 1.2rem;
        }
        .message-container p {
            color: #ccc;
            font-size: 1rem;
            line-height: 1.5;
        }
        .message-footer {
            font-size: 0.9rem;
            color: #bbb;
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-top: 15px;
        }
        .btn-primary {
            background-color: #ffc107;
            border-color: #ffc107;
            font-weight: bold;
        }
        .btn-primary:hover {
            background-color: #e0a800;
            border-color: #e0a800;
        }
        .btn-danger {
            background-color: #dc3545;
            border-color: #dc3545;
            font-weight: bold;
        }
        .btn-danger:hover {
            background-color: #c82333;
            border-color: #bd2130;
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="card">
            <div class="card-header text-center">
                <h4>Mensagens Enviadas pelos Moradores</h4>
            </div>
            <div class="card-body">
                <?php
                if ($result->num_rows > 0) {
                    while ($row = $result->fetch_assoc()) {
                        echo "<div class='message-container'>";
                        echo "<h5>" . htmlspecialchars($row['nome']) . "</h5>";
                        echo "<p>" . nl2br(htmlspecialchars($row['mensagem'])) . "</p>";
                        if (!empty($row['resposta'])) {
                            echo "<div class='alert alert-success mt-3'>Resposta: " . nl2br(htmlspecialchars($row['resposta'])) . "</div>";
                        }
                        echo "<div class='message-footer'>";
                        echo "<span><i class='bi bi-calendar'></i> " . $row['data_envio'] . "</span>";
                        echo "<form method='POST' style='display:inline;'>
                                <input type='hidden' name='delete_id' value='" . $row['id'] . "'>
                                <button type='submit' class='btn btn-danger btn-sm'>Deletar</button>
                              </form>";
                        echo "</div>";
                        echo "</div>";
                    }
                } else {
                    echo "<div class='alert alert-warning'>Não há mensagens para mostrar.</div>";
                }

                $conn->close();
                ?>
                <div class="text-center mt-4">
    <a href="index.php" class="btn btn-primary">Voltar ao Início</a>
</div>

            </div>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
