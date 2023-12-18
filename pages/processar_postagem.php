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
    $title = $_POST['title'];
    $text_content = $_POST['text_content'];

    // Verificar se o usuário já possui uma postagem
    $query_check_post = "SELECT id FROM posts WHERE user_id = ? LIMIT 1";
    $stmt_check_post = $conn->prepare($query_check_post);
    $stmt_check_post->bind_param("i", $user_id);
    $stmt_check_post->execute();
    $result_check_post = $stmt_check_post->get_result();

    if ($result_check_post->num_rows > 0) {
        // O usuário já possui uma postagem
        echo '<script>alert("Você já possui uma postagem."); window.location.href = "manager.php";</script>';
        exit();
    }

    // Verificar se o campo da URL da imagem está definido
    if (isset($_POST['image_url'])) {
        $image_url = $_POST['image_url'];

        // Inserir os dados no banco de dados
        $query_insert = "INSERT INTO posts (user_id, image_url, tag, title, text_content) VALUES (?, ?, ?, ?, ?)";
        $stmt_insert = $conn->prepare($query_insert);
        $default_image_url = ''; // Defina um valor padrão para image_url, já que não estamos fazendo upload
        $stmt_insert->bind_param("issss", $user_id, $default_image_url, $tag, $title, $text_content);

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
