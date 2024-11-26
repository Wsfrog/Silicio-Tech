<?php
// Conexão com o banco de dados
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "etech";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Erro de conexão: " . $conn->connect_error);
}

// Mensagem de status
$mensagem = "";

// Exclusão de registros
if (isset($_GET['delete'])) {
    $id = $_GET['delete'];
    $table = $_GET['table'];

    if (in_array($table, ['visitantes', 'encomendas'])) {
        $conn->query("DELETE FROM $table WHERE id = $id");
        $mensagem = "Registro excluído com sucesso!";
    }
}

// Salvar (inserção/atualização)
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $table = $_POST['table'];

    if ($table === 'visitantes') {
        $id = $_POST['id'] ?? null;
        $nome = $_POST['nome'];
        $documento = $_POST['documento'];
        $veiculo = $_POST['veiculo'];
        $placa = $_POST['placa'];
        $telefone = $_POST['telefone'];
        $data_entrada = $_POST['data_entrada'];

        if ($id) {
            $conn->query("UPDATE visitantes SET nome='$nome', documento='$documento', veiculo='$veiculo', placa='$placa', telefone='$telefone', data_entrada='$data_entrada' WHERE id=$id");
        } else {
            $conn->query("INSERT INTO visitantes (nome, documento, veiculo, placa, telefone, data_entrada) VALUES ('$nome', '$documento', '$veiculo', '$placa', '$telefone', '$data_entrada')");
        }
        $mensagem = "Dados do visitante salvos com sucesso!";
    } elseif ($table === 'encomendas') {
        $id = $_POST['id'] ?? null;
        $morador_id = $_POST['morador_id'];
        $descricao = $_POST['descricao'];
        $status = $_POST['status'];
        $data_recebimento = $_POST['data_recebimento'];

        if ($id) {
            $conn->query("UPDATE encomendas SET morador_id=$morador_id, descricao='$descricao', status='$status', data_recebimento='$data_recebimento' WHERE id=$id");
        } else {
            $conn->query("INSERT INTO encomendas (morador_id, descricao, status, data_recebimento) VALUES ($morador_id, '$descricao', '$status', '$data_recebimento')");
        }
        $mensagem = "Dados da encomenda salvos com sucesso!";
    }
}

// Preencher os dados ao editar
$edit_data = [];
if (isset($_GET['edit'])) {
    $id = $_GET['edit'];
    $table = $_GET['table'];
    if ($table == 'visitantes') {
        $result = $conn->query("SELECT * FROM visitantes WHERE id=$id");
        $edit_data = $result->fetch_assoc();
    } elseif ($table == 'encomendas') {
        $result = $conn->query("SELECT * FROM encomendas WHERE id=$id");
        $edit_data = $result->fetch_assoc();
    }
}
?>

<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>CRUD Visitantes e Encomendas</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #222;
            color: #fff;
            margin: 0;
            padding: 0;
        }
        .container {
            max-width: 1200px;
            margin: 20px auto;
            padding: 20px;
            background: rgba(0, 0, 0, 0.8);
            border-radius: 10px;
        }
        h1, h2 {
            color: #FFD700;
            text-align: center;
        }
        table {
            width: 100%;
            border-collapse: collapse;
            margin: 20px 0;
        }
        th, td {
            padding: 10px;
            text-align: left;
            border: 1px solid #444;
        }
        th {
            background-color: #FFD700;
        }
        .btn {
            padding: 8px 12px;
            border-radius: 5px;
            color: #000;
            background-color: #FFD700;
            text-decoration: none;
            margin-right: 10px;
            transition: background-color 0.3s ease, transform 0.2s ease;
        }
        .btn:hover {
            background-color: #FFA500;
            transform: scale(1.1);
        }
        form {
            margin-top: 20px;
        }
        label {
            display: block;
            margin: 10px 0 5px;
        }
        input, select {
            width: 100%;
            padding: 10px;
            border-radius: 5px;
            border: 1px solid #ccc;
        }
        button[type="submit"] {
            padding: 10px 15px;
            background-color: #FFD700;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            color: #000;
            font-weight: bold;
        }
        button[type="submit"]:hover {
            background-color: #FFA500;
        }
        .message {
            color: #FFD700;
            margin: 20px 0;
        }
        .fixed-btn {
    position: fixed;
    left: 20px;
    bottom: 20px;
    padding: 20px 40px; /* Aumentando o tamanho do botão */
    background-color: #FFD700; /* Cor amarela */
    color: #000; /* Cor do texto preta */
    border: none;
    border-radius: 10px; /* Cantos arredondados */
    font-size: 20px; /* Aumentando o tamanho da fonte */
    font-weight: bold; /* Deixando o texto em negrito */
    cursor: pointer;
    transition: background-color 0.3s ease;
}

.fixed-btn:hover {
    background-color: #ffcc00; /* Cor de fundo ao passar o mouse */
}
    </style>
</head>
<body>
    <div class="container">
        <h1>Gestão de Visitantes e Encomendas</h1>
        <p class="message"><?= $mensagem ?></p>

        <h2>Visitantes</h2>
        <form method="POST">
            <input type="hidden" name="table" value="visitantes">
            <input type="hidden" name="id" value="<?= $edit_data['id'] ?? '' ?>">
            <label for="nome">Nome:</label>
            <input type="text" name="nome" value="<?= $edit_data['nome'] ?? '' ?>" required>
            <label for="documento">Documento:</label>
            <input type="text" name="documento" value="<?= $edit_data['documento'] ?? '' ?>" required>
            <label for="veiculo">Veículo:</label>
            <input type="text" name="veiculo" value="<?= $edit_data['veiculo'] ?? '' ?>">
            <label for="placa">Placa:</label>
            <input type="text" name="placa" value="<?= $edit_data['placa'] ?? '' ?>">
            <label for="telefone">Telefone:</label>
            <input type="text" name="telefone" value="<?= $edit_data['telefone'] ?? '' ?>" required>
            <label for="data_entrada">Data de Entrada:</label>
            <input type="date" name="data_entrada" value="<?= $edit_data['data_entrada'] ?? '' ?>" required>
            <button type="submit">Salvar Visitante</button>
        </form>

        <h2>Encomendas</h2>
        <form method="POST">
            <input type="hidden" name="table" value="encomendas">
            <input type="hidden" name="id" value="<?= $edit_data['id'] ?? '' ?>">
            <label for="morador_id">Morador:</label>
            <select name="morador_id">
                <?php
                $moradores = $conn->query("SELECT id, nome FROM moradores");
                while ($morador = $moradores->fetch_assoc()) {
                    echo "<option value='{$morador['id']}' " . (($edit_data['morador_id'] ?? '') == $morador['id'] ? 'selected' : '') . ">{$morador['nome']}</option>";
                }
                ?>
            </select>
            <label for="descricao">Descrição:</label>
            <input type="text" name="descricao" value="<?= $edit_data['descricao'] ?? '' ?>" required>
            <label for="status">Status:</label>
            <select name="status">
                <option value="Pendente" <?= ($edit_data['status'] ?? '') == 'Pendente' ? 'selected' : '' ?>>Pendente</option>
                <option value="Entregue" <?= ($edit_data['status'] ?? '') == 'Entregue' ? 'selected' : '' ?>>Entregue</option>
            </select>
            <label for="data_recebimento">Data de Recebimento:</label>
            <input type="date" name="data_recebimento" value="<?= $edit_data['data_recebimento'] ?? '' ?>">
            <button type="submit">Salvar Encomenda</button>
        </form>

        <h2>Lista de Visitantes</h2>
        <table>
            <tr>
                <th>Nome</th>
                <th>Documento</th>
                <th>Veículo</th>
                <th>Ações</th>
            </tr>
            <?php
            $result = $conn->query("SELECT * FROM visitantes");
            while ($row = $result->fetch_assoc()) {
                echo "<tr>
                    <td>{$row['nome']}</td>
                    <td>{$row['documento']}</td>
                    <td>{$row['veiculo']}</td>
                    <td>
                        <a href='?edit={$row['id']}&table=visitantes' class='btn'>Editar</a>
                        <a href='?delete={$row['id']}&table=visitantes' class='btn'>Excluir</a>
                    </td>
                </tr>";
            }
            ?>
        </table>

        <h2>Lista de Encomendas</h2>
        <table>
            <tr>
                <th>Descrição</th>
                <th>Morador</th>
                <th>Status</th>
                <th>Ações</th>
            </tr>
            <?php
            $result = $conn->query("SELECT encomendas.*, moradores.nome AS morador_nome FROM encomendas LEFT JOIN moradores ON encomendas.morador_id = moradores.id");
            while ($row = $result->fetch_assoc()) {
                echo "<tr>
                    <td>{$row['descricao']}</td>
                    <td>{$row['morador_nome']}</td>
                    <td>{$row['status']}</td>
                    <td>
                        <a href='?edit={$row['id']}&table=encomendas' class='btn'>Editar</a>
                        <a href='?delete={$row['id']}&table=encomendas' class='btn'>Excluir</a>
                    </td>
                </tr>";
            }
            ?>
        </table>
    </div>
    <button class="fixed-btn" onclick="window.location.href='index.php'">Voltar</button>

</body>
</html>
