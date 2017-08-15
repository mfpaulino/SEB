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
						message:'PREENCHIMENTO OBRIGATÓRIO'
					},
					remote: {
						type: 'POST',
						url: 'controllers/usuario/usuario_verificar.json.php',
						message: 'USUÁRIO NÃO ENCONTRADO',
						delay: 1000
					}
				}
			},
			senha: {
				validators: {
					notEmpty: {
						message:'PREENCHIMENTO OBRIGATÓRIO'
					},
					stringLength: {
						min: 8,
						max: 20,
						message: 'MÍNIMO DE 8 (OITO) CARACTERES'
					}
				}
			}
		}
	})
});
