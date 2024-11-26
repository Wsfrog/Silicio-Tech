<?php
include 'db.php';

// Consulta com JOIN para buscar o nome do morador
$sql = "SELECT encomendas.id, encomendas.descricao, encomendas.data_recebimento, encomendas.status, moradores.nome 
        FROM encomendas 
        JOIN moradores ON encomendas.morador_id = moradores.id";
$resultado = $conn->query($sql);
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Consulta de Encomendas</title>
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;700&family=Open+Sans:wght@400;600&display=swap" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            font-family: 'Open Sans', sans-serif;
            background-color: #1a1a1a;
            color: #f7f7f7;
            margin: 0;
            padding: 0;
        }
        .container {
            margin-top: 80px;
        }
        h2 {
            text-align: center;
            color: #ffcc00;
            margin-bottom: 40px;
            font-size: 2.8rem;
            font-weight: 700;
            text-transform: uppercase;
        }
        table {
            background-color: rgba(0, 0, 0, 0.6);
            border-radius: 12px;
            overflow: hidden;
            width: 100%;
            box-shadow: 0 8px 20px rgba(0, 0, 0, 0.3);
            backdrop-filter: blur(15px);
            border: 1px solid #ffcc00;
        }
        th, td {
            text-align: center;
            padding: 25px;
            font-size: 1.2rem;
            font-family: 'Roboto', sans-serif;
        }
        th {
            background-color: #ffcc00;
            color: black;
            font-weight: 700;
            text-transform: uppercase;
            border-bottom: 2px solid #333;
        }
        td {
            background-color: #333;
            color: #f7f7f7;
            border-bottom: 1px solid #444;
        }
        tr:nth-child(even) td {
            background-color: #444;
        }
        tr:hover {
            background-color: #555;
        }
        .table-container {
            box-shadow: 0 8px 40px rgba(0, 0, 0, 0.5);
            border-radius: 15px;
            padding: 20px;
            backdrop-filter: blur(20px);
        }
        .table-bordered {
            border: 1px solid #ffcc00;
        }
        /* Animação de efeito ao carregar */
        @keyframes fadeIn {
            0% { opacity: 0; }
            100% { opacity: 1; }
        }
        .container {
            animation: fadeIn 1s ease-out;
        }
    </style>
</head>
<body>

<div class="container">
    <h2>Consulta de Encomendas</h2>
    <div class="table-container">
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Nome do Morador</th>
                    <th>Descrição</th>
                    <th>Data de Recebimento</th>
                    <th>Status</th>
                </tr>
            </thead>
            <tbody>
                <?php while ($linha = $resultado->fetch_assoc()) { ?>
                    <tr>
                        <td><?php echo $linha['id']; ?></td>
                        <td><?php echo $linha['nome']; ?></td>
                        <td><?php echo $linha['descricao']; ?></td>
                        <td><?php echo $linha['data_recebimento']; ?></td>
                        <td><?php echo $linha['status']; ?></td>
                    </tr>
                <?php } ?>
            </tbody>
        </table>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
