<?php
// Conexão com o banco de dados
$servername = "localhost";
$username = "root"; // Altere conforme necessário
$password = ""; // Altere conforme necessário
$dbname = "etech"; // Altere conforme necessário

$conn = new mysqli($servername, $username, $password, $dbname);

// Verifica a conexão
if ($conn->connect_error) {
    die("Conexão falhou: " . $conn->connect_error);
}


// Função para inserir novo visitante
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['addVisitante'])) {
    $nome = $_POST['nome'];
    $documento = $_POST['documento'];
    $veiculo = $_POST['veiculo'];
    $placa = $_POST['placa'];
    $telefone = $_POST['telefone'];
    $data_entrada = date('Y-m-d H:i:s');
    
    $sql = "INSERT INTO visitantes (nome, documento, veiculo, placa, telefone, data_entrada) 
            VALUES (?, ?, ?, ?, ?, ?)";
    
    if ($stmt = $conn->prepare($sql)) {
        $stmt->bind_param("ssssss", $nome, $documento, $veiculo, $placa, $telefone, $data_entrada);
        if ($stmt->execute()) {
            echo "<div class='alert alert-success'>Visitante adicionado com sucesso!</div>";
        } else {
            echo "<div class='alert alert-danger'>Erro ao adicionar visitante.</div>";
        }
        $stmt->close();
    }
}

// Função para listar os visitantes
$sqlVisitantes = "SELECT * FROM visitantes";
$resultVisitantes = $conn->query($sqlVisitantes);

// Consultar as encomendas
$sqlEncomendas = "SELECT e.id, m.nome, e.descricao, e.data_recebimento, e.status FROM encomendas e
                  JOIN moradores m ON e.morador_id = m.id";
$resultEncomendas = $conn->query($sqlEncomendas);

// Consultar as tarefas
$sqlTarefas = "SELECT t.id, f.nome, t.descricao, t.status, t.data FROM tarefas t
               JOIN funcionarios f ON t.id_funcionario = f.id";
$resultTarefas = $conn->query($sqlTarefas);

// Consultar feedbacks
$sqlFeedbacks = "SELECT f.id, m.nome, f.mensagem, f.data_envio FROM feedbacks f
                 JOIN moradores m ON f.morador_id = m.id";
$resultFeedbacks = $conn->query($sqlFeedbacks);

// Consultar ingressos
$sqlIngressos = "SELECT * FROM ingresso";
$resultIngressos = $conn->query($sqlIngressos);
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gerenciar Registros - Controle de Portaria</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <div class="container mt-5">
        <h1>Gerenciar Registros</h1>
        
        <!-- Formulário para Adicionar Visitante -->
        <div class="card p-4 mb-4">
            <h3>Adicionar Visitante</h3>
            <form method="POST" action="gerenciar.php">
                <input type="hidden" name="addVisitante" value="1">
                <div class="mb-3">
                    <label for="nome" class="form-label">Nome</label>
                    <input type="text" class="form-control" id="nome" name="nome" required>
                </div>
                <div class="mb-3">
                    <label for="documento" class="form-label">Documento (CPF)</label>
                    <input type="text" class="form-control" id="documento" name="documento" required>
                </div>
                <div class="mb-3">
                    <label for="veiculo" class="form-label">Veículo</label>
                    <input type="text" class="form-control" id="veiculo" name="veiculo">
                </div>
                <div class="mb-3">
                    <label for="placa" class="form-label">Placa</label>
                    <input type="text" class="form-control" id="placa" name="placa">
                </div>
                <div class="mb-3">
                    <label for="telefone" class="form-label">Telefone</label>
                    <input type="text" class="form-control" id="telefone" name="telefone" required>
                </div>
                <button type="submit" class="btn btn-success">Salvar</button>
            </form>
        </div>

        <!-- Tabela de Visitantes -->
        <h3>Visitantes Cadastrados</h3>
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Nome</th>
                    <th>Documento</th>
                    <th>Veículo</th>
                    <th>Placa</th>
                    <th>Telefone</th>
                    <th>Data de Entrada</th>
                </tr>
            </thead>
            <tbody>
                <?php
                if ($resultVisitantes->num_rows > 0) {
                    while ($row = $resultVisitantes->fetch_assoc()) {
                        echo "<tr>
                            <td>{$row['id']}</td>
                            <td>{$row['nome']}</td>
                            <td>{$row['documento']}</td>
                            <td>{$row['veiculo']}</td>
                            <td>{$row['placa']}</td>
                            <td>{$row['telefone']}</td>
                            <td>{$row['data_entrada']}</td>
                        </tr>";
                    }
                } else {
                    echo "<tr><td colspan='7' class='text-center'>Nenhum visitante registrado.</td></tr>";
                }
                ?>
            </tbody>
        </table>

        <!-- Tabela de Encomendas -->
        <h3>Encomendas</h3>
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Morador</th>
                    <th>Descrição</th>
                    <th>Data de Recebimento</th>
                    <th>Status</th>
                </tr>
            </thead>
            <tbody>
                <?php
                if ($resultEncomendas->num_rows > 0) {
                    while ($row = $resultEncomendas->fetch_assoc()) {
                        echo "<tr>
                            <td>{$row['id']}</td>
                            <td>{$row['nome']}</td>
                            <td>{$row['descricao']}</td>
                            <td>{$row['data_recebimento']}</td>
                            <td>{$row['status']}</td>
                        </tr>";
                    }
                } else {
                    echo "<tr><td colspan='5' class='text-center'>Nenhuma encomenda registrada.</td></tr>";
                }
                ?>
            </tbody>
        </table>

        <!-- Tabela de Tarefas -->
        <h3>Tarefas de Funcionários</h3>
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Funcionário</th>
                    <th>Descrição</th>
                    <th>Status</th>
                    <th>Data</th>
                </tr>
            </thead>
            <tbody>
                <?php
                if ($resultTarefas->num_rows > 0) {
                    while ($row = $resultTarefas->fetch_assoc()) {
                        echo "<tr>
                            <td>{$row['id']}</td>
                            <td>{$row['nome']}</td>
                            <td>{$row['descricao']}</td>
                            <td>{$row['status']}</td>
                            <td>{$row['data']}</td>
                        </tr>";
                    }
                } else {
                    echo "<tr><td colspan='5' class='text-center'>Nenhuma tarefa registrada.</td></tr>";
                }
                ?>
            </tbody>
        </table>


                <!-- Tabela de Registros -->
                <div class="card p-4 mt-4">
            <h2>Lista de Registros</h2>
            <table class="table table-bordered">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Tipo</th>
                        <th>Nome</th>
                        <th>Veículo</th>
                        <th>Placa</th>
                        <th>CPF</th>
                        <th>Telefone</th>
                        <th>Ações</th>
                    </tr>
                </thead>
                <tbody>
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

                    // Consulta para recuperar moradores
                    $sql = "SELECT * FROM moradores"; // Tabela de moradores
                    $result = $conn->query($sql);

                    if ($result->num_rows > 0) {
                        // Laço para exibir todos os moradores
                        while ($row = $result->fetch_assoc()) {
                            echo "<tr>
                <td>{$row['id']}</td>
                <td>{$row['nome']}</td>
                <td>{$row['apartamento']}</td>
                <td>{$row['email']}</td>
                <td>{$row['telefone']}</td>
                                    <td>
                                        <a href='editar.php?id={$row['id']}' class='btn btn-warning btn-sm'>Editar</a>
                                        <a href='deletar.php?id={$row['id']}' onclick='return confirm(\"Tem certeza que deseja excluir este registro?\");' class='btn btn-danger btn-sm'>Deletar</a>
                                    </td>
            </tr>";
                        }
                    } else {
                        echo "<tr><td colspan='6' class='text-center'>Nenhum registro encontrado.</td></tr>";
                    }

                    // Fecha a conexão
                    $conn->close();
                    ?>


                </tbody>
            </table>
        </div>

        <!-- Tabela de Feedbacks -->
        <h3>Feedbacks dos Moradores</h3>
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Morador</th>
                    <th>Mensagem</th>
                    <th>Data de Envio</th>
                </tr>
            </thead>
            <tbody>
                <?php
                if ($resultFeedbacks->num_rows > 0) {
                    while ($row = $resultFeedbacks->fetch_assoc()) {
                        echo "<tr>
                            <td>{$row['id']}</td>
                            <td>{$row['nome']}</td>
                            <td>{$row['mensagem']}</td>
                            <td>{$row['data_envio']}</td>
                        </tr>";
                    }
                } else {
                    echo "<tr><td colspan='4' class='text-center'>Nenhum feedback registrado.</td></tr>";
                }
                ?>
            </tbody>
        </table>

        <!-- Tabela de Ingressos -->
        <h3>Produtos ainda Disponíveis</h3>
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Nome dos Produtos</th>
                    <th>Quantidade Disponível</th>
                    <th>Preço</th>
                </tr>
            </thead>
            <tbody>
                <?php
                if ($resultIngressos->num_rows > 0) {
                    while ($row = $resultIngressos->fetch_assoc()) {
                        echo "<tr>
                            <td>{$row['idIngresso']}</td>
                            <td>{$row['nomeEvento']}</td>
                            <td>{$row['quantidadeDisponivel']}</td>
                            <td>{$row['preco']}</td>
                        </tr>";
                    }
                } else {
                    echo "<tr><td colspan='4' class='text-center'>Nenhum ingresso disponível.</td></tr>";
                }
                ?>
            </tbody>
        </table>

    </div>

    <!-- Bootstrap JS (opcional) -->
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.3/dist/umd/popper.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.min.js"></script>
</body>
</html>

<?php
function closeConnection($mysqli) {
    if ($mysqli && !$mysqli->connect_errno) {
        $mysqli->close();
    }
}


?>
