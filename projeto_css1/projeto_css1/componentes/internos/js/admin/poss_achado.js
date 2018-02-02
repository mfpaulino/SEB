//validação fors cadastrar e alterar
$(document).ready(function() {
	$('#form_poss_achados_cadastrar').bootstrapValidator({
		feedbackIcons: {
			valid: 'glyphicon glyphicon-ok',
			invalid: 'glyphicon glyphicon-remove',
			validating: 'glyphicon glyphicon-refresh'
		},
		fields: {
			poss_achados: {
				validators: {
					notEmpty: {
						message:'Preenchimento obrigatório'
					}
				}
			}
		}
	})
	$('#form_poss_achados_alterar').bootstrapValidator({
		feedbackIcons: {
			valid: 'glyphicon glyphicon-ok',
			invalid: 'glyphicon glyphicon-remove',
			validating: 'glyphicon glyphicon-refresh'
		},
		fields: {
			poss_achados: {
				validators: {
					notEmpty: {
						message:'Preenchimento obrigatório'
					}
				}
			}
		}
	})
});

//Só libera os botoes do form poss_achados ao selecionar o possivel achado
$(function(){
	$('#btnAlteraPossAchado').attr('disabled', 'disabled');
	$('#btnExcluiPossAchado').attr('disabled', 'disabled');
	$('#btnPossAchadoVinculaQuestao').attr('disabled', 'disabled');
	$('#poss_achado').change(function(){
		if($('#poss_achado').val() != ""){
		   $('#btnAlteraPossAchado').removeAttr('disabled');
		   $('#btnExcluiPossAchado').removeAttr('disabled');
		   $('#btnPossAchadoVinculaQuestao').removeAttr('disabled');
		}
		else{
			$('#btnAlteraPossAchado').attr('disabled', 'disabled');
			$('#btnExcluiPossAchado').attr('disabled', 'disabled');
			$('#btnPossAchadoVinculaQuestao').attr('disabled', 'disabled');
		}
	});
});

//Informa os valores dos campos ao modal alterar poss_achado
$('#modalAlterarPossAchado').on('show.bs.modal', function (event) {
	var array_poss_achado = $('#poss_achado').val().split('|');
	var id_poss_achado = array_poss_achado[0]
	var poss_achado = array_poss_achado[1]
	var modal = $(this)

	modal.find('#id_poss_achado').val(id_poss_achado)
	modal.find('#poss_achado').val(poss_achado)
	modal.find('#poss_achado_atual').val(poss_achado)
})

//Informa os valores dos campos ao modal PossAchadoVincularQuestao
$('#modalPossAchadoVincularQuestao').on('show.bs.modal', function (event) {
	var array_poss_achado = $('#poss_achado').val().split('|');
	var id_poss_achado = array_poss_achado[0];
	var poss_achado = array_poss_achado[1];
	var modal = $(this);

	modal.find('#id_poss_achado').val(id_poss_achado);
	modal.find('#poss_achado').val(poss_achado);	
	
	$.post('controllers/admin/poss_achado/listar_questao_vinc.inc.php',{id_poss_achado:id_poss_achado},function (res) {
	   	$('#poss_achado_listar_questao').html(res);//insere a lista de questoes no modal
   	})	
})

//imprimir lista poss_achado
document.getElementById('btnPrintPossAchado').onclick = function() {
	var conteudo = document.getElementById('area_printPossAchado').innerHTML;
	var tela_impressao = window.open('','','width=0, height=0, top=50, left=50');
	tela_impressao.document.write(conteudo);
	tela_impressao.window.print();
	tela_impressao.window.close();
};
