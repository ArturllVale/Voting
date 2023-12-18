<?php
session_start();

if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit();
}

include_once("../config/conexao.php");

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $user_id = $_SESSION['user_id'];
    $post_id = $_POST['post_id'];

    // Verificar se o post pertence ao usuário
    $query_check_owner = "SELECT * FROM posts WHERE id = ? AND user_id = ?";
    $stmt_check_owner = $conn->prepare($query_check_owner);
    $stmt_check_owner->bind_param("ii", $post_id, $user_id);
    $stmt_check_owner->execute();
    $result_check_owner = $stmt_check_owner->get_result();

    if ($result_check_owner->num_rows > 0) {
        // Excluir o post
        $query_delete_post = "DELETE FROM posts WHERE id = ?";
        $stmt_delete_post = $conn->prepare($query_delete_post);
        $stmt_delete_post->bind_param("i", $post_id);

        if ($stmt_delete_post->execute()) {
            header("Location: manager.php");
            exit();
        } else {
            echo "Erro ao excluir o post.";
        }
    } else {
        echo "Você não tem permissão para excluir este post.";
    }
} else {
    header("Location: manager.php");
    exit();
}
?>
