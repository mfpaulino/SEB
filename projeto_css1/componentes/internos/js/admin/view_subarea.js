//Só libera os botoes do form subarea ao selecionar a subarea
$(function(){
	$('#btnAlteraSubarea').attr('disabled', 'disabled');
	$('#btnExcluiSubarea').attr('disabled', 'disabled');
	$('#btnVinculaSubarea').attr('disabled', 'disabled');
	$('#subarea').change(function(){
		if($('#subarea').val() != ""){
		   $('#btnAlteraSubarea').removeAttr('disabled');
		   $('#btnExcluiSubarea').removeAttr('disabled');
		   $('#btnVinculaSubarea').removeAttr('disabled');
		}
		else{
			$('#btnAlteraSubarea').attr('disabled', 'disabled');
			$('#btnExcluiSubarea').attr('disabled', 'disabled');
			$('#btnVinculaSubarea').attr('disabled', 'disabled');
		}
	});
});

//Informa os valores dos campos ao modal alterar diária
$('#modalAlterarSubarea').on('show.bs.modal', function (event) {

	var array_subarea = $('#subarea').val().split('|');
	var id_subarea = array_subarea[0];
	var subarea = array_subarea[1];
	var modal = $(this);
	
	modal.find('#id_subarea').val(id_subarea)
	modal.find('#subarea').val(subarea)
	modal.find('#subarea_atual').val(subarea)
})

//Informa os valores dos campos ao modal vincular área
$('#modalVincularSubarea').on('show.bs.modal', function (event) {
	var array_subarea = $('#subarea').val().split('|');
	var id_subarea = array_subarea[0];
	var subarea = array_subarea[1];
	var modal = $(this);

	modal.find('#id_subarea').val(id_subarea);
	modal.find('#subarea').val(subarea);	
	
	$.post('controllers/admin/subarea/listar_area_vinc.inc.php',{id_subarea:id_subarea},function (res) {
	   	$('#listar_area').html(res);//insere a lista de subareas no modal
   	})	
})

//imprimir lista area
document.getElementById('btnPrintSubarea').onclick = function() {
	var conteudo = document.getElementById('area_printSubarea').innerHTML;
	var	tela_impressao = window.open('','','width=0, height=0, top=50, left=50');
	tela_impressao.document.write(conteudo);
	tela_impressao.window.print();
	tela_impressao.window.close();
};

