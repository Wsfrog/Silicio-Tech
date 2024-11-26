<?php

include("../db.php");

// Recebendo os dados do formulário
$recid = filter_input(INPUT_POST, 'id');
$recnome = filter_input(INPUT_POST, 'nome');
$recemail = filter_input(INPUT_POST, 'email');
$recsenha = filter_input(INPUT_POST, 'senha');
$rectelefone = filter_input(INPUT_POST, 'telefone');

// Atualizando os dados do morador no banco de dados
if (mysqli_query($conn, "UPDATE moradores SET nome='$recnome', email='$recemail', senha='$recsenha', telefone='$rectelefone' WHERE id=$recid")) {
    echo "<script>alert('Dados alterados com sucesso!'); window.location = 'ConsultarMorador.php';</script>";
} else {
    echo "Não foi possível alterar os dados no Banco de Dados: " . mysqli_error($conn);
}

mysqli_close($conn);

?>
