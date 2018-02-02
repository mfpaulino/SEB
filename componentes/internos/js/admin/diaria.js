//validação dos form cadastrar e alterar
$(document).ready(function() {
	$('#form_diaria_cadastrar').bootstrapValidator({
		feedbackIcons: {
			valid: 'glyphicon glyphicon-ok',
			invalid: 'glyphicon glyphicon-remove',
			validating: 'glyphicon glyphicon-refresh'
		},
		fields: {
			categoria: {
				validators: {
					notEmpty: {
						message:'Preenchimento obrigatório'
					}
				}
			},
			posto: {
				validators: {
					notEmpty: {
						message:'Preenchimento obrigatório'
					}
				}
			},
			valor: {
				validators: {
					notEmpty: {
						message:'Preenchimento obrigatório'
					}
				}
			}
		}
	})
	$('#form_diaria_alterar').bootstrapValidator({
		feedbackIcons: {
			valid: 'glyphicon glyphicon-ok',
			invalid: 'glyphicon glyphicon-remove',
			validating: 'glyphicon glyphicon-refresh'
		},
		fields: {
			valor: {
				validators: {
					notEmpty: {
						message:'Preenchimento obrigatório'
					}
				}
			}
		}
	})
});

//Só libera os botoes do form diaria ao selecionar a diaria
$(function(){
	$('#btnAlteraDiaria').attr('disabled', 'disabled');
	$('#btnExcluiDiaria').attr('disabled', 'disabled');
	$('#diaria').change(function(){
		if($('#diaria').val() != ""){
		   $('#btnAlteraDiaria').removeAttr('disabled');
		   $('#btnExcluiDiaria').removeAttr('disabled');
		}
		else{
			$('#btnAlteraDiaria').attr('disabled', 'disabled');
			$('#btnExcluiDiaria').attr('disabled', 'disabled');
		}
	});
});

//Informa os valores dos campos ao modal alterar diária
$('#modalAlterarDiaria').on('show.bs.modal', function (event) {
	var array_diaria = $('#diaria').val().split('|');
	var id_diaria = array_diaria[0]
	var categoria = array_diaria[1]
	var posto = array_diaria[2]
	var valor = array_diaria[3]
	var modal = $(this)

	modal.find('#id_diaria').val(id_diaria)
	modal.find('#categoria').val(categoria)
	modal.find('#posto').val(posto)
	modal.find('#valor_altera').val(valor)
	modal.find('#valor_atual').val(valor)
})

//mascara para valor diaria
$("#valor").maskMoney({allowNegative: false, thousands:'.', decimal:',', affixesStay: false});//form cadastrar diaria
$("#valor_altera").maskMoney({allowNegative: false, thousands:'.', decimal:',', affixesStay: false});//form alterar diaria

//imprimir lista diaria
document.getElementById('btnPrintDiaria').onclick = function() {
	var conteudo = document.getElementById('area_printDiaria').innerHTML;
	var	tela_impressao = window.open('','','width=0, height=0, top=50, left=50');
	tela_impressao.document.write(conteudo);
	tela_impressao.window.print();
	tela_impressao.window.close();
};

