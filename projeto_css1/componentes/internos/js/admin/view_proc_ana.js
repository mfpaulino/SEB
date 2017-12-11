//Só libera os botoes do form proc_ana ao selecionar o procedimento de analise de dados
$(function(){
	$('#btnAlteraProcAna').attr('disabled', 'disabled');
	$('#btnExcluiProcAna').attr('disabled', 'disabled');
	$('#btnProcAnaVinculaQuestao').attr('disabled', 'disabled');
	$('#proc_ana').change(function(){
		if($('#proc_ana').val() != ""){
		   $('#btnAlteraProcAna').removeAttr('disabled');
		   $('#btnExcluiProcAna').removeAttr('disabled');
		   $('#btnProcAnaVinculaQuestao').removeAttr('disabled');
		}
		else{
			$('#btnAlteraProcAnao').attr('disabled', 'disabled');
			$('#btnExcluiProcAna').attr('disabled', 'disabled');
			$('#btnProcAnaVinculaQuestao').attr('disabled', 'disabled');
		}
	});
});

//Informa os valores dos campos ao modal alterar proc_ana
$('#modalAlterarProcAna').on('show.bs.modal', function (event) {
	var array_proc_ana = $('#proc_ana').val().split('|');
	var id_proc_ana = array_proc_ana[0]
	var proc_ana = array_proc_ana[1]
	var modal = $(this)

	modal.find('#id_proc_ana').val(id_proc_ana)
	modal.find('#proc_ana').val(proc_ana)
	modal.find('#proc_ana_atual').val(proc_ana)
})

//Informa os valores dos campos ao modal ProcAnaVincularQuestao
$('#modalProcAnaVincularQuestao').on('show.bs.modal', function (event) {
	var array_proc_ana = $('#proc_ana').val().split('|');
	var id_proc_ana = array_proc_ana[0];
	var proc_ana = array_proc_ana[1];
	var modal = $(this);

	modal.find('#id_proc_ana').val(id_proc_ana);
	modal.find('#proc_ana').val(proc_ana);	
	
	$.post('controllers/admin/proc_ana/listar_questao_vinc.inc.php',{id_proc_ana:id_proc_ana},function (res) {
	   	$('#proc_ana_listar_questao').html(res);//insere a lista de questoes no modal
   	})	
})

//imprimir lista poss_achado
document.getElementById('btnPrintProcAna').onclick = function() {
	var conteudo = document.getElementById('area_printProcAna').innerHTML;
	var tela_impressao = window.open('','','width=0, height=0, top=50, left=50');
	tela_impressao.document.write(conteudo);
	tela_impressao.window.print();
	tela_impressao.window.close();
};


