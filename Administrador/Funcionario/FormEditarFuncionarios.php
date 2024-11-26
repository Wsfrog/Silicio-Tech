<!DOCTYPE html>

<html>

    <head>

        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
        <link rel="shortcut icon" href="../Admin/img/foto7.png"/>

        <link rel="stylesheet" type="text/css" href="../css/StyleFormEd.css" media="screen">

        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">

        <script type='text/javascript' src='js.js'></script>

        <title>Editar Funcionários</title>
    </head>

    <body>

        <?php
        include("../db.php");

        // Obtém o ID do funcionário a ser editado via URL
        $recid = filter_input(INPUT_GET, 'editarid', FILTER_VALIDATE_INT);

        if ($recid) {
            // Consulta para selecionar os dados do funcionário
            $selecionar = mysqli_query($conn, "SELECT * FROM funcionarios WHERE id = $recid");
            $campo = mysqli_fetch_array($selecionar);
        }
        ?>

       <h1>SISTEMA SILICIO</a></h1>
            <nav id="navbar" class="navbar order-last order-lg-0"> </nav>

        <div class="formcadcomanda">
            <form method="post" action="EditarFuncionarios.php">
              
                    <div class="cabecalho">
                        <h1 id="titulo">Editar Funcionário</h1>
                        <br>
                    </div>
                

              
                    <input type="hidden" name="id" value="<?= $campo["id"] ?>"> <!-- Campo oculto para o ID -->
                    <div class="campo">
                        <label for="nome"><strong>Nome</strong></label>
                        <input type="text" name="nome" value="<?= $campo["nome"] ?>" id="nome" size="50" required>
                    </div>
            

              
                    <div class="campo">
                        <label for="email"><strong>Email</strong></label>
                        <input type="email" name="email" value="<?= $campo["email"] ?>" id="email" size="50" required>
                    </div>

                    <div class="campo">
                        <label for="senha"><strong>Senha</strong></label>
                        <input type="password" name="senha" id="senha" size="50" required>
                    </div>
          

             
                    <div class="campo">
                        <label for="cargo"><strong>Cargo</strong></label>
                        <input type="text" name="cargo" value="<?= $campo["cargo"] ?>" id="cargo" size="50" required>
                    </div>
       

               
                    <button class="botao" type="submit">Salvar</button>
                    <a href="../index.php"><input type="button" class="botao" value="Cancelar"/></a>
          
            </form>
        </div>

    </body>

</html>
