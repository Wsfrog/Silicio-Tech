function marcarEntregue(encomendaId) {
    fetch(`marcar_entregue.php?id=${encomendaId}`, { method: 'POST' })
        .then(response => response.text())
        .then(data => {
            exibirMensagem(data); // Chama a função para exibir a mensagem
        })
        .catch(error => console.error('Erro:', error));
}

// Função para exibir mensagem na tela
function exibirMensagem(mensagem) {
    const messageBox = document.getElementById('message-box');
    messageBox.innerText = mensagem;
    messageBox.style.display = 'block';

    // Remove a mensagem após 3 segundos
    setTimeout(() => {
        messageBox.style.display = 'none';
    }, 3000);
}
