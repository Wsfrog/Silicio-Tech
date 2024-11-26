<!doctype html>
<html>

    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
        <link rel="shortcut icon" href=""/>
        <link rel="stylesheet" href="../css/StyleConsulta.css" media="screen">
        <title>Consultar Moradores</title>
    </head>

    <body>
        <header id="header" class="fixed-top d-flex align-items-center">
            <div class="container-fluid container-xl d-flex align-items-center justify-content-lg-between">
                <h1 class="logo me-auto me-lg-0"><a href="../index.php">SISTEMA SILICIO</a></h1>
            </div>
        </header>

        <div class="consulta">
            <div class="consultarserv">
                <h1>Consultar Moradores</h1>
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
                    <td align="center"><strong>Telefone</strong></td>
                    <td width="10"><strong>Editar</strong></td>
                    <td width="10"><strong>Deletar</strong></td>
                </tr>

                <?php
                include("../db.php");
                $selecionar = mysqli_query($conn, "SELECT * FROM moradores");
                while ($campo = mysqli_fetch_array($selecionar)) {
                    ?>
                    <tr>
                        <td align="center"><?= $campo["id"] ?></td>
                        <td align="center"><?= $campo["nome"] ?></td>
                        <td align="center"><?= $campo["email"] ?></td>
                        <td align="center"><?= $campo["telefone"] ?></td>
                        <td align="center"><a href="FormEditarMorador.php?editarid=<?php echo $campo['id']; ?>"><img src="../img/caderno10.png" width="40" height="40" /></a></td>
                        <td align="center"><a href="ExcluirMorador.php?p=excluir&morador=<?php echo $campo['id']; ?>"><img src="../img/lixeira12.png" width="37" height="37" /></a></td>
                    </tr>
                <?php } ?>
            </table><br>
            <a href="../index.php">
                <button class="botao">Cancelar</button>
            </a>
        </div>
    </body>
</html>
