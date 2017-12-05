//Só libera os botoes do form questao ao selecionar a questao
$(function(){
	$('#btnAlteraQuestao').attr('disabled', 'disabled');
	$('#btnExcluiQuestao').attr('disabled', 'disabled');
	$('#btnQuestaoVinculaSubarea').attr('disabled', 'disabled');
	$('#questao').change(function(){
		if($('#questao').val() != ""){
		   $('#btnAlteraQuestao').removeAttr('disabled');
		   $('#btnExcluiQuestao').removeAttr('disabled');
		   $('#btnQuestaoVinculaSubarea').removeAttr('disabled');
		}
		else{
			$('#btnAlteraQuestao').attr('disabled', 'disabled');
			$('#btnExcluiQuestao').attr('disabled', 'disabled');
			$('#btnQuestaoVinculaSubarea').attr('disabled', 'disabled');
		}
	});
});

//Informa os valores dos campos ao modal alterar questao
$('#modalAlterarQuestao').on('show.bs.modal', function (event) {
	var array_questao = $('#questao').val().split('|');
	var id_questao = array_questao[0]
	var questao = array_questao[1]
	var modal = $(this)

	modal.find('#id_questao').val(id_questao)
	modal.find('#questao').val(questao)
	modal.find('#questao_atual').val(questao)
})

//Informa os valores dos campos ao modal QuestaoVincularSubarea
$('#modalQuestaoVincularSubarea').on('show.bs.modal', function (event) {
	var array_questao = $('#questao').val().split('|');
	var id_questao = array_questao[0];
	var questao = array_questao[1];
	var modal = $(this);

	modal.find('#id_questao').val(id_questao);
	modal.find('#questao').val(questao);	
	
	$.post('controllers/admin/questao/listar_subarea_vinc.inc.php',{id_questao:id_questao},function (res) {
	   	$('#questao_listar_subarea').html(res);//insere a lista de subareas no modal
   	})	
})

//imprimir lista questao
document.getElementById('btnPrintQuestao').onclick = function() {
	var conteudo = document.getElementById('area_printQuestao').innerHTML;
	var tela_impressao = window.open('','','width=0, height=0, top=50, left=50');
	tela_impressao.document.write(conteudo);
	tela_impressao.window.print();
	tela_impressao.window.close();
};


