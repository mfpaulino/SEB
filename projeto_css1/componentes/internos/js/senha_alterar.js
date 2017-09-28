$(document).ready(function() {
	$('#form_senha_alterar').bootstrapValidator({
		feedbackIcons: {
			valid: 'glyphicon glyphicon-ok',
			invalid: 'glyphicon glyphicon-remove',
			validating: 'glyphicon glyphicon-refresh'
		},
		fields: {
			cpf: {
				validators: {
					notEmpty: {
						message:'Preenchimento obrigatório'
					}
				}
			},
			senha_nova: {
				validators: {
					notEmpty: {
						message: 'Preenchimento obrigatório'
					},
					stringLength: {
						min: 8,
						max: 20,
						message: 'Mínimo de 8 e máximo de 20 caracteres'
					},
					different: {
						field: 'cpf',
						message: 'Não pode ser igual ao CPF.'
					}
				}
			},
			senha_nova1: {
				validators: {
					notEmpty: {
						message: 'Preenchimento obrigatório'
					},
					identical: {
						field: 'senha_nova',
						message: 'As senhas devem ser iguais.'
					}
				}
			}
		}
	})
});
