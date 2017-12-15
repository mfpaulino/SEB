$(document).ready(function() {
	$('#form_aviso_cadastrar').bootstrapValidator({
		feedbackIcons: {
			valid: 'glyphicon glyphicon-ok',
			invalid: 'glyphicon glyphicon-remove',
			validating: 'glyphicon glyphicon-refresh'
		},
		fields: {
			'publico[]': {
				validators: {
					notEmpty: {
						message:'Preenchimento obrigatório'
					}
				}
				    
			}
		}
	})
	$('#form_aviso_alterar').bootstrapValidator({
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
			}
		}
	})	
	
	//calendario
        $('#validade').datepicker({
		startDate: "date",//desabilita datas anteriores que a data atual
		autoclose: true, //fecha o calendário ao selecionar a data
		language: 'pt-BR'
        });
        
        $("#validade").mask("99/99/9999",{placeholder:" "}); //deveria criar uma mascara, mas está impedindo a digitação. Deixei pois resolveu o problema da validação
      	
      	//estiliza o checkbox
	$('[name=status]').bootstrapSwitch();

});
