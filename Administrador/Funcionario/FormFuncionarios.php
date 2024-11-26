<!doctype html>
<html lang="pt-BR">
<head>
    <!-- Metadados -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="shortcut icon" href="../Admin/img/foto7.png"/>
    
    <!-- CSS -->
    <link rel="stylesheet" type="text/css" href="styleFunc.css" media="screen">

    <!-- Scripts -->
    <script src="validar.js"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="cep.js"></script>

</head>

<body>
<header id="header" class="fixed-top d-flex align-items-center">
            <h1>SISTEMA SILICIO</a></h1>
            <nav id="navbar" class="navbar order-last order-lg-0"> </nav>
        </header>

        <nav id="navbar" class="navbar order-last order-lg-0">
            <ul>
                <li><a class="nav-link scrollto active" href="../index.php">Home</a></li>
                <li class="dropdown"><a href="#"><span>Funcionário</span> <i class="bi bi-chevron-down"></i></a>
                    <ul>
                        <li><a href="FormFuncionarios.php">Cadastrar</a></li>
                        <li><a href="ConsultarFuncionarios.php">Consultar</a></li>
                    </ul>
                </li>
                <li class="dropdown"><a href="#"><span>Comanda</span> <i class="bi bi-chevron-down"></i></a>
                    <ul>
                        <li><a href="../Comanda/FormComanda.php">Cadastrar</a></li>
                        <li><a href="../Comanda/ConsultarComanda.php">Consultar</a></li>
                    </ul>
                </li>
            </ul>
        </nav>
    </div>


<!-- Início do formulário -->
<div>
    <form method="post" action="CadastrarFuncionarios.php">
        <fieldset class="grupo">
            <div class="cabecalho">
                <h1 id="titulo">Cadastrar Funcionário</h1>
                <br>
            </div>
        </fieldset>

        <fieldset class="grupo">
            <div class="campo">
                <label for="nome"><strong>Nome do Funcionário</strong></label>
                <input type="text" name="nome" id="nome" size="50" required>
            </div>
        </fieldset> 

        <fieldset class="grupo">
            <div class="campo">
                <label for="email"><strong>Email</strong></label>
                <input type="email" name="email" id="email" size="50" required>
            </div>
        </fieldset>

        <fieldset class="grupo">
            <div class="campo">
                <label for="senha"><strong>Senha</strong></label>
                <input type="password" name="senha" id="senha" size="30" required>
            </div>
        </fieldset>

        <fieldset class="grupo">
            <div class="campo">
                <label for="cargo"><strong>Cargo</strong></label>
                <input type="text" name="cargo" id="cargo" size="30" required>
            </div>
        </fieldset>

        <fieldset class="grupo">
            <button class="botao" type="submit">Cadastrar</button>
            <a href="../index.php"><input type="button" class="botao" value="Cancelar"/></a>
        </fieldset>
    </form>
</div>

<!--<div class="foto">
    <img src="../img/Foto 2 Grande.png">
</div>-->

</body>
</html>
