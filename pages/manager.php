<!-- manager.php -->
<?php
// Verificar se o usuário está autenticado
if (!isset($_SESSION['user_id'])) {
    header("Location: login.php"); // Redirecionar para a página de login se não estiver autenticado
    exit();
}
?>

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
