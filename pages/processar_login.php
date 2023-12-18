<!-- processar_login.php -->
<?php
include_once("config/conexao.php");

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $login = $_POST['login'];
    $senha = $_POST['senha'];

    // Verificar as credenciais no banco de dados
    $query = "SELECT id FROM usuarios WHERE login = ? AND senha = ? LIMIT 1";
    $stmt = $conn->prepare($query);
    $stmt->bind_param("ss", $login, $senha);
    $stmt->execute();
    $stmt->store_result();

    // Se as credenciais são válidas
    if ($stmt->num_rows == 1) {
        $stmt->bind_result($user_id);
        $stmt->fetch();

        // Armazenar o ID do usuário na sessão
        $_SESSION['user_id'] = $user_id;

        // Redirecionar para a página inicial
        header("Location: index.php");
        exit();
    } else {
        // Credenciais inválidas, redirecionar para a página de login
        header("Location: login.php");
        exit();
    }
} else {
    // Requisição inválida, redirecionar para a página de login
    header("Location: login.php");
    exit();
}
?>