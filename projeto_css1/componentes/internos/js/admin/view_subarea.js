//script para receber a selecao da Área e atualizar o 2º select(Subárea)
$(document).ready(function(){
	$("select[name=area]").change(function(){
		$("select[name=subarea]").html('<option value="">Carregando...</option>');
		$.post("listas/admin/select_subarea.inc.php", {area:$(this).val()},function(valor){$("select[name=subarea]").html(valor);})
	})
})

//Só libera os botoes do form area ao selecionar a area
$(function(){
	$('#btnAlteraSubarea').attr('disabled', 'disabled');
	$('#btnExcluiSubarea').attr('disabled', 'disabled');
	$('#subarea').change(function(){
		if($('#subarea').val() != ""){
		   $('#btnAlteraSubarea').removeAttr('disabled');
		   $('#btnExcluiSubarea').removeAttr('disabled');
		}
		else{
			$('#btnAlteraSubarea').attr('disabled', 'disabled');
			$('#btnExcluiSubarea').attr('disabled', 'disabled');
		}
	});
});

//Informa os valores dos campos ao modal alterar diária
$('#modalAlterarSubarea').on('show.bs.modal', function (event) {
	var array_subarea = $('#subarea').val().split('|');
	var id_subarea = array_subarea[0]
	var subarea = array_subarea[1]
	var modal = $(this)

	modal.find('#id_subarea').val(id_subarea)
	modal.find('#subarea').val(subarea)
	modal.find('#subarea_atual').val(area)
})

//imprimir lista area
document.getElementById('btnPrintSubarea').onclick = function() {
	var conteudo = document.getElementById('area_printSubarea').innerHTML;
	var	tela_impressao = window.open('','','width=0, height=0, top=50, left=50');
	tela_impressao.document.write(conteudo);
	tela_impressao.window.print();
	tela_impressao.window.close();
};

