<?php
include 'conexao.php';

function obterTarefas($funcionario_id) {
    global $pdo;
    $stmt = $pdo->prepare("SELECT * FROM tarefas WHERE id_funcionario = :id");
    $stmt->execute(['id' => $funcionario_id]);
    return $stmt->fetchAll();
}

function obterEncomendas() {
    global $pdo;
    $stmt = $pdo->query("SELECT * FROM encomendas WHERE status = 'Pendente'");
    return $stmt->fetchAll();
}

function marcarEncomendaEntregue($encomenda_id) {
    global $pdo;
    $stmt = $pdo->prepare("UPDATE encomendas SET status = 'Entregue' WHERE id = :id");
    $stmt->execute(['id' => $encomenda_id]);
}
?>
