//validação dos form cadastrar e alterar
$(document).ready(function() {
	$('#form_tipo_evento_cadastrar').bootstrapValidator({
		feedbackIcons: {
			valid: 'glyphicon glyphicon-ok',
			invalid: 'glyphicon glyphicon-remove',
			validating: 'glyphicon glyphicon-refresh'
		},
		fields: {
			tipo_evento: {
				validators: {
					notEmpty: {
						message:'Preenchimento obrigatório'
					}
				}
			}
		}
	})
	$('#form_tipo_evento_alterar').bootstrapValidator({
		feedbackIcons: {
			valid: 'glyphicon glyphicon-ok',
			invalid: 'glyphicon glyphicon-remove',
			validating: 'glyphicon glyphicon-refresh'
		},
		fields: {
			tipo_evento: {
				validators: {
					notEmpty: {
						message:'Preenchimento obrigatório'
					}
				}
			}
		}
	})
});

//Só libera os botoes do form tipo_evento ao selecionar a tipo_evento
$(function(){
	$('#btnAlteraTipoEvento').attr('disabled', 'disabled');
	$('#btnExcluiTipoEvento').attr('disabled', 'disabled');
	$('#tipo_evento').change(function(){
		if($('#tipo_evento').val() != ""){
		   $('#btnAlteraTipoEvento').removeAttr('disabled');
		   $('#btnExcluiTipoEvento').removeAttr('disabled');
		}
		else{
			$('#btnAlteraTipoEvento').attr('disabled', 'disabled');
			$('#btnExcluiTipoEvento').attr('disabled', 'disabled');
		}
	});
});

//Informa os valores dos campos ao modal alterar fonte info
$('#modalAlterarTipoEvento').on('show.bs.modal', function (event) {
	var array_tipo_evento = $('#tipo_evento').val().split('|');
	var id_tipo_evento = array_tipo_evento[0]
	var tipo_evento = array_tipo_evento[1]
	var modal = $(this)

	modal.find('#id_tipo_evento').val(id_tipo_evento)
	modal.find('#tipo_evento').val(tipo_evento)
	modal.find('#tipo_evento_atual').val(tipo_evento)
})

//imprimir lista tipo_evento
document.getElementById('btnPrintTipoEvento').onclick = function() {
	var conteudo = document.getElementById('area_printTipoEvento').innerHTML;
	var tela_impressao = window.open('','','width=0, height=0, top=50, left=50');
	tela_impressao.document.write(conteudo);
	tela_impressao.window.print();
	tela_impressao.window.close();
};
