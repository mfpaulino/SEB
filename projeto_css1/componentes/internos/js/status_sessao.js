$(document).ready(function(){

	// Requisicao AJAX
	var requisicao = function(){
		$.ajax({
			url: "status_sessao.inc.php"
		}).done(function(resultado){
			// Exibe o resultado no elemento com ID status_sessao
			$("#status_sessao").html(resultado);
		});
	};

	// Executa a requisicao com intervalo de 999ms = 0,999s
	setInterval(requisicao, 999);

});
