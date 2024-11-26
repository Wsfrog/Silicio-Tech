<?php
require_once '../Administrador/Vendas/Controle/IngressoController.php';

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
    header("Location: mercado.php");
}
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../../css/StyleVenda.css">
    <title>Sistema de Produto</title>
</head>
<body>

  </style>
    <div class="container">
        <h1>Gestão de Produtos</h1>
        <table border="1">
            <tr>
                <th>ID</th>
                <th>Produtos</th>
                <th>Produtos Disponíveis</th>
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
                <h2>Comprar Produtos</h2>
                <label for="ingressoId">ID do Produto:</label>
                <input type="number" id="ingressoId" name="ingressoId" required>

                <label for="quantidadeVenda">Quantidade:</label>
                <input type="number" id="quantidadeVenda" name="quantidadeVenda" required>

                <button type="submit">Realizar Venda</button>
            </form>
           

        <!--     <div class="form-container">
    <form method="POST" class="form-estoque">
        <h2>Adicionar Produtos</h2>
        <label for="ingressoIdEstoque">ID do Produto:</label>
        <input type="number" id="ingressoIdEstoque" name="ingressoIdEstoque" required>

        <label for="quantidadeEstoque">Quantidade a Adicionar:</label>
        <input type="number" id="quantidadeEstoque" name="quantidadeEstoque" required>

        <button type="submit">Adicionar Produtos</button>
    </form>
</div> -->

           
        </div>
    </div>
  <a href="../../resident.html"><input type="button" class="botao" value="voltar"/></a>
</body>
</html>

<style>
    body {
    font-family: 'Arial', sans-serif;
    background: linear-gradient(135deg, #1c1c1c, #333);
    color: #f9f9f9;
    margin: 0;
    padding: 0;
}

.container {
    width: 90%;
    max-width: 1200px;
    margin: 40px auto;
    background: rgba(255, 255, 255, 0.1);
    padding: 20px;
    border-radius: 10px;
    box-shadow: 0 5px 15px rgba(0, 0, 0, 0.5);
}

h1 {
    text-align: center;
    font-size: 2.5rem;
    color: gold;
    margin-bottom: 20px;
}

table {
    width: 100%;
    border-collapse: collapse;
    margin-bottom: 20px;
}

table th, table td {
    border: 1px solid gold;
    padding: 10px;
    text-align: center;
    color: #fff;
}

table th {
    background: #444;
    color: gold;
    font-size: 1.1rem;
}

table tr:nth-child(even) {
    background: rgba(255, 255, 255, 0.05);
}

table tr:hover {
    background: rgba(255, 215, 0, 0.2);
}

.form-container {
    margin-top: 20px;
    background: rgba(0, 0, 0, 0.8);
    padding: 20px;
    border-radius: 10px;
    box-shadow: 0 5px 15px rgba(0, 0, 0, 0.5);
}

.form-container h2 {
    text-align: center;
    color: gold;
    margin-bottom: 20px;
}

label {
    display: block;
    color: #f9f9f9;
    margin-bottom: 5px;
    font-weight: bold;
}

input[type="number"] {
    width: 100%;
    padding: 10px;
    margin-bottom: 15px;
    border: 1px solid gold;
    border-radius: 5px;
    background: rgba(255, 255, 255, 0.1);
    color: #f9f9f9;
    font-size: 1rem;
}

input[type="number"]:focus {
    outline: none;
    border-color: gold;
    box-shadow: 0 0 5px gold;
}

.botao {
    display: inline-block;
    padding: 10px 20px;
    font-size: 1rem;
    font-weight: bold;
    text-align: center;
    color: #fff;
    background: gold;
    border: none;
    border-radius: 5px;
    text-decoration: none;
    cursor: pointer;
    transition: background 0.3s ease, transform 0.2s ease;
}

.botao:hover {
    background: #d4af37;
    transform: scale(1.05);
}

.botao:active {
    transform: scale(0.95);
}

input[type="button"], .botao {
    margin-top: 10px;
}

a.botao {
    text-decoration: none;
}

</style>