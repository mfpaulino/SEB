$(document).ready(function(){

	// Requisicao AJAX
	var requisicao = function(){
		$.ajax({
			url: "status_sessao.inc.php"
		}).done(function(resultado){
			// Exibe o resultado no elemento com ID contador
			$("#status_sessao").html(resultado);
		});
	};

	// Executa a requisicao com intervalo de 100ms
	setInterval(requisicao, 60000);

});