<?php
$servername = "localhost"; // ou o endereço do seu servidor
$username = "root"; // seu usuário do MySQL
$password = ""; // sua senha do MySQL
$dbname = "Apontamentos_Amonia"; // nome do banco de dados

// Criar conexão
$conn = new mysqli($servername, $username, $password, $dbname);

// Verificar conexão
if ($conn->connect_error) {
    die("Conexão falhou: " . $conn->connect_error);
}
echo "Conectado com sucesso";

// Exemplo de inserção de dados
$horario = date('Y-m-d H:i:s'); // Data atual
$pd1 = 1.2; // Exemplo de valor para pd1
$pd2 = 1.3; // Exemplo de valor para pd2
$pd3 = 1.1; // Exemplo de valor para pd3
$pd4 = 1.4; // Exemplo de valor para pd4
$pd5 = 1.5; // Exemplo de valor para pd5
// Continue para pd6 até pd57 conforme necessário
$estacao = "Estacao1"; // Exemplo de estação

$sql = "INSERT INTO DecAmoniaVAR (horario, pd1, pd2, pd3, pd4, pd5, estacao) VALUES ('$horario', $pd1, $pd2, $pd3, $pd4, $pd5, '$estacao')";

if ($conn->query($sql) === TRUE) {
    echo "Novo registro criado com sucesso";
} else {
    echo "Erro: " . $sql . "<br>" . $conn->error;
}

$conn->close();
?>