<?php
include 'funcoes.php';
if (isset($_GET['id'])) {
    $encomenda_id = $_GET['id'];
    marcarEncomendaEntregue($encomenda_id);
    echo "Encomenda marcada como entregue com sucesso!";
} else {
    echo "ID da encomenda não fornecido.";
}
?>
