<?php
session_start();

// Verificar se o usuário está autenticado
if (!isset($_SESSION['user_id'])) {
    header("Location: login.php"); // Redirecionar para a página de login se não estiver autenticado
    exit();
}

include_once("../config/conexao.php");

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Obter dados do formulário
    $user_id = $_SESSION['user_id'];
    $tag = $_POST['tag'];
    $text_content = $_POST['text_content'];

    // Verificar se o campo da URL da imagem está definido
    if (isset($_POST['image_url'])) {
        $image_url = $_POST['image_url'];

        // Inserir os dados no banco de dados
        $query_insert = "INSERT INTO posts (user_id, image_url, tag, text_content) VALUES (?, ?, ?, ?)";
        $stmt_insert = $conn->prepare($query_insert);

        // Verificar se o campo da URL da imagem está definido
        if (isset($_POST['image_url'])) {
            $image_url = $_POST['image_url'];
        } else {
            // Caso o campo da URL da imagem não esteja definido, defina um valor padrão ou lide com a lógica apropriada
            $image_url = ''; // Defina um valor padrão ou lógica apropriada
        }

        $stmt_insert->bind_param("isss", $user_id, $image_url, $tag, $text_content);


        if ($stmt_insert->execute()) {
            // Redirecionar de volta para a página de gerenciamento
            header("Location: manager.php");
            exit();
        } else {
            echo "Erro ao inserir post no banco de dados.";
        }
    } else {
        echo "O campo da URL da imagem não está definido.";
    }
} else {
    // Requisição inválida, redirecionar para a página de gerenciamento
    header("Location: manager.php");
    exit();
}
?>