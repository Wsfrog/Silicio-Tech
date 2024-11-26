<!doctype html>
<html>

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="shortcut icon" href=""/>
    <link rel="stylesheet" href="../css/StyleConsulta.css" media="screen">
    <title>Consultar Funcionários</title>
</head>

<body>
 
            <h1>SISTEMA SILICIO</a></h1>
            <nav id="navbar" class="navbar order-last order-lg-0"> </nav>
   
    <div class="consulta">
        <div class="consultarserv">
            <h1>Consultar Funcionários</h1>
        </div>
        
        <table
            width="100%"
            border="1" 
            bordercolor="silver"
            cellspacing="2" 	
            cellpadding="5"
        >
            <tr>
                <td align="center"><strong>ID</strong></td>	
                <td align="center"><strong>Nome</strong></td>		
                <td align="center"><strong>Email</strong></td>
                <td align="center"><strong>Cargo</strong></td>
                <td width="10"><strong>Editar</strong></td>
                <td width="10"><strong>Deletar</strong></td>
            </tr>

            <?php
            include("../db.php");
            $selecionar = mysqli_query($conn, "SELECT * FROM funcionarios");
            while ($campo = mysqli_fetch_array($selecionar)) {
                ?>
                <tr>
                    <td align="center"><?= $campo["id"] ?></td>
                    <td align="center"><?= $campo["nome"] ?></td>
                    <td align="center"><?= $campo["email"] ?></td>
                    <td align="center"><?= $campo["cargo"] ?></td>
                    <td align="center"><a href="FormEditarFuncionarios.php?editarid=<?php echo $campo['id']; ?>"><img src="../img/caderno10.png" width="40" height="40" /></a></td>
                    <td align="center"><a href="ExcluirFuncionarios.php?p=excluir&funcionario=<?php echo $campo['id']; ?>"><img src="../img/lixeira12.png" width="37" height="37" /></a></td>
                </tr>
            <?php } ?>
        </table><br>
        <a href="../index.php"><input type="button" class="botao" value="Cancelar"/></a>
    </div>

    <!--<div class="foto">
        <img src="../img/Foto 2 Grande.png">
    </div>-->

</body>
</html>
