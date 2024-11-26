<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Administrador</title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet" />
    <!-- Bootstrap Icons -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css" rel="stylesheet" />
    <style>
        /* Fundo com efeito vidro */
        body {
            background-color: #1a1a1a;
            font-family: Arial, sans-serif;
            color: #f7f7f7;
            overflow-x: hidden;
        }

        #header {
            position: fixed;
            top: 0;
            width: 100%;
            background: rgba(0, 0, 0, 0.6);
            backdrop-filter: blur(10px);
            padding: 20px;
            z-index: 999;
            display: flex;
            justify-content: center;
        }

        h1 {
            color: #ffcc00;
            font-size: 2rem;
            font-weight: bold;
        }

        /* Cards para navegação */
        .card-container {
            margin-top: 100px;
            display: flex;
            justify-content: center;
            flex-wrap: wrap;
        }

        .card {
            background-color: rgba(0, 0, 0, 0.7);
            border-radius: 10px;
            margin: 15px;
            padding: 20px;
            text-align: center;
            width: 200px;
            color: #f7f7f7;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.3);
            transition: transform 0.3s ease, background-color 0.3s ease;
        }

        .card:hover {
            transform: translateY(-10px);
            background-color: #333;
        }

        .card i {
            font-size: 40px;
            margin-bottom: 15px;
            color: #ffcc00;
            transition: transform 0.3s ease;
        }

        .card span {
            font-size: 18px;
            font-weight: bold;
            color: #f7f7f7;
            cursor: pointer;
            display: block;
            margin-top: 10px;
        }

        .card span:hover {
            color: #ffcc00;
            text-decoration: underline;
        }

        /* Botões separados */
        .btn-container {
            display: flex;
            flex-direction: column;
            align-items: center;
            gap: 10px;
            margin-top: 15px;
        }

        /* Estilo do botão de logout */
        .logout {
            position: fixed;
            left: 20px;
            bottom: 20px;
            padding: 10px 20px;
            background-color: #ffcc00;
            color: #1a1a1a;
            font-weight: bold;
            border: none;
            border-radius: 5px;
            transition: background-color 0.3s ease;
            cursor: pointer;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.3);
        }

        .logout:hover {
            background-color: #e6b800;
        }

        .logout:active {
            background-color: #cc9900;
        }

        /* Efeito de cursor */
        body {
            cursor: url('https://cdn.jsdelivr.net/npm/feather-icons@4.28.0/dist/icons/cursor.svg'), auto;
        }

        /* Responsividade */
        @media (max-width: 768px) {
            .card-container {
                flex-direction: column;
                align-items: center;
            }

            .card {
                width: 80%;
                margin: 10px;
            }

            .btn-container {
                gap: 15px;
            }
        }
    </style>
</head>
<body>
    <header id="header" class="d-flex align-items-center justify-content-center">
        <h1>Administrador</h1>
    </header>

    <div class="card-container">
        <!-- Card Funcionário -->
        <div class="card">
            <i class="bi bi-person-fill"></i>
            <span>Funcionário</span>
            <div class="btn-container">
                <a href="Funcionario/CadastrarFuncionarios.php" class="btn btn-warning btn-sm">Cadastrar</a>
                <a href="Funcionario/ConsultarFuncionarios.php" class="btn btn-warning btn-sm">Consultar</a>
            </div>
        </div>

        <!-- Card Morador -->
        <div class="card">
            <i class="bi bi-house-door-fill"></i>
            <span>Morador</span>
            <div class="btn-container">
                <a href="Morador/CadastrarMorador.php" class="btn btn-warning btn-sm">Cadastrar</a>
                <a href="Morador/ConsultarMorador.php" class="btn btn-warning btn-sm">Consultar</a>
            </div>
        </div>

        <!-- Card Reserva -->
        <div class="card">
            <i class="bi bi-calendar-event"></i>
            <span>Reserva</span>
            <div class="btn-container">
                <a href="Reserva/Reserva.php" class="btn btn-warning btn-sm">Reserva</a>
            </div>
        </div>

        <!-- Card Venda -->
        <div class="card">
            <i class="bi bi-basket-fill"></i>
            <span>Venda</span>
            <div class="btn-container">
                <a href="Vendas/Visao/index.php" class="btn btn-warning btn-sm">Vendas</a>
            </div>
        </div>
    </div>

    <!-- Botão Sair -->
    <a class="logout" href="logout.php">Sair</a>

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.min.js"></script>
</body>
</html>
