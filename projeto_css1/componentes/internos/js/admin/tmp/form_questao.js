$(document).ready(function() {
	$('#form_questao_cadastrar').bootstrapValidator({
		feedbackIcons: {
			valid: 'glyphicon glyphicon-ok',
			invalid: 'glyphicon glyphicon-remove',
			validating: 'glyphicon glyphicon-refresh'
		},
		fields: {
			questao: {
				validators: {
					notEmpty: {
						message:'Preenchimento obrigatório'
					}
				}
			}
		}
	})
	$('#form_questao_alterar').bootstrapValidator({
		feedbackIcons: {
			valid: 'glyphicon glyphicon-ok',
			invalid: 'glyphicon glyphicon-remove',
			validating: 'glyphicon glyphicon-refresh'
		},
		fields: {
			questao: {
				validators: {
					notEmpty: {
						message:'Preenchimento obrigatório'
					}
				}
			}
		}
	})
});
