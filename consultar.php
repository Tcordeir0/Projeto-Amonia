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

// Definir a codificação para utf8mb4
$conn->set_charset("utf8mb4");

// Obter a data, o horário e o valor do PD do POST
$data = $_POST['data'];
$horario = isset($_POST['horario']) ? $_POST['horario'] : null;
$pd = isset($_POST['pd']) ? $_POST['pd'] : null; // Novo parâmetro para PD

// Consultar dados com base na data e horário
$sql = "SELECT * FROM DecAmoniaVAR WHERE DATE(horario) = ?";
$params = [$data];

if ($horario) {
    $sql .= " AND TIME(horario) = ?";
    $params[] = $horario;
}

// Se o PD não for "all", adiciona a condição para verificar se a coluna do PD não é nula
if ($pd && $pd !== "all") {
    $sql .= " AND $pd IS NOT NULL"; // Verifica se a coluna do PD não é nula
}

// Preparar a consulta
$stmt = $conn->prepare($sql);

// Verificar se a preparação da consulta foi bem-sucedida
if ($stmt === false) {
    die("Erro na preparação da consulta: " . $conn->error);
}

// Bind dos parâmetros
if ($horario) {
    $stmt->bind_param("ss", ...$params); // Se ambos, data e horário, estão presentes
} else {
    $stmt->bind_param("s", $params[0]); // Apenas data
}

// Executar a consulta
$stmt->execute();
$result = $stmt->get_result();

// Verificar se há resultados
if ($result->num_rows > 0) {
    // Exibir os dados
    while ($row = $result->fetch_assoc()) {
        echo "<p><strong>Horário:</strong> " . $row['horario'] . " - ";
        
        // Exibir o valor do PD selecionado
        if ($pd === "all") {
            // Se "Ver Todos" foi selecionado, exibe todos os PDs
            for ($i = 1; $i <= 57; $i++) {
                $pd_key = 'pd' . $i; // Cria a chave pd1, pd2, ..., pd57
                echo "<span class='pd-value'>" . $pd_key . ": " . $row[$pd_key] . "</span> ";
            }
        } else {
            // Se um PD específico foi selecionado
            echo "<span class='pd-value'>" . $pd . ": " . $row[$pd] . "</span>";
        }
        
        echo "</p>";
    }
} else {
    echo "Nenhum dado encontrado para a data selecionada" . ($horario ? " e horário selecionado." : "") . ($pd ? " e valor de PD selecionado." : "");
}

$stmt->close();
$conn->close();
?>