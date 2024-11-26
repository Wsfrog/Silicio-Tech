<?php
// db.php (conexão PDO)
$host = 'localhost';
$dbname = 'etech';
$user = 'root';
$password = '';

try {
    $pdo = new PDO("mysql:host=$host;dbname=$dbname;charset=utf8", $user, $password);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    echo "Erro na conexão: " . $e->getMessage();
    exit();
}
?>

<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="utf-8">
    <title>Cadastrar Funcionário</title>
    <link rel="stylesheet" href="../css/StyleCadastro.css">
</head>
<body>
    
    <header id="header" class="fixed-top d-flex align-items-center">
        <h1>SISTEMA SILICIO</h1>
        <nav id="navbar" class="navbar order-last order-lg-0"> </nav>
    </header>

    <?php
    // Incluir o arquivo de conexão
    include_once "../db.php";

    if (isset($_POST["nome"])) {
        $nome = $_POST["nome"];
        $email = $_POST["email"];
        $senha = password_hash($_POST["senha"], PASSWORD_BCRYPT); // Criptografando a senha
        $cargo = $_POST["cargo"];
        
        try {
            // Query SQL de inserção usando prepared statements
            $sql = "INSERT INTO funcionarios (nome, email, senha, cargo) 
                    VALUES (:nome, :email, :senha, :cargo)";
            
            $stmt = $pdo->prepare($sql);
            $stmt->bindParam(':nome', $nome);
            $stmt->bindParam(':email', $email);
            $stmt->bindParam(':senha', $senha);
            $stmt->bindParam(':cargo', $cargo);

            if ($stmt->execute()) {
                echo "<script>alert('Funcionário cadastrado com sucesso!'); window.location = '../index.php';</script>";
            } else {
                echo "Erro ao cadastrar o funcionário.";
            }
        } catch (PDOException $e) {
            if ($e->getCode() == 23000) { // Código de erro para duplicidade
                echo "<script>alert('Erro: E-mail já cadastrado.'); window.location = 'CadastrarFuncionarios.php';</script>";
            } else {
                echo "Erro ao cadastrar o funcionário: " . $e->getMessage();
            }
        }
    }
    ?>

<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cadastrar Funcionário</title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet" />
    <!-- Bootstrap Icons -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css" rel="stylesheet" />
    <style>
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
        .card-container {
            margin-top: 100px;
            display: flex;
            justify-content: center;
        }
        .card {
            background-color: rgba(0, 0, 0, 0.7);
            border-radius: 10px;
            padding: 20px;
            text-align: center;
            width: 100%;
            max-width: 500px;
            color: #f7f7f7;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.3);
        }
        .formcadmorador input {
            width: 100%;
            padding: 10px;
            margin: 10px 0;
            border: none;
            border-radius: 5px;
            background-color: #333;
            color: #f7f7f7;
        }
        .formcadmorador input[type="submit"] {
            background-color: #ffcc00;
            color: #1a1a1a;
            font-weight: bold;
            border: none;
            cursor: pointer;
            border-radius: 5px;
            padding: 12px 20px;
            margin-top: 20px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.3);
        }
        .formcadmorador input[type="submit"]:hover {
            background-color: #e6b800;
        }
    </style>
</head>
<body>
    <header id="header" class="d-flex align-items-center justify-content-center">
        <h1>SISTEMA SILICIO</h1>
    </header>

    <div class="card-container">
        <div class="card">
            <h2>Cadastrar Funcionário</h2>
            <form method="POST" class="formcadcomanda" autocomplete="off">
                <label for="nome">Nome:</label>
                <input type="text" name="nome" id="nome" required><br>

                <label for="email">Email:</label>
                <input type="email" name="email" id="email" required><br>

                <label for="senha">Senha:</label>
                <input type="password" name="senha" id="senha" required><br>

                <label for="cargo">Cargo:</label>
                <input type="text" name="cargo" id="cargo" required><br>

                <input type="submit" value="Cadastrar Funcionário">
            </form>
            <a href="../index.php" class="botao">Cancelar</a>
        </div>
    </div>

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.min.js"></script>
</body>
</html>