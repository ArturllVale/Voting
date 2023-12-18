<?php
session_start();

// Verificar se o usuário já está logado, se sim, redirecionar para a página inicial
if (isset($_SESSION['user_id'])) {
    header("Location: manager.php"); // Ajuste o caminho conforme necessário
    exit();
}
?>

<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Login</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <link rel="stylesheet" href="data/estilo.css">
</head>

<body class="text-center">

    <main class="form-signin">
        <form action="processar_login.php" method="post">
            <h1 class="h3 mb-3 fw-normal">Faça o login</h1>

            <div class="form-floating">
                <input type="text" class="form-control" id="login" name="login" placeholder="Login" required>
                <label for="login">Login</label>
            </div>

            <div class="form-floating">
                <input type="password" class="form-control" id="senha" name="senha" placeholder="Senha" required>
                <label for="senha">Senha</label>
            </div>

            <button class="w-100 btn btn-lg btn-primary" type="submit">Entrar</button>
        </form>
    </main>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL"
        crossorigin="anonymous"></script>
</body>

</html>
