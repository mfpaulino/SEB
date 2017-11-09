//Só libera os botoes do form area ao selecionar a area
$(function(){
	$('#btnAlteraArea').attr('disabled', 'disabled');
	$('#btnVinculaArea').attr('disabled', 'disabled');
	$('#btnExcluiArea').attr('disabled', 'disabled');
	$('#area').change(function(){
		if($('#area').val() != ""){
		   $('#btnAlteraArea').removeAttr('disabled');
		   $('#btnVinculaArea').removeAttr('disabled');
		   $('#btnExcluiArea').removeAttr('disabled');
		}
		else{
			$('#btnAlteraArea').attr('disabled', 'disabled');
			$('#btnVinculaArea').attr('disabled', 'disabled');
			$('#btnExcluiArea').attr('disabled', 'disabled');
		}
	});
});

//Informa os valores dos campos ao modal alterar área
$('#modalAlterarArea').on('show.bs.modal', function (event) {
	var array_area = $('#area').val().split('|');
	var id_area = array_area[0]
	var area = array_area[1]
	var modal = $(this)

	modal.find('#id_area').val(id_area)
	modal.find('#area').val(area)
	modal.find('#area_atual').val(area)
})

//Informa os valores dos campos ao modal vincular área
$('#modalVincularArea').on('show.bs.modal', function (event) {
	var array_area = $('#area').val().split('|');
	var id_area = array_area[0];
	var area = array_area[1];
	var modal = $(this);

	modal.find('#id_area').val(id_area);
	modal.find('#area').val(area);
		
	
	//$.ajax({
		//url: 'controllers/admin/area/listar_subarea_vinc.inc.php', 
		//data:{'id_area': 'zzz'},
		//type: 'POST',
		//success: function(data){
		       // $('#lista_subarea').html(data);
		//}
	//});
	$.post("controllers/admin/area/listar_subarea_vinc.inc.php", {id_area: 'id_area'}, function(res){
   	/*a div mostrar que estava com display none agora será exibida, pois nela estará os dados do dados.php*/
  	 //$("#mostrar").fadeIn(2000).html(mostrar)       

       });
	
})

$('#subarea').multiselect({
	numberDisplayed: 3,
	nonSelectedText: 'Nenhuma selecionada',
	nSelectedText: 'selecionadas',
	allSelectedText: 'Todas foram selecionadas',
	selectAllText: ' Selecionar todas',
	buttonWidth: '100%',
	inheritClass: true,
	includeSelectAllOption: true,
	enableFiltering: true,
	selectAllJustVisible: true //ao clicar em todos, seleciona todos os visiveis pelo filtro. Se false, seleciona todos independente do filtro
});

//imprimir lista area
document.getElementById('btnPrintArea').onclick = function() {
	var conteudo = document.getElementById('area_printArea').innerHTML;
	var	tela_impressao = window.open('','','width=0, height=0, top=50, left=50');
	tela_impressao.document.write(conteudo);
	tela_impressao.window.print();
	tela_impressao.window.close();
};

