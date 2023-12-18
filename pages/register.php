<?php
session_start();

// Verificar se o usuário já está logado, se sim, redirecionar para a página inicial
if (isset($_SESSION['user_id'])) {
    header("Location: ../index.php");
    exit();
}

include_once("../config/conexao.php");

// Inicializar variáveis para mensagens de erro
$login_error = $email_error = "";

// Processar o formulário quando enviado
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Limpar e validar dados
    $login = trim($_POST["login"]);
    $email = trim($_POST["email"]);
    $senha = $_POST["senha"];

    // Verificar se o login já existe
    $query_login = "SELECT id FROM usuarios WHERE login = ?";
    $stmt_login = $conn->prepare($query_login);
    $stmt_login->bind_param("s", $login);
    $stmt_login->execute();
    $stmt_login->store_result();

    if ($stmt_login->num_rows > 0) {
        $login_error = "Este login já está em uso.";
    }

    // Verificar se o e-mail já existe
    $query_email = "SELECT id FROM usuarios WHERE email = ?";
    $stmt_email = $conn->prepare($query_email);
    $stmt_email->bind_param("s", $email);
    $stmt_email->execute();
    $stmt_email->store_result();

    if ($stmt_email->num_rows > 0) {
        $email_error = "Este e-mail já está registrado.";
    }

    // Se não houver erros, inserir os dados no banco de dados
    if (empty($login_error) && empty($email_error)) {
        $query_insert = "INSERT INTO usuarios (login, senha, email, tipo) VALUES (?, ?, ?, 1)";
        $stmt_insert = $conn->prepare($query_insert);
        $stmt_insert->bind_param("sss", $login, $senha, $email);

        if ($stmt_insert->execute()) {
            // Registro bem-sucedido, redirecionar para a página de login
            header("Location: login.php");
            exit();
        } else {
            echo "Erro ao registrar usuário. Por favor, tente novamente mais tarde.";
        }
    }
}

?>

<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Registrar</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <link rel="stylesheet" href="data/estilo.css">
</head>

<body class="text-center">

    <main class="form-signin">
        <form action="" method="post">
            <h1 class="h3 mb-3 fw-normal">Registrar</h1>

            <div class="form-floating">
                <input type="text" class="form-control" id="login" name="login" placeholder="Login" required>
                <label for="login">Login</label>
                <span class="text-danger"><?php echo $login_error; ?></span>
            </div>

            <div class="form-floating">
                <input type="email" class="form-control" id="email" name="email" placeholder="E-mail" required>
                <label for="email">E-mail</label>
                <span class="text-danger"><?php echo $email_error; ?></span>
            </div>

            <div class="form-floating">
                <input type="password" class="form-control" id="senha" name="senha" placeholder="Senha" required>
                <label for="senha">Senha</label>
            </div>

            <button class="w-100 btn btn-lg btn-primary" type="submit">Registrar</button>
        </form>
    </main>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL"
        crossorigin="anonymous"></script>
</body>

</html>
