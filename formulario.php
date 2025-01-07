<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Adicionar Dados de Amônia</title>
</head>
<body>
    <h1>Adicionar Dados de Amônia</h1>
    <form action="inserir.php" method="post">
        <label for="concentracao">Concentração:</label>
        <input type="number" step="0.01" name="concentracao" required><br><br>

        <label for="observacoes">Observações:</label>
        <textarea name="observacoes" required></textarea><br><br>

        <input type="submit" value="Adicionar">
    </form>
</body>
</html>