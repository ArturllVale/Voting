<?php
session_start();

// Verificar se o usuário está autenticado
if (!isset($_SESSION['user_id'])) {
    header("Location: login.php"); // Redirecionar para a página de login se não estiver autenticado
    exit();
}

include_once("../config/conexao.php");

// Obter os posts do usuário
$user_id = $_SESSION['user_id'];
$query_posts = "SELECT * FROM posts WHERE user_id = ?";
$stmt_posts = $conn->prepare($query_posts);
$stmt_posts->bind_param("i", $user_id);
$stmt_posts->execute();
$result_posts = $stmt_posts->get_result();
?>

<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Gerenciador</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <link rel="stylesheet" href="data/estilo.css">
</head>

<body>

    <div class="container-fluid">
        <h1>Bem-vindo ao Gerenciador de Posts</h1>

        <!-- Adicionar o formulário de postagem -->
        <form action="processar_postagem.php" method="post" enctype="multipart/form-data">
            <label for="image">Imagem (460px x 80px):</label>
            <input type="file" name="image" accept="image/*" required><br>

            <label for="tag">Etiqueta:</label>
            <select name="tag" required>
                <option value="Opção1">Opção 1</option>
                <option value="Opção2">Opção 2</option>
                <option value="Opção3">Opção 3</option>
            </select><br>

            <label for="text_content">Texto (até 1000 caracteres):</label>
            <textarea name="text_content" id="editor" maxlength="1000" required></textarea><br>

            <input type="submit" value="Postar">
        </form>

        <h2>Seus Posts:</h2>
        <?php
        // Exibir os posts do usuário
        while ($row = $result_posts->fetch_assoc()) {
            echo "<div>";
            echo "<p><strong>ID:</strong> " . $row['id'] . "</p>";
            echo "<p><strong>Imagem:</strong> " . $row['image_path'] . "</p>";
            echo "<p><strong>Tag:</strong> " . $row['tag'] . "</p>";
            echo "<p><strong>Texto:</strong> " . $row['text_content'] . "</p>";
            echo "<p><strong>Data de Criação:</strong> " . $row['created_at'] . "</p>";
            echo "</div>";
        }
        ?>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL"
        crossorigin="anonymous"></script>
</body>

</html>
