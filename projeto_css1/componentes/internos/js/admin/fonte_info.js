//validação dos form cadastrar e alterar
$(document).ready(function() {
	$('#form_fonte_info_cadastrar').bootstrapValidator({
		feedbackIcons: {
			valid: 'glyphicon glyphicon-ok',
			invalid: 'glyphicon glyphicon-remove',
			validating: 'glyphicon glyphicon-refresh'
		},
		fields: {
			fonte_info: {
				validators: {
					notEmpty: {
						message:'Preenchimento obrigatório'
					}
				}
			}
		}
	})
	$('#form_fonte_info_alterar').bootstrapValidator({
		feedbackIcons: {
			valid: 'glyphicon glyphicon-ok',
			invalid: 'glyphicon glyphicon-remove',
			validating: 'glyphicon glyphicon-refresh'
		},
		fields: {
			fonte_info: {
				validators: {
					notEmpty: {
						message:'Preenchimento obrigatório'
					}
				}
			}
		}
	})
});

//Só libera os botoes do form fonte_info ao selecionar a fonte_info
$(function(){
	$('#btnAlteraFonteInfo').attr('disabled', 'disabled');
	$('#btnExcluiFonteInfo').attr('disabled', 'disabled');
	$('#fonte_info').change(function(){
		if($('#fonte_info').val() != ""){
		   $('#btnAlteraFonteInfo').removeAttr('disabled');
		   $('#btnExcluiFonteInfo').removeAttr('disabled');
		}
		else{
			$('#btnAlteraFonteInfo').attr('disabled', 'disabled');
			$('#btnExcluiFonteInfo').attr('disabled', 'disabled');
		}
	});
});

//Informa os valores dos campos ao modal alterar fonte info
$('#modalAlterarFonteInfo').on('show.bs.modal', function (event) {
	var array_fonte_info = $('#fonte_info').val().split('|');
	var id_fonte_info = array_fonte_info[0]
	var fonte_info = array_fonte_info[1]
	var modal = $(this)

	modal.find('#id_fonte_info').val(id_fonte_info)
	modal.find('#fonte_info').val(fonte_info)
	modal.find('#fonte_info_atual').val(fonte_info)
})

//imprimir lista fonte_info
document.getElementById('btnPrintFonteInfo').onclick = function() {
	var conteudo = document.getElementById('area_printFonteInfo').innerHTML;
	var tela_impressao = window.open('','','width=0, height=0, top=50, left=50');
	tela_impressao.document.write(conteudo);
	tela_impressao.window.print();
	tela_impressao.window.close();
};
