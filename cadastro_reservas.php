<?php
// db.php (conexão PDO)
$host = 'localhost';
$dbname = 'etech';
$user = 'root';
$password = '';

try {
    $pdo = new PDO("mysql:host=$host;dbname=$dbname;charset=utf8", $user, $password);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    die("Erro na conexão: " . $e->getMessage());
}

// Função para buscar moradores
function getMoradores($pdo) {
    $sql = "SELECT id, nome FROM moradores";
    $stmt = $pdo->prepare($sql);
    $stmt->execute();
    return $stmt->fetchAll(PDO::FETCH_ASSOC);
}

// Variáveis de controle
$reserva_id = null;

// Processar formulário
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $area = $_POST["area"];
    $data = $_POST["data"];
    $horario_inicio = $_POST["horario_inicio"];
    $horario_fim = $_POST["horario_fim"];
    $morador_id = $_POST["morador_id"];

    if (!isset($_GET['edit_reserva_id'])) {
        $sql = "SELECT * FROM reservas WHERE area = :area AND data = :data";
        $stmt = $pdo->prepare($sql);
        $stmt->execute(['area' => $area, 'data' => $data]);

        if ($stmt->rowCount() > 0) {
            echo "<script>alert('A área já possui uma reserva para esta data. Escolha outra data.'); history.back();</script>";
        } elseif ($data === date("Y-m-d")) {
            echo "<script>alert('Não é permitido cadastrar uma reserva para o mesmo dia.'); history.back();</script>";
        } else {
            $sql = "INSERT INTO reservas (area, data, horario_inicio, horario_fim, morador_id) 
                    VALUES (:area, :data, :horario_inicio, :horario_fim, :morador_id)";
            $stmt = $pdo->prepare($sql);
            if ($stmt->execute(['area' => $area, 'data' => $data, 'horario_inicio' => $horario_inicio, 'horario_fim' => $horario_fim, 'morador_id' => $morador_id])) {
                echo "<script>alert('Reserva cadastrada com sucesso!');</script>";
            } else {
                echo "<script>alert('Erro ao cadastrar a reserva.');</script>";
            }
        }
    } elseif (isset($_GET['edit_reserva_id'])) {
        $reserva_id = $_GET['edit_reserva_id'];
        $sql = "UPDATE reservas SET area = :area, data = :data, horario_inicio = :horario_inicio, 
                horario_fim = :horario_fim, morador_id = :morador_id WHERE id = :id";
        $stmt = $pdo->prepare($sql);
        if ($stmt->execute([
            'area' => $area,
            'data' => $data,
            'horario_inicio' => $horario_inicio,
            'horario_fim' => $horario_fim,
            'morador_id' => $morador_id,
            'id' => $reserva_id
        ])) {
            echo "<script>alert('Reserva atualizada com sucesso!'); window.location = '?';</script>";
        } else {
            echo "<script>alert('Erro ao atualizar a reserva.');</script>";
        }
    }
}

// Excluir reserva
if (isset($_GET['delete_reserva_id'])) {
    $delete_reserva_id = $_GET['delete_reserva_id'];
    $sql = "DELETE FROM reservas WHERE id = :id";
    $stmt = $pdo->prepare($sql);
    if ($stmt->execute(['id' => $delete_reserva_id])) {
        echo "<script>alert('Reserva excluída com sucesso!'); window.location = '?';</script>";
    } else {
        echo "<script>alert('Erro ao excluir a reserva.');</script>";
    }
}

// Buscar todas as reservas
$sql = "SELECT r.*, m.nome AS morador_nome FROM reservas r
        JOIN moradores m ON r.morador_id = m.id";
$reservas = $pdo->query($sql)->fetchAll(PDO::FETCH_ASSOC);
?>

<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="../pagina-principal/Administrador/css/StyleReserva.css">
    <title>CRUD de Reserva</title>
</head>
<body>
    <!-- Formulário de Cadastro de Reserva -->
    <div class="form-container">
        <h1>Cadastro de Reserva</h1>
        <form method="POST">
            <label for="area">Escolha a área:</label>
            <select id="area" name="area" required>
                <option value="" disabled selected>Selecione...</option>
                <option value="churrasqueira">Churrasqueira</option>
                <option value="salao_festas">Salão de Festas</option>
                <option value="piscina">Piscina</option>
            </select>

            <label for="data">Data:</label>
            <input type="date" id="data" name="data" required>

            <label for="horario_inicio">Horário Início:</label>
            <input type="time" id="horario_inicio" name="horario_inicio" required>

            <label for="horario_fim">Horário Fim:</label>
            <input type="time" id="horario_fim" name="horario_fim" required>

            <label for="morador_id">Morador:</label>
            <select id="morador_id" name="morador_id" required>
                <option value="" disabled selected>Selecione um morador...</option>
                <?php foreach (getMoradores($pdo) as $morador): ?>
                    <option value="<?= $morador['id'] ?>"><?= $morador['nome'] ?></option>
                <?php endforeach; ?>
            </select>

            <input type="submit" class="btn btn-warning" 
                   value="<?= isset($_GET['edit_reserva_id']) ? 'Atualizar Reserva' : 'Cadastrar Reserva' ?>">
        </form>
    </div>

    <!-- Listagem de Reservas -->
    <div class="reservas-list">
        <h2>Reservas Cadastradas</h2>
        <table class="table table-dark table-striped">
            <thead>
                <tr>
                    <th>Área</th>
                    <th>Data</th>
                    <th>Horário Início</th>
                    <th>Horário Fim</th>
                    <th>Morador</th>
                    <th>Ações</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($reservas as $reserva): ?>
                    <tr>
                        <td><?= htmlspecialchars($reserva['area']) ?></td>
                        <td><?= htmlspecialchars($reserva['data']) ?></td>
                        <td><?= htmlspecialchars($reserva['horario_inicio']) ?></td>
                        <td><?= htmlspecialchars($reserva['horario_fim']) ?></td>
                        <td><?= htmlspecialchars($reserva['morador_nome']) ?></td>
                        <td class="actions">
                            <a href="?edit_reserva_id=<?= $reserva['id'] ?>" class="btn btn-sm btn-primary">Editar</a>
                            <a href="?delete_reserva_id=<?= $reserva['id'] ?>" class="btn btn-sm btn-danger" onclick="return confirm('Tem certeza que deseja excluir?')">Excluir</a>
                        </td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>

    <div class="text-center">
        <a href="../index.php"><button class="btn btn-warning">Cancelar</button></a>
    </div>
</body>
</html>
