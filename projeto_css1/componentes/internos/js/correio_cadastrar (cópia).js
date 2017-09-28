$(document).ready(function() {
	$('#form_correio_cadastrar').bootstrapValidator({
		feedbackIcons: {
			valid: 'glyphicon glyphicon-ok',
			invalid: 'glyphicon glyphicon-remove',
			validating: 'glyphicon glyphicon-refresh'
		},
		fields: {
			'destinatario[]': {
				validators: {
					notEmpty: {
						message: 'Selecione o(s) destinatário(s)'
					}
				}
			},
			texto: {
                		validators: {
                    			notEmpty: {
                        			message: 'Digite o texto da mensagem'
                    			}
               			 }
            		}
		}
	});
});
