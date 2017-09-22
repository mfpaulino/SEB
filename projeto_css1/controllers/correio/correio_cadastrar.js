$(document).ready(function() {
	$('#form_correio_cadastrar').bootstrapValidator({
		feedbackIcons: {
			valid: 'glyphicon glyphicon-ok',
			invalid: 'glyphicon glyphicon-remove',
			validating: 'glyphicon glyphicon-refresh'
		},
		fields: {
			destinatario: {
				validators: {
					notEmpty: {
						message:'Preenchimento obrigatório'
					}
				}
			},
			texto: {
				validators: {
					notEmpty: {
						message: 'Preenchimento obrigatório'
					}
				}
			}
		}
	})
});
