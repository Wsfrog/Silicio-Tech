<!doctype html>
<html lang="pt-BR">

<head>
    <!-- Metadados -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="shortcut icon" href="../Admin/img/foto7.png" />
    <link rel="stylesheet" type="text/css" href="../css/StyleForm.css" media="screen">

    <!-- Scripts 
    <script src="validar.js"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="cep.js"></script>-->

    <!-- Título da página -->
    <title>Cadastrar Morador</title>
</head>

<body>

    <header id="header" class="fixed-top d-flex align-items-center">
        <div class="container-fluid container-xl d-flex align-items-center justify-content-lg-between">
            <h1 class="logo me-auto me-lg-0"><a href="../index.php">SISTEMA SILICIO</a></h1>

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
    </header>

    <!-- Início do formulário -->
    <div>
        <form method="post" action="CadastrarMorador.php">
            <fieldset class="grupo">
                <div class="cabecalho">
                    <h1 id="titulo">Cadastrar Morador</h1>
                    <br>
                </div>
            </fieldset>

            <!-- Campo para nome (comum a moradores) -->
            <fieldset class="grupo">
                <div class="campo">
                    <label for="nome"><strong>Nome</strong></label>
                    <input type="text" name="nome" id="nome" size="50" required>
                </div>
            </fieldset>

            <!-- Campos específicos para morador -->
            <fieldset class="grupo">
                <div class="campo">
                    <label for="email"><strong>Email</strong></label>
                    <input type="email" name="email" id="email" size="50" required>
                </div>

                <div class="campo">
                    <label for="senha"><strong>Senha</strong></label>
                    <input type="password" name="senha" id="senha" size="30" required>
                </div>

                <div class="campo">
                    <label for="telefone"><strong>Telefone</strong></label>
                    <input type="text" name="telefone" id="telefone" size="30" required>
                </div>
            </fieldset>

            <fieldset class="grupo">
                <button class="botao" type="submit">Cadastrar</button>
                <a href="../index.php"><input type="button" class="botao" value="Cancelar" /></a>
            </fieldset>
        </form>
    </div>

</body>

</html>
