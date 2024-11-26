<?php
require_once '../controle/ingressoController.php';

$ingressoController = new IngressoController();
$ingressos = $ingressoController->listarIngressos();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_POST['ingressoId']) && isset($_POST['quantidadeVenda'])) {
        $ingressoId = $_POST['ingressoId'];
        $quantidade = $_POST['quantidadeVenda'];
        $ingressoController->venderIngresso($ingressoId, $quantidade);
    } elseif (isset($_POST['ingressoIdEstoque']) && isset($_POST['quantidadeEstoque'])) {
        $ingressoIdEstoque = $_POST['ingressoIdEstoque'];
        $quantidadeEstoque = $_POST['quantidadeEstoque'];
        $ingressoController->adicionarIngressos($ingressoIdEstoque, $quantidadeEstoque);
    }
    header("Location: index.php");
}
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sistema de Ingressos</title>
</head>
<body>
  <style>
    /* Estilos Gerais para o Carrinho */
body {
    background-color: #1e1e1e;
    color: #e0e0e0;
    font-family: 'Roboto', sans-serif;
    margin: 0;
    padding: 0;
    display: flex;
    flex-direction: column;
    align-items: center;
}

h1 {
    color: #f5a623;
    margin-top: 20px;
}

table {
    width: 100%;
    max-width: 800px;
    margin: 20px 0;
    border-collapse: collapse;
    background-color: #2c2c2c;
    border-radius: 8px;
    box-shadow: 0px 0px 15px rgba(0, 0, 0, 0.3);
}

th, td {
    padding: 15px;
    text-align: center;
    border-bottom: 1px solid #444;
}

th {
    background-color: #f5a623;
    color: #1e1e1e;
}

tr:nth-child(even) {
    background-color: #3c3c3c;
}

tr:hover {
    background-color: #444;
}

a {
    text-decoration: none;
    color: #f5a623;
    font-weight: bold;
    margin-top: 20px;
}

a:hover {
    color: #d48e1d;
}

.container {
    max-width: 800px;
    padding: 20px;
    background-color: #2c2c2c;
    border-radius: 8px;
    box-shadow: 0px 0px 15px rgba(0, 0, 0, 0.3);
    margin: 20px;
}

footer {
    margin-top: 20px;
    font-size: 14px;
    color: #888;
    text-align: center;
}

  </style>
    <div class="container">
        <h1>Gestão de Ingressos</h1>
        <table border="1">
            <tr>
                <th>ID</th>
                <th>Evento</th>
                <th>Ingressos Disponíveis</th>
                <th>Preço</th>
            </tr>
            <?php foreach ($ingressos as $ingresso): ?>
                <tr>
                    <td><?= $ingresso['idIngresso'] ?></td>
                    <td><?= $ingresso['nomeEvento'] ?></td>
                    <td><?= $ingresso['quantidadeDisponivel'] ?></td>
                    <td>R$ <?= number_format($ingresso['preco'], 2, ',', '.') ?></td>
                </tr>
            <?php endforeach; ?>
        </table>

        <div class="form-container">
            <form method="POST" class="form-venda">
                <h2>Vender Ingressos</h2>
                <label for="ingressoId">ID do Ingresso:</label>
                <input type="number" id="ingressoId" name="ingressoId" required>

                <label for="quantidadeVenda">Quantidade:</label>
                <input type="number" id="quantidadeVenda" name="quantidadeVenda" required>

                <button type="submit">Realizar Venda</button>
            </form>

            <!-- <form method="POST" class="form-estoque">
                <h2>Adicionar Ingressos</h2>
                <label for="ingressoIdEstoque">ID do Ingresso:</label>
                <input type="number" id="ingressoIdEstoque" name="ingressoIdEstoque" required>

                <label for="quantidadeEstoque">Quantidade a Adicionar:</label>
                <input type="number" id="quantidadeEstoque" name="quantidadeEstoque" required>

                <button type="submit">Adicionar Ingressos</button>
            </form> -->
        </div>
    </div>
</body>
</html>