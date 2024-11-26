<?php
include 'db.php';

$sql = "SELECT * FROM reservas";
$resultado = $conn->query($sql);
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Consulta de Reservas</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;600&display=swap" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/font-awesome/css/font-awesome.min.css" rel="stylesheet">
    <style>
        body {
            font-family: 'Poppins', sans-serif;
            background-color: #121212;
            color: #fff;
            margin: 0;
            padding: 0;
        }
        .container {
            margin-top: 50px;
        }
        h2 {
            text-align: center;
            color: #FFD700; /* Dourado */
            margin-bottom: 30px;
            font-size: 2rem;
        }
        .table-container {
            background: rgba(255, 255, 255, 0.1);
            backdrop-filter: blur(10px);
            border-radius: 15px;
            padding: 20px;
            box-shadow: 0 8px 20px rgba(0, 0, 0, 0.5);
        }
        table {
            width: 100%;
            border-collapse: collapse;
        }
        th, td {
            text-align: center;
            padding: 12px;
            font-size: 1rem;
        }
        th {
            background-color: #333;
            color: #FFD700;
            font-weight: 600;
        }
        td {
            background-color: #212121;
            border-bottom: 1px solid #444;
        }
        tr:hover td {
            background-color: #333;
        }
        .fa {
            color: #FFD700;
        }
        .table-container {
            border-radius: 10px;
        }
        .btn {
            background-color: #FFD700;
            color: black;
            font-weight: bold;
            border-radius: 5px;
            padding: 8px 16px;
        }
        .btn:hover {
            background-color: #e6c100;
        }
    </style>
</head>
<body>

<div class="container">
    <h2><i class="fa fa-calendar-check-o"></i> Consulta de Reservas</h2>

    <div class="table-container">
        <table class="table table-bordered table-dark">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Morador ID</th>
                    <th>Área</th>
                    <th>Data</th>
                    <th>Hora Início</th>
                    <th>Hora Fim</th>
                    <th>Status</th>
                </tr>
            </thead>
            <tbody>
                <?php while ($linha = $resultado->fetch_assoc()) { ?>
                    <tr>
                        <td><?php echo $linha['id']; ?></td>
                        <td><?php echo $linha['morador_id']; ?></td>
                        <td><?php echo $linha['area']; ?></td>
                        <td><?php echo $linha['data_reserva']; ?></td>
                        <td><?php echo $linha['hora_inicio']; ?></td>
                        <td><?php echo $linha['hora_fim']; ?></td>
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
