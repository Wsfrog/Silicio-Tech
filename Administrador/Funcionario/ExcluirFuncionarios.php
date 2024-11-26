<?php

include("../db.php");

$recid = filter_input(INPUT_GET, 'funcionario');

if (mysqli_query($conn, "DELETE FROM funcionarios WHERE id=$recid")) {
    echo "<script>alert('Dados excluídos com sucesso!'); window.location = 'ConsultarFuncionarios.php';</script>";
} else {
    echo "Não foi possível excluir os dados no Banco de Dados: " . $recid . "<br>" . mysqli_error($conn);
}

mysqli_close($conn);

?>
