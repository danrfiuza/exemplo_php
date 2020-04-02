function alterarRegistro(id) {

    fetch(`http://localhost/exemplo_php/controller.php?request=buscar&id=${id}`)
    .then(function(response) {
        response.json().then(function(jogador){
            console.log(jogador.nome);
            document.getElementById('nome').value = jogador.nome;
            document.getElementById('id').value = jogador.id;
        });
    });

}

function deletarRegistro(id) {
    let confirmed = confirm('Tem certeza que deseja excluir este jogador?');

    if(confirmed === true) {
        window.location = `http://localhost/exemplo_php/controller.php?request=deletar&id=${id}`
    }else {
        alert("Operação cancelada.");
    }
}