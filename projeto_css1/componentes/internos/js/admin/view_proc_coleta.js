//Só libera os botoes do form proc_coleta ao selecionar o procedimento de coleta de dados
$(function(){
	$('#btnAlteraProcColeta').attr('disabled', 'disabled');
	$('#btnExcluiProcColeta').attr('disabled', 'disabled');
	$('#btnProcColetaVinculaQuestao').attr('disabled', 'disabled');
	$('#proc_coleta').change(function(){
		if($('#proc_coleta').val() != ""){
		   $('#btnAlteraProcColeta').removeAttr('disabled');
		   $('#btnExcluiProcColeta').removeAttr('disabled');
		   $('#btnProcColetaVinculaQuestao').removeAttr('disabled');
		}
		else{
			$('#btnAlteraProcColetao').attr('disabled', 'disabled');
			$('#btnExcluiProcColeta').attr('disabled', 'disabled');
			$('#btnProcColetaVinculaQuestao').attr('disabled', 'disabled');
		}
	});
});

//Informa os valores dos campos ao modal alterar proc_coleta
$('#modalAlterarProcColeta').on('show.bs.modal', function (event) {
	var array_proc_coleta = $('#proc_coleta').val().split('|');
	var id_proc_coleta = array_proc_coleta[0]
	var proc_coleta = array_proc_coleta[1]
	var modal = $(this)

	modal.find('#id_proc_coleta').val(id_proc_coleta)
	modal.find('#proc_coleta').val(proc_coleta)
	modal.find('#proc_coleta_atual').val(proc_coleta)
})

//Informa os valores dos campos ao modal ProcColetaVincularQuestao
$('#modalProcColetaVincularQuestao').on('show.bs.modal', function (event) {
	var array_proc_coleta = $('#proc_coleta').val().split('|');
	var id_proc_coleta = array_proc_coleta[0];
	var proc_coleta = array_proc_coleta[1];
	var modal = $(this);

	modal.find('#id_proc_coleta').val(id_proc_coleta);
	modal.find('#proc_coleta').val(proc_coleta);	
	
	$.post('controllers/admin/proc_coleta/listar_questao_vinc.inc.php',{id_proc_coleta:id_proc_coleta},function (res) {
	   	$('#proc_coleta_listar_questao').html(res);//insere a lista de questoes no modal
   	})	
})

//imprimir lista poss_achado
document.getElementById('btnPrintProcColeta').onclick = function() {
	var conteudo = document.getElementById('area_printProcColeta').innerHTML;
	var tela_impressao = window.open('','','width=0, height=0, top=50, left=50');
	tela_impressao.document.write(conteudo);
	tela_impressao.window.print();
	tela_impressao.window.close();
};


