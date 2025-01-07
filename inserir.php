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

// Obter dados do formulário
$horario = date('Y-m-d H:i:s'); // Data e hora atual
$pd1 = $_POST['pd1']; // Exemplo de valor para pd1
$pd2 = $_POST['pd2']; // Exemplo de valor para pd2
$pd3 = $_POST['pd3']; // Exemplo de valor para pd3
$pd4 = $_POST['pd4']; // Exemplo de valor para pd4
$pd5 = $_POST['pd5']; // Exemplo de valor para pd5
$estacao = $_POST['estacao']; // Exemplo de estação

// Inserir dados na tabela
$sql = "INSERT INTO DecAmoniaVAR (horario, pd1, pd2, pd3, pd4, pd5, estacao) VALUES ('$horario', $pd1, $pd2, $pd3, $pd4, $pd5, '$estacao')";

if ($conn->query($sql) === TRUE) {
    echo "Novo registro criado com sucesso";
} else {
    echo "Erro: " . $sql . "<br>" . $conn->error;
}

// Consultar dados para exibir
$sql = "SELECT * FROM DecAmoniaVAR WHERE DATE(horario) = CURDATE()"; // Exemplo: consulta para o dia atual
$result = $conn->query($sql);

// Verificar se há resultados
if ($result->num_rows > 0) {
    // Exibir os dados
    while ($row = $result->fetch_assoc()) {
        echo "<p>Horário: " . $row['horario'] . " - pd1: " . $row['pd1'] . " - pd2: " . $row['pd2'] . " - pd3: " . $row['pd3'] . " - Estação: " . $row['estacao'] . "</p>";
    }
} else {
    echo "Nenhum dado encontrado para a data selecionada.";
}

$conn->close();
?>