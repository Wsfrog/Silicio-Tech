<?php
session_start();
require '../BancoDAO/db.php'; // Certifique-se de que o caminho está correto

// Verificar se o formulário foi enviado
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $email = $_POST['email'];
    $senha = $_POST['senha'];
    $userType = $_POST['userType'];

    // Verificar se todos os campos foram preenchidos
    if (empty($email) || empty($senha) || empty($userType)) {
        echo "Por favor, preencha todos os campos.";
        exit;
    }

    // Consultar o banco de dados para encontrar o usuário
    $sql = "SELECT id, email, senha, tipo FROM usuarios WHERE email = ? AND tipo = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("ss", $email, $userType);
    $stmt->execute();
    $result = $stmt->get_result();

    // Verificar se o usuário foi encontrado e a senha está correta
    if ($result->num_rows > 0) {
        $user = $result->fetch_assoc();
        if (password_verify($senha, $user['senha'])) {
            // Armazenar ID e tipo de usuário na sessão
            $_SESSION['user_id'] = $user['id'];
            $_SESSION['user_type'] = $user['tipo']; // Armazenar tipo de usuário também

            // Redirecionar para a página apropriada com base no tipo de usuário
            switch ($userType) {
                case 'morador':
                    header('Location: /etechbeta/pagina-principal/resident.php'); // Corrigir caminho
                    break;
                    case 'funcionario':
                        header('Location: funcionarios/index.php');
                        break;
                case 'admin':
                    header('Location: ../pagina-principal/Administrador/index.php'); // Corrigir caminho
                    break;
                default:
                    echo "Tipo de usuário inválido.";
                    exit;
            }
        } else {
            echo "Credenciais inválidas.";
        }
    } else {
        echo "Usuário não encontrado.";
    }
}
?>

<!-- HTML do formulário de login -->
<form method="POST" action="">
    <label for="email">Email:</label>
    <input type="email" id="email" name="email" required>

    <label for="senha">Senha:</label>
    <input type="password" id="senha" name="senha" required>

    <label for="userType">Tipo de Usuário:</label>
    <select id="userType" name="userType" required>
        <option value="morador">Morador</option>
        <option value="funcionario">Funcionário</option>
        <option value="admin">Administrador</option>
    </select>

    <button type="submit">Entrar</button>
</form>
