$(document).ready(function(){

	// Requisicao AJAX
	var requisicao = function(){
		$.ajax({
			url: "status_menu_top.inc.php"
		}).done(function(resultado){
			// Exibe o resultado no elemento com ID status_sessao
			$("#menu_top").html(resultado);
		});
	};

	// Executa a requisicao com intervalo de 999ms = 0,999s
	setInterval(requisicao, 5000);

});