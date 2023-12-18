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

    // Verificar se a imagem foi enviada
    if (isset($_FILES['image']) && $_FILES['image']['error'] === UPLOAD_ERR_OK) {
        // Configurações do upload
        $upload_dir = 'uploads/'; // Diretório para salvar as imagens
        $allowed_extensions = array('jpg', 'jpeg', 'png', 'gif');

        // Obter informações sobre a imagem
        $image_info = pathinfo($_FILES['image']['name']);
        $image_extension = strtolower($image_info['extension']);

        // Verificar a extensão da imagem
        if (in_array($image_extension, $allowed_extensions)) {
            // Gerar um nome único para a imagem
            $image_name = uniqid('post_') . '.' . $image_extension;

            // Caminho completo para a imagem
            $image_path = $upload_dir . $image_name;

            // Mover a imagem para o diretório de uploads
            move_uploaded_file($_FILES['image']['tmp_name'], $image_path);

            // Inserir os dados no banco de dados
            $query_insert = "INSERT INTO posts (user_id, image_path, tag, text_content) VALUES (?, ?, ?, ?)";
            $stmt_insert = $conn->prepare($query_insert);
            $stmt_insert->bind_param("iss", $user_id, $image_path, $tag, $text_content);

            if ($stmt_insert->execute()) {
                // Redirecionar de volta para a página de gerenciamento
                header("Location: manager.php");
                exit();
            } else {
                echo "Erro ao inserir post no banco de dados.";
            }
        } else {
            echo "Apenas imagens nos formatos JPG, JPEG, PNG e GIF são permitidas.";
        }
    } else {
        echo "Erro ao fazer upload da imagem.";
    }
} else {
    // Requisição inválida, redirecionar para a página de gerenciamento
    header("Location: manager.php");
    exit();
}
?>
