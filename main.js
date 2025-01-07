function fetchAmmoniaData(event) {
    // Previne o envio do formulário
    event.preventDefault();

    // Obtém a data, o horário e o valor do PD do input
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

    // Envia a requisição com a data, o horário (se fornecido) e o valor do PD
    let params = "data=" + encodeURIComponent(data);
    if (horario) {
        params += "&horario=" + encodeURIComponent(horario);
    }
    if (pd) {
        params += "&pd=" + encodeURIComponent(pd); // Adiciona o PD aos parâmetros
    }
    xhr.send(params);
}