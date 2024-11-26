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
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cadastrar Morador</title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet" />
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
            <h2>Cadastrar Morador</h2>
            <?php
            // Incluir o arquivo de conexão
            include_once "../db.php";

            if (isset($_POST["nome"], $_POST["apartamento"], $_POST["email"], $_POST["senha"], $_POST["telefone"])) {
                $nome = $_POST["nome"];
                $apartamento = $_POST["apartamento"]; // Capturando o apartamento
                $email = $_POST["email"];
                $senha = password_hash($_POST["senha"], PASSWORD_BCRYPT); // Criptografando a senha
                $telefone = $_POST["telefone"];

                try {
                    // Query SQL de inserção usando prepared statements
                    $sql = "INSERT INTO moradores (nome, apartamento, email, senha, telefone) 
                            VALUES (:nome, :apartamento, :email, :senha, :telefone)";

                    $stmt = $pdo->prepare($sql);
                    $stmt->bindParam(':nome', $nome);
                    $stmt->bindParam(':apartamento', $apartamento); // Binding do apartamento
                    $stmt->bindParam(':email', $email);
                    $stmt->bindParam(':senha', $senha);
                    $stmt->bindParam(':telefone', $telefone);

                    if ($stmt->execute()) {
                        echo "<div class='alert alert-success'>Morador cadastrado com sucesso!</div>";
                    } else {
                        echo "<div class='alert alert-danger'>Erro ao cadastrar o morador. Tente novamente.</div>";
                    }
                } catch (PDOException $e) {
                    if ($e->getCode() == 23000) { // Código de erro para duplicidade
                        echo "<div class='alert alert-warning'>Erro: E-mail ou apartamento já cadastrado.</div>";
                    } else {
                        echo "<div class='alert alert-danger'>Erro ao cadastrar o morador: " . $e->getMessage() . "</div>";
                    }
                }
            }
            ?>
            <form method="POST" class="formcadmorador" autocomplete="off">
                <input type="text" name="nome" placeholder="Nome" required>
                <input type="text" name="apartamento" placeholder="Apartamento" required>
                <input type="email" name="email" placeholder="Email" required>
                <input type="password" name="senha" placeholder="Senha" required>
                <input type="text" name="telefone" placeholder="Telefone" required>
                <input type="submit" value="Cadastrar Morador">
            </form>
            <a href="../index.php" class="btn btn-warning mt-3">Cancelar</a>
        </div>
    </div>

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.min.js"></script>
</body>
</html>
