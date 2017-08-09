$(document).ready(function() {
	$('#form_usuario_acessar').bootstrapValidator({
		feedbackIcons: {
			valid: 'glyphicon glyphicon-user',
			invalid: '',
			validating: ''
		},
		fields: {
			cpf: {
				validators: {
					notEmpty: {
						message:'Preenchimento obrigatório'
					},
					remote: {
						type: 'POST',
						url: 'controllers/usuario/usuario_verificar.json.php',
						message: 'Usuário não encontrado',
						delay: 1000
					}
				}
			},
			senha: {
				validators: {
					notEmpty: {
						message:'Preenchimento obrigatório'
					}
				}
			}
		}
	})
});