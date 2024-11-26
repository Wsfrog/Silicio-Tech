<?php
$servername = "localhost"; // ou o seu servidor de banco de dados
$username = "root"; // seu nome de usuário
$password = ""; // sua senha
$dbname = "etech"; // nome do banco de dados

// Criando a conexão
$conn = new mysqli($servername, $username, $password, $dbname);

// Verificando a conexão
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Lista de Moradores</title>
    <!-- Importando o Bootstrap -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
    <style>
        /* Efeito de vidraça (glass effect) */
        body {
            background-color: rgba(0, 0, 0, 0.5);
            background-image: url('https://source.unsplash.com/1920x1080/?glass'); /* Imagem de fundo opcional */
            background-size: cover;
            background-position: center;
            font-family: Arial, sans-serif;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            margin: 0;
        }

        .container {
            background: rgba(0, 0, 0, 0.7);
            color: #fff;
            padding: 30px;
            border-radius: 15px;
            box-shadow: 0 4px 20px rgba(0, 0, 0, 0.4);
            backdrop-filter: blur(10px);
            width: 100%;
            max-width: 960px; /* Limita a largura máxima */
        }

        h1 {
            text-align: center;
            font-size: 2.5rem;
            color: #f8c020; /* Amarelo */
            margin-bottom: 20px;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            background-color: #333;
            border-radius: 8px;
            overflow: hidden;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.3);
        }

        th {
            background-color: #f8c020; /* Amarelo */
            color: #333;
            padding: 12px;
            text-align: left;
        }

        td {
            padding: 12px;
            text-align: left;
            color: #fff;
            border-bottom: 1px solid #444;
        }

        tr:hover {
            background-color: #444;
        }

        a.btn-link {
            display: inline-block;
            padding: 10px 20px;
            background-color: #f8c020;
            color: #333;
            text-align: center;
            text-decoration: none;
            font-size: 16px;
            border-radius: 5px;
            transition: background-color 0.3s, transform 0.3s;
            margin-top: 20px; /* Adiciona uma margem entre a tabela e o botão */
        }

        a.btn-link:hover {
            background-color: #e1a10d;
            transform: scale(1.05);
        }

        a.btn-link:focus {
            outline: none;
            box-shadow: 0 0 0 2px rgba(248, 192, 32, 0.5);
        }

        a.btn-link:active {
            background-color: #e89e07;
        }
    </style>
</head>
<body>

    <div class="container">
        <h1>Lista dos Moradores do Condomínio</h1>

        <?php
        // Consulta SQL para pegar os moradores
        $sql = "SELECT * FROM moradores";
        $result = $conn->query($sql);

        // Exibindo a tabela HTML com os dados do banco
        echo "<table>";
        echo "<thead><tr><th>ID</th><th>Nome</th><th>Apartamento</th><th>Email</th><th>Telefone</th></tr></thead>";
        echo "<tbody>";

        if ($result->num_rows > 0) {
            // Exibe cada morador
            while($row = $result->fetch_assoc()) {
                echo "<tr>";
                echo "<td>" . $row['id'] . "</td>";
                echo "<td>" . $row['nome'] . "</td>";
                echo "<td>" . $row['apartamento'] . "</td>";
                echo "<td>" . $row['email'] . "</td>";
                echo "<td>" . $row['telefone'] . "</td>";
                echo "</tr>";
            }
        } else {
            echo "<tr><td colspan='5' style='text-align: center;'>Nenhum morador encontrado</td></tr>";
        }

        echo "</tbody>";
        echo "</table>";
        ?>

        <br>
        <a href="index.php" class="btn-link">Voltar</a>
    </div>

    <!-- Importando o Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>