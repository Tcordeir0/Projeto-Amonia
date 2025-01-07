<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" href="./imagens/icon.ico">
    <link rel="stylesheet" href="style.css">
    <title>Consulta de Amônia</title>
    <script>
        function fetchAmmoniaData(event) {
            // Previne o envio do formulário
            event.preventDefault();

            // Obtém a data e o horário do input
            let data = document.getElementById('dataInput').value;
            let horario = document.getElementById('horarioInput').value;
            let pd = document.getElementById('pdInput').value; // Novo campo para PD

            // Valida se a data foi inserida
            if (!data) {
                document.getElementById('resultado').innerHTML = "Por favor, selecione uma data.";
                return;
            }

            // Cria uma requisição AJAX
            const xhr = new XMLHttpRequest();
            xhr.open("POST", "consultar.php", true);
            xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");

            // Define o que acontece quando a resposta é recebida
            xhr.onload = function() {
                if (xhr.status === 200) {
                    // Atualiza o conteúdo da div de resultado com a resposta
                    document.getElementById('resultado').innerHTML = xhr.responseText;
                } else {
                    document.getElementById('resultado').innerHTML = "Dados não existentes.";
                }
            };

            // Define o que acontece em caso de erro de rede
            xhr.onerror = function() {
                document.getElementById('resultado').innerHTML = "Erro de rede. Tente novamente.";
            };

            // Envia a requisição com a data e o horário (se fornecido)
            let params = "data=" + encodeURIComponent(data);
            if (horario) {
                params += "&horario=" + encodeURIComponent(horario);
            }
            if (pd) {
                params += "&pd=" + encodeURIComponent(pd); // Adiciona o PD aos parâmetros
            }
            xhr.send(params);
        }
    </script>
</head>
<body>
    <a href="index.php"> <!-- Link para a página inicial -->
        <img src="./imagens/logo.png" alt="Imagem da Gelnex">
    </a>
    <div class="container">
        <h1>Consulta de Amônia</h1>
        <form>
            <label for="data">Selecione uma data:</label>
            <input type="date" id="dataInput" class="date-input" required>
            <input type="time" id="horarioInput" class="time-input">
            <select id="pdInput" name="pd" class="pd-input">
    <option value="">Selecione um PD</option>
    <option value="all">Ver Todos</option> <!-- Nova opção para ver todos -->
    <?php for ($i = 1; $i <= 57; $i++): ?>
        <option value="pd<?php echo $i; ?>">pd<?php echo $i; ?></option>
    <?php endfor; ?>
</select>
            <button id="consultarBtn" class="btn" onclick="fetchAmmoniaData(event)">Consultar</button>
        </form>
        <div id="resultado" class="resultado"></div>
    </div>
</body>
</html>