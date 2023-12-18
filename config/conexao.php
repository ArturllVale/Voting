<?php
// Configurações para conexão com o banco de dados
$servername = "seu_servidor"; // Nome do servidor
$username = "seu_usuario"; // Nome de usuário do banco de dados
$password = "sua_senha"; // Senha do banco de dados
$dbname = "seu_banco"; // Nome do banco de dados

// Conectar ao banco de dados
$conn = new mysqli($servername, $username, $password, $dbname);

// Verificar a conexão
if ($conn->connect_error) {
    die("Falha na conexão com o banco de dados: " . $conn->connect_error);
}

// Definir o conjunto de caracteres para utf8
$conn->set_charset("utf8");

?>
