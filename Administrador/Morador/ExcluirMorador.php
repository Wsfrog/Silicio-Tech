<?php

include("../db.php");

// Recebendo o ID do morador a ser excluído
$recid = filter_input(INPUT_GET, 'morador');

// Deletando o morador do banco de dados
if (mysqli_query($conn, "DELETE FROM moradores WHERE id=$recid")) {
    echo "<script>alert('Morador excluído com sucesso!'); window.location = 'ConsultarMorador.php';</script>";
} else {
    echo "Não foi possível excluir os dados no Banco de Dados: " . $recid . "<br>" . mysqli_error($conn);
}

mysqli_close($conn);

?>
