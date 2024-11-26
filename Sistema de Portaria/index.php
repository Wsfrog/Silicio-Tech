<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sistema de Controle de Portaria</title>
    <!-- Bootstrap 5 -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Font Awesome para ícones -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@400;700&display=swap" rel="stylesheet">
    <!-- Estilos Personalizados -->
    <style>
        body {
            font-family: 'Montserrat', sans-serif;
            background: #1a1a1a; /* Cor de fundo preta */
            color: #fff; /* Texto branco */
            margin: 0;
            height: 100vh;
        }
        .navbar {
            background: rgba(0, 0, 0, 0.7); /* Fundo escuro e translúcido */
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.2);
            position: sticky;
            top: 0;
            z-index: 9999;
        }

        .navbar-brand {
            font-weight: bold;
            color: #ffc107; /* Amarelo */
        }

        .navbar-brand:hover {
            color: #ffd754; /* Amarelo mais claro */
        }

        .navbar-text {
            color: #fff; /* Texto do usuário */
        }

        .sidebar {
            background: rgba(0, 0, 0, 0.7); /* Fundo escuro e translúcido */
            height: 100vh;
            position: fixed;
            top: 0;
            left: 0;
            padding-top: 60px;
            width: 250px;
            z-index: 1;
            box-shadow: 2px 0 5px rgba(0, 0, 0, 0.2);
        }

        .sidebar a {
            color: #fff; /* Cor do texto na sidebar */
            padding: 15px;
            text-align: left;
            display: block;
            text-decoration: none;
            font-size: 18px;
            transition: background-color 0.3s, padding 0.3s;
        }

        .sidebar a:hover {
            background-color: #495057;
            padding-left: 20px;
        }
        

        .content {
            margin-left: 270px; /* Ajuste para a largura da sidebar */
            padding: 20px;
            background: rgba(0, 0, 0, 0.4); /* Efeito vidro no conteúdo */
            border-radius: 10px;
            min-height: 100vh; /* Garante que o conteúdo ocupe toda a altura */
        }

        .card {
            background: rgba(0, 0, 0, 0.5); /* Efeito vidro nas cards */
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.2);
            border-radius: 10px;
            border: none;
            margin-bottom: 20px; /* Espaço entre as cards */
        }

        .btn-custom {
            background: linear-gradient(135deg, #ffc107, #ffdd57);
            border: none;
            color: #fff;
            font-weight: bold;
            border-radius: 50px;
            transition: background-color 0.3s, transform 0.2s;
        }

        .btn-custom:hover {
            background: linear-gradient(135deg, #ffcd39, #ffe066);
            transform: scale(1.05);
        }

        .form-control {
            border-radius: 10px;
            box-shadow: none;
        }

        .form-control:focus {
            box-shadow: 0 0 5px rgba(0, 123, 255, 0.5);
        }

        .form-label {
            font-weight: bold;
            color: #ffc107; /* Amarelo para labels */
        }

        .footer {
            text-align: center;
            margin-top: 20px;
            padding: 10px;
            background-color: #343a40;
            color: #fff;
            border-radius: 10px;
        }

        .logout-btn {
            background-color: #dc3545;
            border-radius: 50px;
            color: #fff;
        }

        .logout-btn:hover {
            background-color: #c82333;
        }
    </style>
</head>

<body>

    <!-- Navbar -->
    <nav class="navbar navbar-dark">
        <a class="navbar-brand" href="#">Silicio Tech</a>
        <span class="navbar-text">
            Bem-vindo, Funcionario
            <a href="../pagina-principal/Administrador/logout.php"><button class="btn logout-btn btn-sm" data-bs-toggle="modal" data-bs-target="#logoutModal">Logout</button></a>
        </span>
    </nav>

    <!-- Sidebar -->
    <div class="sidebar">
        <a href="../pagina-principal/dashboard.php"><i class="fas fa-home"></i> Início</a>
        <a href="ListadeMoradores.php"><i class="fas fa-users"></i> Moradores</a>
        <a href="visualizar_mensagem.php"><i class="fas fa-comment"></i> Feedback</a>
    </div>

    <!-- Content -->
    <div class="content">
        <h2>Área Principal</h2>
        
    <!-- Scripts -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>


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

    <div class="container mt-5">
        <h1>Sistema de Controle de Portaria</h1>
        
        <!-- Formulário para Adicionar Visitante -->
        <div class="card p-4 mb-4">
    <h3 style="color: white;">Adicionar Visitante</h3>
    <form method="POST" action="index.php">
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
        <button type="submit" class="btn btn-custom">Salvar</button>
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
            <th>Ações</th>
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
                    <td>
                        <a href='crud.php?action=editVisitante&id={$row['id']}' class='btn btn-warning btn-sm'>Editar</a>
                        <a href='crud.php?action=deleteVisitante&id={$row['id']}' onclick='return confirm(\"Tem certeza que deseja excluir este visitante?\");' class='btn btn-danger btn-sm'>Deletar</a>
                    </td>
                </tr>";
            }
        } else {
            echo "<tr><td colspan='8' class='text-center'>Nenhum visitante registrado.</td></tr>";
        }
        ?>
    </tbody>
</table>

        <!-- Tabela de Encomendas -->
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

// Consultar as encomendas com LEFT JOIN para incluir o nome do morador
$sqlEncomendas = "SELECT e.id, e.descricao, e.data_recebimento, e.status, m.nome AS morador_nome, e.morador_id
                  FROM encomendas e
                  LEFT JOIN moradores m ON e.morador_id = m.id";
$resultEncomendas = $conn->query($sqlEncomendas);
?>

<h3>Encomendas Cadastradas</h3>
<table class="table table-bordered">
    <thead>
        <tr>
            <th>ID</th>
            <th>Morador</th>
            <th>Descrição</th>
            <th>Data de Recebimento</th>
            <th>Status</th>
            <th>Ações</th>
        </tr>
    </thead>
    <tbody>
        <?php
        // Verificar se há encomendas registradas
        if ($resultEncomendas->num_rows > 0) {
            while ($row = $resultEncomendas->fetch_assoc()) {
                // Exibir as informações de cada encomenda
                echo "<tr>
                    <td>{$row['id']}</td>
                    <td>" . (!empty($row['morador_nome']) ? $row['morador_nome'] : "ID: {$row['morador_id']}") . "</td>
                    <td>{$row['descricao']}</td>
                    <td>" . date('d/m/Y H:i', strtotime($row['data_recebimento'])) . "</td>
                    <td>{$row['status']}</td>
                    <td>
                        <a href='crud.php?action=editEncomenda&id={$row['id']}' class='btn btn-warning btn-sm'>Editar</a>
                        <a href='crud.php?action=deleteEncomenda&id={$row['id']}' 
                           onclick='return confirm(\"Tem certeza que deseja excluir esta encomenda?\");' 
                           class='btn btn-danger btn-sm'>Deletar</a>
                    </td>
                </tr>";
            }
        } else {
            echo "<tr><td colspan='6' class='text-center'>Nenhuma encomenda registrada.</td></tr>";
        }
        ?>
    </tbody>
</table>

<a href="crud.php?action=addEncomenda" class="btn btn-success btn-sm">Adicionar Encomenda</a>

<?php
// Fechar a conexão
$conn->close();
?>


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
              


                </tbody>
            </table>
        </div>


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

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>