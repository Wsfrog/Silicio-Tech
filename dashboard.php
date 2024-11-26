<?php
// Conexão com o banco de dados
$conn = new mysqli('localhost', 'root', '', 'etech');

if ($conn->connect_error) {
    die("Erro de conexão: " . $conn->connect_error);
}

// Consulta para obter tarefas do banco de dados
$sql = "SELECT id, descricao, status FROM tarefas WHERE id_funcionario = 1"; 
$result = $conn->query($sql);

// Inicializa o array de tarefas
$tarefas = [];

if ($result && $result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $tarefas[] = $row;
    }
}

// Verificar e atualizar o status das tarefas
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_POST['status']) && is_array($_POST['status'])) {
        foreach ($_POST['status'] as $id => $status) {
            if (isset($_POST['horario'][$id])) {
                $horario = $_POST['horario'][$id];
                $id = intval($id); // Garante que o ID seja um número inteiro
                $status = htmlspecialchars($status); // Protege contra XSS
                $stmt = $conn->prepare("UPDATE tarefas SET status = ?, horario = ? WHERE id = ?");
                $stmt->bind_param("ssi", $status, $horario, $id);
                $stmt->execute();
            }
        }
        header("Location: dashboard.php");
        exit;
    }
}

// Consulta para listar todas as tarefas armazenadas no banco
$sql_todas_tarefas = "SELECT * FROM tarefas";
$todas_tarefas_result = $conn->query($sql_todas_tarefas);

$todas_tarefas = [];
if ($todas_tarefas_result && $todas_tarefas_result->num_rows > 0) {
    while ($row = $todas_tarefas_result->fetch_assoc()) {
        $todas_tarefas[] = $row;
    }
}
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <title>Painel do Funcionário</title>
    <!-- Link para o Bootstrap (carregar primeiro) -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 20px;
            background-color: #121212;
            color: #f1f1f1;
        }

        .task-card {
            background-color: #1e1e1e;
            border-radius: 10px;
            box-shadow: 0 6px 20px rgba(0, 0, 0, 0.15);
            padding: 20px;
            margin-bottom: 20px;
            transition: transform 0.3s ease;
        }

        .task-card:hover {
            transform: translateY(-10px);
        }

        .task-card-header {
            font-size: 1.3em;
            font-weight: bold;
            color: #ffeb3b;
        }

        .task-item {
            margin-bottom: 10px;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        .task-item input[type="checkbox"] {
            margin-right: 10px;
        }

        .task-time {
            width: 100px;
            margin-left: 10px;
        }

        /* Estilo para os botões lado a lado */
        .button-container {
            display: flex;
            justify-content: space-between;
            gap: 10px;
            margin-top: 20px;
        }

        .logout-button, .portaria-button {
            text-decoration: none;
            padding: 12px 18px;
            color: white;
            font-size: 1.2em;
            border-radius: 5px;
            transition: background-color 0.3s ease;
        }

        .logout-button {
            background-color: #e91e63;
        }

        .logout-button:hover {
            background-color: #d81b60;
        }

        .portaria-button {
            background-color: #ffeb3b;
            color: black;
        }

        .portaria-button:hover {
            background-color: #fbc02d;
        }

        .portaria-icon {
            width: 20px;
            height: 20px;
            margin-right: 10px;
            vertical-align: middle;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
            color: #f1f1f1;
        }

        table, th, td {
            border: 1px solid #333;
        }

        th, td {
            padding: 12px;
            text-align: left;
        }

        th {
            background-color: #333;
            font-weight: bold;
        }

        .task-list {
            margin-bottom: 20px;
        }

        .btn-custom {
            background-color: #ffeb3b;
            color: black;
        }

        .btn-custom:hover {
            background-color: #fbc02d;
            color: black;
        }

    </style>
</head>
<body>
    <div class="container">
        <h1 class="my-4 text-center text-warning">Bem-vindo ao Painel do Funcionário!</h1>

        <section>
            <h2 class="my-4 text-warning">Suas Tarefas de Hoje</h2>
            <form method="POST">
                <div class="task-list">
                    <?php if (!empty($tarefas)): ?>
                        <?php foreach ($tarefas as $tarefa): ?>
                            <div class="task-card">
                                <div class="task-card-header">
                                    <?php echo htmlspecialchars($tarefa['descricao']); ?>
                                </div>
                                <div class="task-item">
                                    <input 
                                        type="checkbox" 
                                        name="status[<?php echo $tarefa['id']; ?>]" 
                                        value="concluída"
                                        <?php echo $tarefa['status'] === 'concluída' ? 'checked' : ''; ?>
                                    >
                                    <label><?php echo htmlspecialchars($tarefa['descricao']); ?></label>
                                    <input type="time" name="horario[<?php echo $tarefa['id']; ?>]" class="task-time">
                                </div>
                            </div>
                        <?php endforeach; ?>
                    <?php else: ?>
                        <p class="text-muted">Nenhuma tarefa para exibir.</p>
                    <?php endif; ?>
                </div>
                <button type="submit" class="btn btn-custom">Atualizar Tarefas</button>
            </form>
        </section>

        <!-- Botões lado a lado -->
        <div class="button-container">
            <a href="./logout.php" class="logout-button">
                <i class="bi bi-box-arrow-right"></i> Sair
            </a>
            <a href="../sistema de portaria/index.php" class="portaria-button">
                <img src="./img/Radiohead.png" alt="Sistema de Portaria" class="portaria-icon">
                Sistema de Portaria
            </a>
        </div>

        <section>
            <h2 class="my-4 text-warning">Todas as Tarefas</h2>
            <table>
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Descrição</th>
                        <th>Status</th>
                        <th>Horário</th>
                    </tr>
                </thead>
                <tbody>
                    <?php if (!empty($todas_tarefas)): ?>
                        <?php foreach ($todas_tarefas as $tarefa): ?>
                            <tr>
                                <td><?php echo $tarefa['id']; ?></td>
                                <td><?php echo htmlspecialchars($tarefa['descricao']); ?></td>
                                <td><?php echo htmlspecialchars($tarefa['status']); ?></td>
                                <td><?php echo isset($tarefa['horario']) ? htmlspecialchars($tarefa['horario']) : '-'; ?></td>
                            </tr>
                        <?php endforeach; ?>
                    <?php else: ?>
                        <tr>
                            <td colspan="4">Nenhuma tarefa cadastrada.</td>
                        </tr>
                    <?php endif; ?>
                </tbody>
            </table>
        </section>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
