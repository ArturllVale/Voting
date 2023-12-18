<!-- index.php -->
<?php
session_start(); // Inicializar a sessão
include_once("config/conexao.php");
include_once("config/dados.php");
?>
<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>
        <?php echo $title; ?>
    </title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <link rel="stylesheet" href="data/estilo.css">
</head>

<body>
    <div class="container-fluid">
        <?php include 'modules/header.php'; ?>
        <?php include 'modules/navbar.php'; ?>
        <?php
        // Verificar se a página a ser incluída existe, caso contrário, incluir home.php por padrão
        $page = isset($_GET['page']) ? $_GET['page'] : 'home';

        // Certificar-se de que o nome da página é seguro (sem caracteres especiais, apenas letras e números)
        if (!preg_match('/^[a-zA-Z0-9]+$/', $page)) {
            $page = 'home'; // Página padrão em caso de nome inválido
        }

        // Construir o caminho completo do arquivo da página
        $pagePath = "pages/$page.php";

        // Verificar se o arquivo existe antes de incluir
        if (file_exists($pagePath)) {
            include $pagePath;
        } else {
            include "pages/home.php"; // Página padrão em caso de arquivo não encontrado
        }
        ?>

    </div>
    <?php include 'modules/footer.php'; ?>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL"
        crossorigin="anonymous"></script>
</body>

</html>