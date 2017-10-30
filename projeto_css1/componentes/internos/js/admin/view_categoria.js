//Só libera os botoes do form categoria ao selecionar a categoria
$(function(){
	$('#btnAlteraCategoria').attr('disabled', 'disabled');
	$('#btnExcluiCategoria').attr('disabled', 'disabled');
	$('#categoria').change(function(){
		if($('#categoria').val() != ""){
		   $('#btnAlteraCategoria').removeAttr('disabled');
		   $('#btnExcluiCategoria').removeAttr('disabled');
		}
		else{
			$('#btnAlteraCategoria').attr('disabled', 'disabled');
			$('#btnExcluiCategoria').attr('disabled', 'disabled');
		}
	});
});

//Informa os valores dos campos ao modal alterar categoria
$('#modalAlterarCategoria').on('show.bs.modal', function (event) {
	var array_categoria = $('#categoria').val().split('|');
	var id_categoria = array_categoria[0]
	var categoria = array_categoria[1]
	var localidade = array_categoria[2]
	var modal = $(this)

	modal.find('#id_categoria').val(id_categoria)
	modal.find('#categoria').val(categoria)
	modal.find('#categoria_atual').val(categoria)
	modal.find('#localidade').val(localidade)
	modal.find('#localidade_atual').val(localidade)
})

//imprimir lista categoria
document.getElementById('btnPrintCategoria').onclick = function() {
	var conteudo = document.getElementById('area_printCategoria').innerHTML;
	var	tela_impressao = window.open('','','width=0, height=0, top=50, left=50');
	tela_impressao.document.write(conteudo);
	tela_impressao.window.print();
	tela_impressao.window.close();
};
