//Só libera os botoes do form info_req ao selecionar a informação requerida
$(function(){
	$('#btnAlteraInfoReq').attr('disabled', 'disabled');
	$('#btnExcluiInfoReq').attr('disabled', 'disabled');
	$('#btnInfoReqVinculaQuestao').attr('disabled', 'disabled');
	$('#info_req').change(function(){
		if($('#info_req').val() != ""){
		   $('#btnAlteraInfoReq').removeAttr('disabled');
		   $('#btnExcluiInfoReq').removeAttr('disabled');
		   $('#btnInfoReqVinculaQuestao').removeAttr('disabled');
		}
		else{
			$('#btnAlteraInfoReq').attr('disabled', 'disabled');
			$('#btnExcluiInfoReq').attr('disabled', 'disabled');
			$('#btnInfoReqVinculaQuestao').attr('disabled', 'disabled');
		}
	});
});

//Informa os valores dos campos ao modal alterar info_req
$('#modalAlterarInfoReq').on('show.bs.modal', function (event) {
	var array_info_req = $('#info_req').val().split('|');
	var id_info_req = array_info_req[0]
	var info_req = array_info_req[1]
	var modal = $(this)

	modal.find('#id_info_req').val(id_info_req)
	modal.find('#info_req').val(info_req)
	modal.find('#info_req_atual').val(info_req)
})

//Informa os valores dos campos ao modal InfoReqVincularQuestao
$('#modalInfoReqVincularQuestao').on('show.bs.modal', function (event) {
	var array_info_req = $('#info_req').val().split('|');
	var id_info_req = array_info_req[0];
	var info_req = array_info_req[1];
	var modal = $(this);

	modal.find('#id_info_req').val(id_info_req);
	modal.find('#info_req').val(info_req);	
	
	$.post('controllers/admin/info_req/listar_questao_vinc.inc.php',{id_info_req:id_info_req},function (res) {
	   	$('#info_req_listar_questao').html(res);//insere a lista de questoes no modal
   	})	
})

//imprimir lista info_req
document.getElementById('btnPrintInfoReq').onclick = function() {
	var conteudo = document.getElementById('area_printInfoReq').innerHTML;
	var tela_impressao = window.open('','','width=0, height=0, top=50, left=50');
	tela_impressao.document.write(conteudo);
	tela_impressao.window.print();
	tela_impressao.window.close();
};


