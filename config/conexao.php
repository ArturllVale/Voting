<?php
// Configurações para conexão com o banco de dados
$servername =   "108.181.92.76";    // Nome do servidor
$username =     "voting";           // Nome de usuário do banco de dados
$password =     "voting32291143";   // Senha do banco de dados
$dbname =       "voting";           // Nome do banco de dados

// Conectar ao banco de dados
$conn = new mysqli($servername, $username, $password, $dbname);

// Verificar a conexão
if ($conn->connect_error) {
    die("Falha na conexão com o banco de dados: " . $conn->connect_error);
}

// Definir o conjunto de caracteres para utf8
$conn->set_charset("utf8");

?>
