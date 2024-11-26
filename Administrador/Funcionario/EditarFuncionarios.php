<?php

include("../db.php");

$recid = filter_input(INPUT_POST, 'id');
$recnome = filter_input(INPUT_POST, 'nome');
$recemail = filter_input(INPUT_POST, 'email');
$recsenha = filter_input(INPUT_POST, 'senha');
$reccargo = filter_input(INPUT_POST, 'cargo');

if (mysqli_query($conn, "UPDATE funcionarios SET nome='$recnome', email='$recemail', senha='$recsenha', cargo='$reccargo' WHERE id=$recid")) {
    echo "<script>alert('Dados alterados com sucesso!'); window.location = 'ConsultarFuncionarios.php';</script>";
} else {
    echo "Não foi possível alterar os dados no Banco de Dados: " . mysqli_error($conn);
}

mysqli_close($conn);

?>
