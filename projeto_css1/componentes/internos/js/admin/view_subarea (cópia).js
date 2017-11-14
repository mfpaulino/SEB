/** inicio rotinas para alterar subareas**/

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
	var id_subarea = array_subarea[0];
	var subarea = array_subarea[1];
	var area = array_subarea[2];
	var modal = $(this);

	modal.find('#area_envia').val(area)
	modal.find('#area_exibe').val(area)
	modal.find('#id_subarea').val(id_subarea)
	modal.find('#subarea').val(subarea)
	modal.find('#subarea_atual').val(subarea)
})
/** fim rotinas alterar subareas **/

/** inicio rotinas para listar subareas **/

//Só libera o botao enviar ao selecionar a area
$(function(){
	$('#btnExibeSubarea').attr('disabled', 'disabled');
	$('#lista_area').change(function(){
		if($('#lista_area').val() != ""){
		   $('#btnExibeSubarea').removeAttr('disabled');
		}
		else{
			$('#btnExibeSubarea').attr('disabled', 'disabled');
		}
	});
});
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

//Informa os valores dos campos ao modal alterar subarea
$('#modalExibirSubarea').on('show.bs.modal', function (event) {

	var array_area = $('#lista_area').val().split('|');
	var id_area = array_area[0];
	var area = array_area[1];	

	//envia o valor da area, cria a lista de subareas baseada na area selecionada e insere no modal
   	//$.ajax({
   		//url: 'controllers/admin/subarea/subarea_listar.inc.php',
   		//type: "POST",
   		//data: {
   			//id_area: id_area,
   			//area: area
   		//},
   		//success: function (res) {
	   		//$('#lista_subarea').html(res);//insere a lista de subareas no modal
   		//}
	//});

})

//imprimir lista area
document.getElementById('btnPrintSubarea').onclick = function() {
	var conteudo = document.getElementById('area_printSubarea').innerHTML;
	var	tela_impressao = window.open('','','width=0, height=0, top=50, left=50');
	tela_impressao.document.write(conteudo);
	tela_impressao.window.print();
	tela_impressao.window.close();
};
/** fim rotinas listar subareas **/

