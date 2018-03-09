//validação forms cadastrar e alterar
$(document).ready(function() {
	$('#form_subarea_cadastrar').bootstrapValidator({
		feedbackIcons: {
			valid: 'glyphicon glyphicon-ok',
			invalid: 'glyphicon glyphicon-remove',
			validating: 'glyphicon glyphicon-refresh'
		},
		fields: {
			area: {
				validators: {
					notEmpty: {
						message:'Preenchimento obrigatório'
					}
				}
			},
			subarea: {
				validators: {
					notEmpty: {
						message:'Preenchimento obrigatório'
					}
				}
			}
		}
	})
	$('#form_subarea_alterar').bootstrapValidator({
		feedbackIcons: {
			valid: 'glyphicon glyphicon-ok',
			invalid: 'glyphicon glyphicon-remove',
			validating: 'glyphicon glyphicon-refresh'
		},
		fields: {
			area: {
				validators: {
					notEmpty: {
						message:'Preenchimento obrigatório'
					}
				}
			},
			subarea: {
				validators: {
					notEmpty: {
						message:'Preenchimento obrigatório'
					}
				}
			}
		}
	})
});

//Só libera os botoes do form subarea ao selecionar a subarea
$(function(){
	$('#btnAlteraSubarea').attr('disabled', 'disabled');
	$('#btnExcluiSubarea').attr('disabled', 'disabled');
	$('#btnSubareaVinculaArea').attr('disabled', 'disabled');
	$('#btnSubareaVinculaQuestao').attr('disabled', 'disabled');
	$('#subarea').change(function(){
		if($('#subarea').val() != ""){
		   $('#btnAlteraSubarea').removeAttr('disabled');
		   $('#btnExcluiSubarea').removeAttr('disabled');
		   $('#btnSubareaVinculaArea').removeAttr('disabled');
		   $('#btnSubareaVinculaQuestao').removeAttr('disabled');
		}
		else{
			$('#btnAlteraSubarea').attr('disabled', 'disabled');
			$('#btnExcluiSubarea').attr('disabled', 'disabled');
			$('#btnSubareaVinculaArea').attr('disabled', 'disabled');
			$('#btnSubareaVinculaQuestao').attr('disabled', 'disabled');
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

//Informa os valores dos campos ao modal SubareaVincularArea
$('#modalSubareaVincularArea').on('show.bs.modal', function (event) {
	var array_subarea = $('#subarea').val().split('|');
	var id_subarea = array_subarea[0];
	var subarea = array_subarea[1];
	var modal = $(this);

	modal.find('#id_subarea').val(id_subarea);
	modal.find('#subarea').val(subarea);	
	
	$.post('controllers/admin/subarea/listar_area_vinc.inc.php',{id_subarea:id_subarea},function (res) {
	   	$('#subarea_listar_area').html(res);//insere a lista de areas no modal
   	})	
})

//Informa os valores dos campos ao modal SubareaVincularQuestao
$('#modalSubareaVincularQuestao').on('show.bs.modal', function (event) {
	var array_subarea = $('#subarea').val().split('|');
	var id_subarea = array_subarea[0];
	var subarea = array_subarea[1];
	var modal = $(this);

	modal.find('#id_subarea').val(id_subarea);
	modal.find('#subarea').val(subarea);	
	
	$.post('controllers/admin/subarea/listar_questao_vinc.inc.php',{id_subarea:id_subarea},function (res) {
	   	$('#subarea_listar_questao').html(res);//insere a lista de questoes no modal
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

