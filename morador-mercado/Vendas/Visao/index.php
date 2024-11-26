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
  <a href="../../index.php"><input type="button" class="botao" value="Cancelar"/></a>
</body>
</html>